<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Enable CORS for mobile & web clients
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        if ($this->input->method(TRUE) === 'OPTIONS') {
            exit(0);
        }

        $this->load->model('Vehicle_model');
        $this->load->model('Booking_model');
        $this->load->model('Customer_model');
        $this->load->model('Coupon_model');
        $this->load->model('Setting_model');
        $this->load->model('Driver_model');
    }

    private function json_response($data, $code = 200) {
        $this->output
            ->set_status_header($code)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))
            ->_display();
        exit;
    }

    private function get_post_input() {
        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true);
        if (is_array($data)) {
            return $data;
        }
        return $this->input->post();
    }

    // Health check
    public function index() {
        $this->json_response(array(
            'status' => true,
            'app' => 'DropTaxi API',
            'version' => '1.0.0',
            'time' => date('Y-m-d H:i:s')
        ));
    }

    // GET /api/vehicles
    public function vehicles() {
        $vehicles = $this->Vehicle_model->get_active_vehicles();
        $this->json_response(array(
            'status' => true,
            'count' => count($vehicles),
            'data' => $vehicles
        ));
    }

    // GET /api/settings
    public function settings() {
        $settings = $this->Setting_model->get_all_settings();
        $this->json_response(array(
            'status' => true,
            'data' => $settings
        ));
    }

    // GET or POST /api/places_autocomplete?input=xxx
    public function places_autocomplete() {
        $input = $this->input->get('input');
        if (empty($input)) {
            $post = $this->get_post_input();
            $input = isset($post['input']) ? $post['input'] : '';
        }

        $input = trim($input);
        if (empty($input)) {
            $this->json_response(array('status' => true, 'input' => '', 'predictions' => array()));
            return;
        }

        $api_key = $this->Setting_model->get_setting('google_map_key', '');
        $predictions = array();

        // 1. Query Google Places API if key is configured
        if (!empty($api_key)) {
            $url = "https://maps.googleapis.com/maps/api/place/autocomplete/json?input=" . urlencode($input) . "&key=" . urlencode($api_key) . "&components=country:in";
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $resp = curl_exec($ch);
            curl_close($ch);

            if ($resp) {
                $json = json_decode($resp, true);
                if (isset($json['predictions']) && is_array($json['predictions']) && !empty($json['predictions'])) {
                    foreach ($json['predictions'] as $p) {
                        $predictions[] = array(
                            'description'    => $p['description'],
                            'main_text'      => isset($p['structured_formatting']['main_text']) ? $p['structured_formatting']['main_text'] : $p['description'],
                            'secondary_text' => isset($p['structured_formatting']['secondary_text']) ? $p['structured_formatting']['secondary_text'] : '',
                            'place_id'       => isset($p['place_id']) ? $p['place_id'] : ''
                        );
                    }
                }
            }
        }

        // 2. Comprehensive South India & Tamil Nadu areas, neighborhoods, towns, stations, and airports database
        $popular_places = $this->get_curated_places();

        $local_matches = array();
        $input_clean = strtolower(trim($input));
        $tokens = array_filter(preg_split('/\s+/', $input_clean));

        foreach ($popular_places as $place) {
            $main_lower = strtolower($place['main_text']);
            $sec_lower  = strtolower($place['secondary_text']);
            $full_str   = $main_lower . ' ' . $sec_lower;
            $words      = preg_split('/[\s,()\/]+/', $full_str, -1, PREG_SPLIT_NO_EMPTY);
            $desc       = $place['main_text'] . ', ' . $place['secondary_text'];

            $all_match = true;
            $score = 0;
            foreach ($tokens as $token) {
                $token_match = false;
                if (strpos($full_str, $token) !== false) {
                    $token_match = true;
                    $score += 1;
                } else {
                    $norm_token = $this->normalize_phonetic($token);
                    $norm_full  = $this->normalize_phonetic($full_str);
                    if (strlen($norm_token) >= 3 && strpos($norm_full, $norm_token) !== false) {
                        $token_match = true;
                        $score += 2;
                    } elseif (strlen($token) >= 4) {
                        foreach ($words as $w) {
                            if (strlen($w) >= 3 && levenshtein($token, $w) <= (strlen($token) <= 6 ? 1 : 2)) {
                                $token_match = true;
                                $score += 3;
                                break;
                            }
                        }
                    }
                }

                if (!$token_match) {
                    $all_match = false;
                    break;
                }
            }

            if ($all_match) {
                if ($main_lower === $input_clean) $score -= 10;
                elseif (strpos($main_lower, $input_clean) === 0) $score -= 5;
                elseif (strpos($full_str, $input_clean) !== false) $score -= 3;

                $local_matches[] = array(
                    'score'          => $score,
                    'description'    => $desc,
                    'main_text'      => $place['main_text'],
                    'secondary_text' => $place['secondary_text'],
                    'place_id'       => 'local_' . md5($place['main_text'] . $place['secondary_text'])
                );
            }
        }

        // Sort local matches by relevance
        usort($local_matches, function($a, $b) {
            return $a['score'] - $b['score'];
        });

        foreach ($local_matches as $m) {
            unset($m['score']);
            // Avoid duplicates
            $already = false;
            foreach ($predictions as $p) {
                if (strcasecmp($p['main_text'], $m['main_text']) === 0) {
                    $already = true;
                    break;
                }
            }
            if (!$already) {
                $predictions[] = $m;
            }
        }

        // 3. If still fewer than 5 results, query OpenStreetMap Nominatim live search (free, no API key needed)
        if (count($predictions) < 5 && strlen($input) >= 2) {
            $osm_url = "https://nominatim.openstreetmap.org/search?q=" . urlencode($input . ' Tamil Nadu') . "&format=json&countrycodes=in&addressdetails=1&limit=6";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $osm_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            curl_setopt($ch, CURLOPT_USERAGENT, 'DropTaxi-Search/1.0');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $resp = curl_exec($ch);
            curl_close($ch);

            if ($resp) {
                $json = json_decode($resp, true);
                if (is_array($json)) {
                    foreach ($json as $item) {
                        $name = isset($item['name']) && !empty($item['name']) ? $item['name'] : (isset($item['display_name']) ? explode(',', $item['display_name'])[0] : $input);
                        $display = isset($item['display_name']) ? $item['display_name'] : $name;
                        
                        $already = false;
                        foreach ($predictions as $p) {
                            if (strcasecmp($p['main_text'], $name) === 0 || stripos($p['description'], $name) !== false) {
                                $already = true;
                                break;
                            }
                        }
                        if (!$already) {
                            $addr = isset($item['address']) ? $item['address'] : array();
                            $sec_parts = array();
                            if (!empty($addr['suburb']) && $addr['suburb'] !== $name) $sec_parts[] = $addr['suburb'];
                            if (!empty($addr['city']) && $addr['city'] !== $name) $sec_parts[] = $addr['city'];
                            elseif (!empty($addr['town']) && $addr['town'] !== $name) $sec_parts[] = $addr['town'];
                            elseif (!empty($addr['county']) && $addr['county'] !== $name) $sec_parts[] = $addr['county'];
                            if (!empty($addr['state_district'])) $sec_parts[] = $addr['state_district'];
                            if (!empty($addr['state'])) $sec_parts[] = $addr['state'];
                            $sec_parts[] = 'India';

                            $sec_text = implode(', ', array_unique($sec_parts));
                            $predictions[] = array(
                                'description'    => $name . ($sec_text ? ', ' . $sec_text : ''),
                                'main_text'      => $name,
                                'secondary_text' => $sec_text ?: 'Tamil Nadu, India',
                                'place_id'       => 'osm_' . (isset($item['place_id']) ? $item['place_id'] : rand(1000, 9999))
                            );
                        }
                    }
                }
            }
        }

        // 4. Default fallback if empty
        if (empty($predictions)) {
            $predictions[] = array(
                'description'    => ucfirst($input) . ', Tamil Nadu, India',
                'main_text'      => ucfirst($input),
                'secondary_text' => 'Tamil Nadu, India',
                'place_id'       => 'custom_' . time()
            );
        }

        $this->json_response(array(
            'status'      => true,
            'input'       => $input,
            'predictions' => array_slice($predictions, 0, 10)
        ));
    }

    private function get_curated_places() {
        return array(
            // Tirunelveli & Nellai Area Localities
            array('main_text' => 'Melapalayam', 'secondary_text' => 'Tirunelveli, Tamil Nadu'),
            array('main_text' => 'Melapalayam Bus Stand', 'secondary_text' => 'Melapalayam, Tirunelveli, Tamil Nadu'),
            array('main_text' => 'Palayamkottai', 'secondary_text' => 'Tirunelveli, Tamil Nadu'),
            array('main_text' => 'Palayamkottai Bus Stand', 'secondary_text' => 'Palayamkottai, Tirunelveli, Tamil Nadu'),
            array('main_text' => 'Tirunelveli Junction Railway Station', 'secondary_text' => 'Tirunelveli, Tamil Nadu'),
            array('main_text' => 'Tirunelveli Town', 'secondary_text' => 'Tirunelveli, Tamil Nadu'),
            array('main_text' => 'Tirunelveli New Bus Stand (Vaeinthankulam)', 'secondary_text' => 'Tirunelveli, Tamil Nadu'),
            array('main_text' => 'Pettai', 'secondary_text' => 'Tirunelveli, Tamil Nadu'),
            array('main_text' => 'Thatchanallur', 'secondary_text' => 'Tirunelveli, Tamil Nadu'),
            array('main_text' => 'Vannarpettai', 'secondary_text' => 'Tirunelveli, Tamil Nadu'),
            array('main_text' => 'Samathanapuram', 'secondary_text' => 'Palayamkottai, Tirunelveli, Tamil Nadu'),
            array('main_text' => 'Perumalpuram', 'secondary_text' => 'Tirunelveli, Tamil Nadu'),
            array('main_text' => 'High Ground', 'secondary_text' => 'Palayamkottai, Tirunelveli, Tamil Nadu'),
            array('main_text' => 'Maharaja Nagar', 'secondary_text' => 'Palayamkottai, Tirunelveli, Tamil Nadu'),
            array('main_text' => 'NGO Colony', 'secondary_text' => 'Tirunelveli, Tamil Nadu'),
            array('main_text' => 'KTC Nagar', 'secondary_text' => 'Palayamkottai, Tirunelveli, Tamil Nadu'),
            array('main_text' => 'Reddiarpatti', 'secondary_text' => 'Tirunelveli, Tamil Nadu'),
            array('main_text' => 'Ambasamudram', 'secondary_text' => 'Tirunelveli District, Tamil Nadu'),
            array('main_text' => 'Kallidaikurichi', 'secondary_text' => 'Tirunelveli District, Tamil Nadu'),
            array('main_text' => 'Cheranmahadevi', 'secondary_text' => 'Tirunelveli District, Tamil Nadu'),
            array('main_text' => 'Kalakkad', 'secondary_text' => 'Tirunelveli District, Tamil Nadu'),
            array('main_text' => 'Nanguneri', 'secondary_text' => 'Tirunelveli District, Tamil Nadu'),
            array('main_text' => 'Valliyur', 'secondary_text' => 'Tirunelveli District, Tamil Nadu'),
            array('main_text' => 'Radhapuram', 'secondary_text' => 'Tirunelveli District, Tamil Nadu'),
            array('main_text' => 'Kudankulam', 'secondary_text' => 'Tirunelveli District, Tamil Nadu'),
            array('main_text' => 'Tisayanvilai', 'secondary_text' => 'Tirunelveli District, Tamil Nadu'),
            array('main_text' => 'Alangulam', 'secondary_text' => 'Tenkasi District, Tamil Nadu'),
            array('main_text' => 'Surandai', 'secondary_text' => 'Tenkasi District, Tamil Nadu'),
            array('main_text' => 'Tenkasi Junction Railway Station', 'secondary_text' => 'Tenkasi, Tamil Nadu'),
            array('main_text' => 'Courtallam (Kutralam)', 'secondary_text' => 'Tenkasi, Tamil Nadu'),
            array('main_text' => 'Sengottai', 'secondary_text' => 'Tenkasi District, Tamil Nadu'),
            array('main_text' => 'Kadayanallur', 'secondary_text' => 'Tenkasi District, Tamil Nadu'),
            array('main_text' => 'Puliyangudi', 'secondary_text' => 'Tenkasi District, Tamil Nadu'),
            array('main_text' => 'Sankarankovil', 'secondary_text' => 'Tenkasi District, Tamil Nadu'),
            array('main_text' => 'Sivagiri', 'secondary_text' => 'Tenkasi District, Tamil Nadu'),

            // Chennai Area Localities & Hubs
            array('main_text' => 'Chennai Central Railway Station (MAS)', 'secondary_text' => 'Periyamet, Chennai, Tamil Nadu'),
            array('main_text' => 'Chennai Egmore Railway Station (MS)', 'secondary_text' => 'Egmore, Chennai, Tamil Nadu'),
            array('main_text' => 'Chennai International Airport (MAA)', 'secondary_text' => 'Meenambakkam, Chennai, Tamil Nadu'),
            array('main_text' => 'CMBT Koyambedu Bus Terminus', 'secondary_text' => 'Koyambedu, Chennai, Tamil Nadu'),
            array('main_text' => 'Kilambakkam KCBT Bus Terminus', 'secondary_text' => 'Kilambakkam, Vandalur, Chennai'),
            array('main_text' => 'T. Nagar (Thyagaraya Nagar)', 'secondary_text' => 'Chennai, Tamil Nadu'),
            array('main_text' => 'Anna Nagar', 'secondary_text' => 'Chennai, Tamil Nadu'),
            array('main_text' => 'Velachery', 'secondary_text' => 'Chennai, Tamil Nadu'),
            array('main_text' => 'Guindy Railway Station / Metro', 'secondary_text' => 'Guindy, Chennai, Tamil Nadu'),
            array('main_text' => 'Tambaram Railway Station & Bus Stand', 'secondary_text' => 'Tambaram, Chennai, Tamil Nadu'),
            array('main_text' => 'Chromepet', 'secondary_text' => 'Chennai, Tamil Nadu'),
            array('main_text' => 'Pallavaram', 'secondary_text' => 'Chennai, Tamil Nadu'),
            array('main_text' => 'Porur Junction', 'secondary_text' => 'Porur, Chennai, Tamil Nadu'),
            array('main_text' => 'Poonamallee Bus Stand', 'secondary_text' => 'Poonamallee, Chennai, Tamil Nadu'),
            array('main_text' => 'OMR (Old Mahabalipuram Road)', 'secondary_text' => 'IT Corridor, Chennai, Tamil Nadu'),
            array('main_text' => 'Sholinganallur Junction', 'secondary_text' => 'OMR, Chennai, Tamil Nadu'),
            array('main_text' => 'Perungudi / Kandanchavadi', 'secondary_text' => 'OMR, Chennai, Tamil Nadu'),
            array('main_text' => 'Thoraipakkam', 'secondary_text' => 'OMR, Chennai, Tamil Nadu'),
            array('main_text' => 'Navallur', 'secondary_text' => 'OMR, Chennai, Tamil Nadu'),
            array('main_text' => 'Siruseri SIPCOT IT Park', 'secondary_text' => 'Chennai, Tamil Nadu'),
            array('main_text' => 'Medavakkam Junction', 'secondary_text' => 'Medavakkam, Chennai, Tamil Nadu'),
            array('main_text' => 'Adyar', 'secondary_text' => 'Chennai, Tamil Nadu'),
            array('main_text' => 'Besant Nagar (Elliot\'s Beach)', 'secondary_text' => 'Adyar, Chennai, Tamil Nadu'),
            array('main_text' => 'Thiruvanmiyur', 'secondary_text' => 'Chennai, Tamil Nadu'),
            array('main_text' => 'Mylapore', 'secondary_text' => 'Chennai, Tamil Nadu'),
            array('main_text' => 'Nungambakkam', 'secondary_text' => 'Chennai, Tamil Nadu'),
            array('main_text' => 'Alwarpet', 'secondary_text' => 'Chennai, Tamil Nadu'),
            array('main_text' => 'Vadapalani Metro & Bus Depot', 'secondary_text' => 'Vadapalani, Chennai, Tamil Nadu'),
            array('main_text' => 'Ashok Nagar', 'secondary_text' => 'Chennai, Tamil Nadu'),
            array('main_text' => 'K.K. Nagar', 'secondary_text' => 'Chennai, Tamil Nadu'),
            array('main_text' => 'Saidapet', 'secondary_text' => 'Chennai, Tamil Nadu'),
            array('main_text' => 'Perambur Railway Station', 'secondary_text' => 'Perambur, Chennai, Tamil Nadu'),
            array('main_text' => 'Ambattur Industrial Estate', 'secondary_text' => 'Ambattur, Chennai, Tamil Nadu'),
            array('main_text' => 'Avadi Railway Station / Bus Stand', 'secondary_text' => 'Avadi, Chennai, Tamil Nadu'),
            array('main_text' => 'Kolathur', 'secondary_text' => 'Chennai, Tamil Nadu'),
            array('main_text' => 'Madhavaram MMBT Bus Terminus', 'secondary_text' => 'Madhavaram, Chennai, Tamil Nadu'),
            array('main_text' => 'Sriperumbudur Industrial Hub', 'secondary_text' => 'Kanchipuram District, Tamil Nadu'),
            array('main_text' => 'Chengalpattu Junction', 'secondary_text' => 'Chengalpattu, Tamil Nadu'),
            array('main_text' => 'Mahabalipuram (Mamallapuram)', 'secondary_text' => 'Chengalpattu District, Tamil Nadu'),

            // Madurai Area Localities
            array('main_text' => 'Villapuram', 'secondary_text' => 'Madurai, Tamil Nadu'),
            array('main_text' => 'Villapuram Housing Board', 'secondary_text' => 'Villapuram, Madurai, Tamil Nadu'),
            array('main_text' => 'Avaniyapuram', 'secondary_text' => 'Madurai, Tamil Nadu'),
            array('main_text' => 'Madurai Junction Railway Station', 'secondary_text' => 'Madurai, Tamil Nadu'),
            array('main_text' => 'Mattuthavani Integrated Bus Terminus (MIBT)', 'secondary_text' => 'Madurai, Tamil Nadu'),
            array('main_text' => 'Periyar Bus Stand', 'secondary_text' => 'Madurai, Tamil Nadu'),
            array('main_text' => 'Arappalayam Bus Stand', 'secondary_text' => 'Madurai, Tamil Nadu'),
            array('main_text' => 'Goripalayam', 'secondary_text' => 'Madurai, Tamil Nadu'),
            array('main_text' => 'Simmakkal', 'secondary_text' => 'Madurai, Tamil Nadu'),
            array('main_text' => 'Anna Nagar Madurai', 'secondary_text' => 'Madurai, Tamil Nadu'),
            array('main_text' => 'K.K. Nagar Madurai', 'secondary_text' => 'Madurai, Tamil Nadu'),
            array('main_text' => 'Teppakulam & Vandiyur', 'secondary_text' => 'Madurai, Tamil Nadu'),
            array('main_text' => 'Thiruparankundram', 'secondary_text' => 'Madurai, Tamil Nadu'),
            array('main_text' => 'Thirunagar', 'secondary_text' => 'Madurai, Tamil Nadu'),
            array('main_text' => 'Munichalai', 'secondary_text' => 'Madurai, Tamil Nadu'),
            array('main_text' => 'Sellur', 'secondary_text' => 'Madurai, Tamil Nadu'),
            array('main_text' => 'Anaiyur', 'secondary_text' => 'Madurai, Tamil Nadu'),
            array('main_text' => 'Kochadai', 'secondary_text' => 'Madurai, Tamil Nadu'),
            array('main_text' => 'SS Colony & Ponmeni', 'secondary_text' => 'Madurai, Tamil Nadu'),
            array('main_text' => 'Pasumalai', 'secondary_text' => 'Madurai, Tamil Nadu'),
            array('main_text' => 'Othakadai', 'secondary_text' => 'Madurai, Tamil Nadu'),
            array('main_text' => 'Tirumangalam Bus Stand', 'secondary_text' => 'Madurai District, Tamil Nadu'),
            array('main_text' => 'Madurai International Airport (IXM)', 'secondary_text' => 'Perungudi, Madurai, Tamil Nadu'),
            array('main_text' => 'Melur Bus Stand', 'secondary_text' => 'Madurai District, Tamil Nadu'),
            array('main_text' => 'Usilampatti', 'secondary_text' => 'Madurai District, Tamil Nadu'),
            array('main_text' => 'Vadipatti', 'secondary_text' => 'Madurai District, Tamil Nadu'),

            // Coimbatore Area Localities
            array('main_text' => 'Coimbatore Junction Railway Station', 'secondary_text' => 'Gopalapuram, Coimbatore, Tamil Nadu'),
            array('main_text' => 'Coimbatore International Airport (CJB)', 'secondary_text' => 'Peelamedu, Coimbatore, Tamil Nadu'),
            array('main_text' => 'Gandhipuram Central Bus Stand', 'secondary_text' => 'Gandhipuram, Coimbatore, Tamil Nadu'),
            array('main_text' => 'R.S. Puram (Rathinasabapathy Puram)', 'secondary_text' => 'Coimbatore, Tamil Nadu'),
            array('main_text' => 'Peelamedu / PSG Tech', 'secondary_text' => 'Coimbatore, Tamil Nadu'),
            array('main_text' => 'Singanallur Bus Stand', 'secondary_text' => 'Singanallur, Coimbatore, Tamil Nadu'),
            array('main_text' => 'Saravanampatti IT Corridor', 'secondary_text' => 'Coimbatore, Tamil Nadu'),
            array('main_text' => 'Ganapathy', 'secondary_text' => 'Coimbatore, Tamil Nadu'),
            array('main_text' => 'Ukkadam Bus Stand', 'secondary_text' => 'Ukkadam, Coimbatore, Tamil Nadu'),
            array('main_text' => 'Saibaba Colony', 'secondary_text' => 'Coimbatore, Tamil Nadu'),
            array('main_text' => 'Thudiyalur', 'secondary_text' => 'Coimbatore, Tamil Nadu'),
            array('main_text' => 'Pollachi Junction & Bus Stand', 'secondary_text' => 'Pollachi, Coimbatore, Tamil Nadu'),
            array('main_text' => 'Mettupalayam Railway Station', 'secondary_text' => 'Mettupalayam, Coimbatore, Tamil Nadu'),

            // Trichy Area Localities
            array('main_text' => 'Trichy Junction Railway Station (TPJ)', 'secondary_text' => 'Tiruchirappalli, Tamil Nadu'),
            array('main_text' => 'Trichy Central Bus Stand', 'secondary_text' => 'Cantonment, Tiruchirappalli, Tamil Nadu'),
            array('main_text' => 'Chatram Bus Stand', 'secondary_text' => 'Tiruchirappalli, Tamil Nadu'),
            array('main_text' => 'Srirangam Temple & Railway Station', 'secondary_text' => 'Srirangam, Tiruchirappalli, Tamil Nadu'),
            array('main_text' => 'Thillai Nagar', 'secondary_text' => 'Tiruchirappalli, Tamil Nadu'),
            array('main_text' => 'K.K. Nagar Trichy', 'secondary_text' => 'Tiruchirappalli, Tamil Nadu'),
            array('main_text' => 'Tiruchirappalli International Airport (TRZ)', 'secondary_text' => 'Airport, Tiruchirappalli, Tamil Nadu'),
            array('main_text' => 'Thuvakudi / NIT Trichy', 'secondary_text' => 'Tiruchirappalli, Tamil Nadu'),

            // Salem Area Localities
            array('main_text' => 'Salem Junction Railway Station', 'secondary_text' => 'Suramangalam, Salem, Tamil Nadu'),
            array('main_text' => 'Salem New Bus Stand (Central Bus Stand)', 'secondary_text' => 'Meyyanur, Salem, Tamil Nadu'),
            array('main_text' => 'Fairlands', 'secondary_text' => 'Salem, Tamil Nadu'),
            array('main_text' => 'Hasthampatti', 'secondary_text' => 'Salem, Tamil Nadu'),
            array('main_text' => 'Suramangalam', 'secondary_text' => 'Salem, Tamil Nadu'),
            array('main_text' => 'Yercaud Hills', 'secondary_text' => 'Salem District, Tamil Nadu'),

            // Bengaluru / Bangalore
            array('main_text' => 'Bangalore City Railway Station (KSR Majestic)', 'secondary_text' => 'Kempegowda, Bengaluru, Karnataka'),
            array('main_text' => 'Kempegowda International Airport (BLR)', 'secondary_text' => 'Devanahalli, Bengaluru, Karnataka'),
            array('main_text' => 'Indiranagar Metro Station', 'secondary_text' => 'Indiranagar, Bengaluru, Karnataka'),
            array('main_text' => 'Koramangala', 'secondary_text' => 'Bengaluru, Karnataka'),
            array('main_text' => 'Whitefield / ITPL', 'secondary_text' => 'Bengaluru, Karnataka'),
            array('main_text' => 'HSR Layout', 'secondary_text' => 'Bengaluru, Karnataka'),
            array('main_text' => 'Electronic City Phase 1 & 2', 'secondary_text' => 'Hosur Road, Bengaluru, Karnataka'),
            array('main_text' => 'Jayanagar', 'secondary_text' => 'Bengaluru, Karnataka'),
            array('main_text' => 'BTM Layout', 'secondary_text' => 'Bengaluru, Karnataka'),
            array('main_text' => 'Marathahalli', 'secondary_text' => 'Bengaluru, Karnataka'),
            array('main_text' => 'Yelahanka', 'secondary_text' => 'Bengaluru, Karnataka'),
            array('main_text' => 'Hosur Bus Stand & Railway Station', 'secondary_text' => 'Hosur, Krishnagiri District, Tamil Nadu'),

            // South & Central Tamil Nadu Hubs
            array('main_text' => 'Thoothukudi (Tuticorin) New Bus Stand', 'secondary_text' => 'Thoothukudi, Tamil Nadu'),
            array('main_text' => 'Thoothukudi Railway Station', 'secondary_text' => 'Thoothukudi, Tamil Nadu'),
            array('main_text' => 'Kayalpattinam', 'secondary_text' => 'Thoothukudi District, Tamil Nadu'),
            array('main_text' => 'Tiruchendur Murugan Temple & Beach', 'secondary_text' => 'Tiruchendur, Thoothukudi, Tamil Nadu'),
            array('main_text' => 'Kovilpatti Bus Stand & Railway Station', 'secondary_text' => 'Kovilpatti, Thoothukudi, Tamil Nadu'),
            array('main_text' => 'Nagercoil Junction Railway Station', 'secondary_text' => 'Nagercoil, Kanyakumari District, Tamil Nadu'),
            array('main_text' => 'Kanyakumari Beach & Cape Comorin', 'secondary_text' => 'Kanyakumari, Tamil Nadu'),
            array('main_text' => 'Marthandam', 'secondary_text' => 'Kanyakumari District, Tamil Nadu'),
            array('main_text' => 'Thuckalay', 'secondary_text' => 'Kanyakumari District, Tamil Nadu'),
            array('main_text' => 'Trivandrum Central Railway Station (TVC)', 'secondary_text' => 'Thiruvananthapuram, Kerala'),
            array('main_text' => 'Trivandrum International Airport (TRV)', 'secondary_text' => 'Thiruvananthapuram, Kerala'),
            array('main_text' => 'Pondicherry (Puducherry) Beach Road', 'secondary_text' => 'White Town, Puducherry'),
            array('main_text' => 'Auroville', 'secondary_text' => 'Puducherry / Villupuram'),
            array('main_text' => 'Vellore New Bus Stand', 'secondary_text' => 'Vellore, Tamil Nadu'),
            array('main_text' => 'Katpadi Junction Railway Station', 'secondary_text' => 'Vellore, Tamil Nadu'),
            array('main_text' => 'Tiruvannamalai Annamalaiyar Temple', 'secondary_text' => 'Tiruvannamalai, Tamil Nadu'),
            array('main_text' => 'Kumbakonam Mahamaham Tank', 'secondary_text' => 'Kumbakonam, Thanjavur, Tamil Nadu'),
            array('main_text' => 'Thanjavur Brihadeeswarar Temple', 'secondary_text' => 'Thanjavur, Tamil Nadu'),
            array('main_text' => 'Nagapattinam Port', 'secondary_text' => 'Nagapattinam, Tamil Nadu'),
            array('main_text' => 'Velankanni Basilica of Our Lady of Good Health', 'secondary_text' => 'Velankanni, Nagapattinam, Tamil Nadu'),
            array('main_text' => 'Rameswaram Ramanathaswamy Temple', 'secondary_text' => 'Rameswaram, Ramanathapuram, Tamil Nadu'),
            array('main_text' => 'Dindigul Junction & Rock Fort', 'secondary_text' => 'Dindigul, Tamil Nadu'),
            array('main_text' => 'Kodaikanal Lake & Bus Stand', 'secondary_text' => 'Kodaikanal, Dindigul, Tamil Nadu'),
            array('main_text' => 'Ooty (Udhagamandalam) Charing Cross', 'secondary_text' => 'Ooty, Nilgiris, Tamil Nadu'),
            array('main_text' => 'Coonoor Sim\'s Park', 'secondary_text' => 'Coonoor, Nilgiris, Tamil Nadu'),
            array('main_text' => 'Tiruppur Old / New Bus Stand', 'secondary_text' => 'Tiruppur, Tamil Nadu'),
            array('main_text' => 'Erode Central Bus Stand & Railway Station', 'secondary_text' => 'Erode, Tamil Nadu'),
            array('main_text' => 'Karur Bus Stand & Railway Station', 'secondary_text' => 'Karur, Tamil Nadu'),
            array('main_text' => 'Namakkal Bus Stand', 'secondary_text' => 'Namakkal, Tamil Nadu'),
            array('main_text' => 'Rajapalayam', 'secondary_text' => 'Virudhunagar District, Tamil Nadu'),
            array('main_text' => 'Srivilliputhur Andal Temple', 'secondary_text' => 'Virudhunagar District, Tamil Nadu'),
            array('main_text' => 'Sivakasi Bus Stand', 'secondary_text' => 'Virudhunagar District, Tamil Nadu'),
            array('main_text' => 'Virudhunagar Junction', 'secondary_text' => 'Virudhunagar, Tamil Nadu'),
            array('main_text' => 'Theni Bus Stand', 'secondary_text' => 'Theni, Tamil Nadu'),
            array('main_text' => 'Karaikudi Bus Stand & Railway Station', 'secondary_text' => 'Sivaganga District, Tamil Nadu'),
            array('main_text' => 'Pudukkottai Bus Stand', 'secondary_text' => 'Pudukkottai, Tamil Nadu'),
            array('main_text' => 'Cuddalore Port & Bus Stand', 'secondary_text' => 'Cuddalore, Tamil Nadu'),
            array('main_text' => 'Neyveli Township', 'secondary_text' => 'Cuddalore District, Tamil Nadu'),
            array('main_text' => 'Chidambaram Nataraja Temple', 'secondary_text' => 'Chidambaram, Cuddalore, Tamil Nadu'),
            array('main_text' => 'Villupuram Junction Railway Station', 'secondary_text' => 'Villupuram, Tamil Nadu'),
            array('main_text' => 'Kanchipuram Kamakshi Amman Temple', 'secondary_text' => 'Kanchipuram, Tamil Nadu'),
            array('main_text' => 'Tirupati Railway Station & Alipiri', 'secondary_text' => 'Tirupati, Andhra Pradesh'),
        );
    }

    // POST /api/calculate_fare
    public function calculate_fare() {
        $input = $this->get_post_input();

        $vehicle_id  = isset($input['vehicle_id']) ? intval($input['vehicle_id']) : 0;
        $trip_type   = isset($input['trip_type']) ? trim($input['trip_type']) : 'One Way Drop';
        $distance_km = isset($input['distance_km']) ? floatval($input['distance_km']) : 0.0;
        $coupon_code = isset($input['coupon_code']) ? trim($input['coupon_code']) : '';

        $vehicle = $this->Vehicle_model->get_vehicle_by_id($vehicle_id);
        if (!$vehicle) {
            $vehicles = $this->Vehicle_model->get_active_vehicles();
            if (!empty($vehicles)) {
                $vehicle = $vehicles[0];
            } else {
                $this->json_response(array('status' => false, 'message' => 'No active vehicle types available'), 404);
            }
        }

        $is_roundtrip = (strtolower($trip_type) === 'round trip' || strtolower($trip_type) === 'roundtrip');

        $per_km = $is_roundtrip ? floatval($vehicle['per_km_roundtrip']) : floatval($vehicle['per_km_oneway']);
        $driver_batta = $is_roundtrip ? floatval($vehicle['driver_batta_roundtrip']) : floatval($vehicle['driver_batta_oneway']);
        $min_km = $is_roundtrip ? intval($vehicle['min_km_roundtrip']) : intval($vehicle['min_km_oneway']);
        $base_fare = floatval($vehicle['base_fare']);

        $billable_km = max($distance_km, $min_km);
        $km_charge = $billable_km * $per_km;

        $estimated_toll_fee = 0.00;
        if ($billable_km > 100) {
            $estimated_toll_fee = 150.00;
        }

        $gross_total = $base_fare + $km_charge + $driver_batta + $estimated_toll_fee;

        $discount_amount = 0.00;

        if (!empty($coupon_code)) {
            $coupon_res = $this->Coupon_model->validate_coupon($coupon_code, $gross_total);
            if ($coupon_res['status']) {
                $discount_amount = $coupon_res['discount_amount'];
            }
        }

        $final_total = max(0, $gross_total - $discount_amount);

        $this->json_response(array(
            'status' => true,
            'data' => array(
                'vehicle_id'       => $vehicle['id'],
                'vehicle_name'     => $vehicle['name'],
                'trip_type'        => $is_roundtrip ? 'Round Trip' : 'One Way Drop',
                'distance_km'      => $distance_km,
                'min_km'           => $min_km,
                'billable_km'      => $billable_km,
                'per_km_rate'      => $per_km,
                'base_fare'        => $base_fare,
                'km_charge'        => round($km_charge, 2),
                'driver_batta'     => $driver_batta,
                'estimated_toll'   => $estimated_toll_fee,
                'gross_total'      => round($gross_total, 2),
                'coupon_code'      => $coupon_code,
                'discount_amount'  => round($discount_amount, 2),
                'final_total'      => round($final_total, 2)
            )
        ));
    }

    // POST /api/send_otp
    public function send_otp() {
        $input = $this->get_post_input();
        $name  = isset($input['name']) ? trim($input['name']) : '';
        $phone = isset($input['phone']) ? trim($input['phone']) : '';
        $email = isset($input['email']) ? trim($input['email']) : '';

        if (empty($phone)) {
            $this->json_response(array('status' => false, 'message' => 'Phone number is required.'), 400);
        }

        $res = $this->Customer_model->create_or_update_otp($name, $phone, $email);
        $this->json_response($res);
    }

    // POST /api/verify_otp
    public function verify_otp() {
        $input = $this->get_post_input();
        $phone = isset($input['phone']) ? trim($input['phone']) : '';
        $otp   = isset($input['otp']) ? trim($input['otp']) : '';

        if (empty($phone) || empty($otp)) {
            $this->json_response(array('status' => false, 'message' => 'Phone number and OTP code are required.'), 400);
        }

        $res = $this->Customer_model->verify_otp($phone, $otp);
        $this->json_response($res);
    }

    // POST /api/create_booking
    public function create_booking() {
        $input = $this->get_post_input();

        $passenger_name  = isset($input['passenger_name']) ? trim($input['passenger_name']) : '';
        $passenger_phone = isset($input['passenger_phone']) ? trim($input['passenger_phone']) : '';
        $passenger_email = isset($input['passenger_email']) ? trim($input['passenger_email']) : '';
        $pickup_location = isset($input['pickup_location']) ? trim($input['pickup_location']) : '';
        $drop_location   = isset($input['drop_location']) ? trim($input['drop_location']) : '';
        $trip_type       = isset($input['trip_type']) ? trim($input['trip_type']) : 'One Way Drop';
        $pickup_date     = isset($input['pickup_date']) ? trim($input['pickup_date']) : date('Y-m-d');
        $pickup_time     = isset($input['pickup_time']) ? trim($input['pickup_time']) : date('H:i');
        $return_date     = isset($input['return_date']) ? trim($input['return_date']) : null;
        $vehicle_id      = isset($input['vehicle_id']) ? intval($input['vehicle_id']) : 0;
        $distance_km     = isset($input['distance_km']) ? floatval($input['distance_km']) : 100;
        $coupon_code     = isset($input['coupon_code']) ? trim($input['coupon_code']) : '';
        $notes           = isset($input['notes']) ? trim($input['notes']) : '';
        $customer_id     = isset($input['customer_id']) ? intval($input['customer_id']) : null;

        if (empty($passenger_name) || empty($passenger_phone) || empty($pickup_location) || empty($drop_location)) {
            $this->json_response(array('status' => false, 'message' => 'Please provide passenger name, phone, pickup, and drop locations.'), 400);
        }

        $vehicle = $this->Vehicle_model->get_vehicle_by_id($vehicle_id);
        if (!$vehicle) {
            $vehicles = $this->Vehicle_model->get_active_vehicles();
            if (!empty($vehicles)) $vehicle = $vehicles[0];
            else {
                $this->json_response(array('status' => false, 'message' => 'Invalid vehicle selected.'), 400);
            }
        }

        $is_roundtrip = (strtolower($trip_type) === 'round trip' || strtolower($trip_type) === 'roundtrip');
        $per_km = $is_roundtrip ? floatval($vehicle['per_km_roundtrip']) : floatval($vehicle['per_km_oneway']);
        $driver_batta = $is_roundtrip ? floatval($vehicle['driver_batta_roundtrip']) : floatval($vehicle['driver_batta_oneway']);
        $min_km = $is_roundtrip ? intval($vehicle['min_km_roundtrip']) : intval($vehicle['min_km_oneway']);

        $billable_km = max($distance_km, $min_km);
        $gross_total = floatval($vehicle['base_fare']) + ($billable_km * $per_km) + $driver_batta;

        $discount_amount = 0.00;
        if (!empty($coupon_code)) {
            $coupon_res = $this->Coupon_model->validate_coupon($coupon_code, $gross_total);
            if ($coupon_res['status']) {
                $discount_amount = $coupon_res['discount_amount'];
            }
        }

        $estimated_total = max(0, $gross_total - $discount_amount);
        $booking_id = $this->Booking_model->generate_booking_id();

        $booking_data = array(
            'booking_id'      => $booking_id,
            'trip_type'       => $is_roundtrip ? 'Round Trip' : 'One Way Drop',
            'pickup_location' => $pickup_location,
            'drop_location'   => $drop_location,
            'pickup_date'     => $pickup_date,
            'pickup_time'     => $pickup_time,
            'return_date'     => !empty($return_date) ? $return_date : null,
            'vehicle_id'      => $vehicle['id'],
            'customer_id'     => $customer_id,
            'vehicle_name'    => $vehicle['name'],
            'distance_km'     => $distance_km,
            'per_km_rate'     => $per_km,
            'driver_batta'    => $driver_batta,
            'estimated_fare'  => round($estimated_total, 2),
            'total_fare'      => round($estimated_total, 2),
            'coupon_code'     => !empty($coupon_code) ? $coupon_code : null,
            'discount_amount' => round($discount_amount, 2),
            'passenger_name'  => $passenger_name,
            'passenger_phone' => $passenger_phone,
            'passenger_email' => $passenger_email,
            'notes'           => $notes,
            'booking_status'  => 'new',
            'payment_status'  => 'pending'
        );

        $created_id = $this->Booking_model->create_booking($booking_data);

        $this->json_response(array(
            'status'     => true,
            'message'    => 'Booking request created successfully!',
            'booking_id' => $booking_id,
            'booking'    => $booking_data
        ));
    }

    // GET /api/my_bookings
    public function my_bookings() {
        $phone = $this->input->get('phone');
        $customer_id = $this->input->get('customer_id');

        if (empty($phone) && empty($customer_id)) {
            $this->json_response(array('status' => false, 'message' => 'Phone or Customer ID is required.'), 400);
        }

        $this->db->group_start();
        if (!empty($phone)) $this->db->where('passenger_phone', trim($phone));
        if (!empty($customer_id)) $this->db->or_where('customer_id', intval($customer_id));
        $this->db->group_end();
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('bookings');
        $bookings = $query->result_array();

        $this->json_response(array(
            'status' => true,
            'count'  => count($bookings),
            'data'   => $bookings
        ));
    }

    // GET /api/booking_detail/$booking_id
    public function booking_detail($booking_id = null) {
        if (empty($booking_id)) {
            $booking_id = $this->input->get('booking_id');
        }

        if (empty($booking_id)) {
            $this->json_response(array('status' => false, 'message' => 'Booking ID is required.'), 400);
        }

        $booking = $this->Booking_model->get_booking_by_id($booking_id);
        if (!$booking) {
            $this->json_response(array('status' => false, 'message' => 'Booking not found.'), 404);
        }

        $driver = array(
            'name'           => 'Murugan K.',
            'phone'          => '+91 98401 23456',
            'rating'         => 4.9,
            'vehicle_number' => 'TN 01 AB 7890',
            'vehicle_model'  => $booking['vehicle_name'],
            'driver_lat'     => 13.0827,
            'driver_lng'     => 80.2707,
            'eta_minutes'    => 8
        );

        $this->json_response(array(
            'status'  => true,
            'data'    => $booking,
            'driver'  => $driver
        ));
    }

    // POST /api/cancel_booking
    public function cancel_booking() {
        $input = $this->get_post_input();
        $booking_id = isset($input['booking_id']) ? trim($input['booking_id']) : '';

        if (empty($booking_id)) {
            $this->json_response(array('status' => false, 'message' => 'Booking ID is required.'), 400);
        }

        $booking = $this->Booking_model->get_booking_by_id($booking_id);
        if (!$booking) {
            $this->json_response(array('status' => false, 'message' => 'Booking not found.'), 404);
        }

        $this->Booking_model->update_booking($booking_id, array('booking_status' => 'cancelled'));

        $this->json_response(array(
            'status' => true,
            'message' => 'Booking ' . $booking_id . ' has been cancelled successfully.'
        ));
    }

    // POST /api/apply_coupon
    public function apply_coupon() {
        $input = $this->get_post_input();
        $code   = isset($input['code']) ? trim($input['code']) : '';
        $amount = isset($input['amount']) ? floatval($input['amount']) : 0.0;

        if (empty($code)) {
            $this->json_response(array('status' => false, 'message' => 'Coupon code is required.'), 400);
        }

        $res = $this->Coupon_model->validate_coupon($code, $amount);
        $this->json_response($res);
    }

    // ================================================================
    // DRIVER APP API ENDPOINTS
    // ================================================================

    /**
     * POST /api/driver_send_otp
     * Send OTP to driver phone for login / self-registration
     */
    public function driver_send_otp() {
        $input = $this->get_post_input();
        $name  = isset($input['name']) ? trim($input['name']) : '';
        $phone = isset($input['phone']) ? trim($input['phone']) : '';

        if (empty($phone)) {
            $this->json_response(array('status' => false, 'message' => 'Phone number is required.'), 400);
        }


        $res = $this->Driver_model->create_or_update_otp($name, $phone);
        $this->json_response($res);
    }

    /**
     * POST /api/driver_verify_otp
     * Verify OTP and return driver profile
     */
    public function driver_verify_otp() {
        $input = $this->get_post_input();
        $phone = isset($input['phone']) ? trim($input['phone']) : '';
        $otp   = isset($input['otp']) ? trim($input['otp']) : '';

        if (empty($phone) || empty($otp)) {
            $this->json_response(array('status' => false, 'message' => 'Phone and OTP are required.'), 400);
        }


        $res = $this->Driver_model->verify_otp($phone, $otp);
        $this->json_response($res);
    }

    /**
     * GET /api/driver_profile?driver_id=X
     * Get driver profile details
     */
    public function driver_profile() {
        $driver_id = $this->input->get('driver_id');
        if (empty($driver_id)) {
            $this->json_response(array('status' => false, 'message' => 'Driver ID is required.'), 400);
        }

        $driver = $this->Driver_model->get_driver_by_id(intval($driver_id));
        if (!$driver) {
            $this->json_response(array('status' => false, 'message' => 'Driver not found.'), 404);
        }

        // Add full URLs for document paths
        $doc_fields = array('licence_doc', 'aadhar_doc', 'pan_card_doc', 'bank_account_doc', 'profile_photo');
        foreach ($doc_fields as $field) {
            if (!empty($driver[$field])) {
                $driver[$field . '_url'] = base_url($driver[$field]);
            } else {
                $driver[$field . '_url'] = null;
            }
        }

        $this->json_response(array('status' => true, 'driver' => $driver));
    }

    /**
     * POST /api/driver_update_profile
     * Update driver profile info
     */
    public function driver_update_profile() {
        $input = $this->get_post_input();
        $driver_id = isset($input['driver_id']) ? intval($input['driver_id']) : 0;

        if (empty($driver_id)) {
            $this->json_response(array('status' => false, 'message' => 'Driver ID is required.'), 400);
        }

        $driver = $this->Driver_model->get_driver_by_id($driver_id);
        if (!$driver) {
            $this->json_response(array('status' => false, 'message' => 'Driver not found.'), 404);
        }

        $update_data = array();
        if (isset($input['name']) && !empty(trim($input['name']))) {
            $update_data['name'] = trim($input['name']);
        }
        if (isset($input['email'])) {
            $update_data['email'] = trim($input['email']);
        }
        if (isset($input['vehicle_number'])) {
            $update_data['vehicle_number'] = trim($input['vehicle_number']);
        }
        if (isset($input['vehicle_type'])) {
            $update_data['vehicle_type'] = trim($input['vehicle_type']);
        }

        if (empty($update_data)) {
            $this->json_response(array('status' => false, 'message' => 'No data to update.'), 400);
        }

        $this->Driver_model->update_driver($driver_id, $update_data);
        $updated_driver = $this->Driver_model->get_driver_by_id($driver_id);

        $this->json_response(array(
            'status'  => true,
            'message' => 'Profile updated successfully!',
            'driver'  => $updated_driver
        ));
    }

    /**
     * POST /api/driver_upload_document
     * Upload a document (multipart form-data)
     * Fields: driver_id, doc_type (licence_doc|aadhar_doc|pan_card_doc|bank_account_doc|profile_photo)
     */
    public function driver_upload_document() {
        $driver_id = $this->input->post('driver_id');
        $doc_type  = $this->input->post('doc_type');

        if (empty($driver_id) || empty($doc_type)) {
            $this->json_response(array('status' => false, 'message' => 'driver_id and doc_type are required.'), 400);
        }

        $valid_types = array('licence_doc', 'aadhar_doc', 'pan_card_doc', 'bank_account_doc', 'profile_photo');
        if (!in_array($doc_type, $valid_types)) {
            $this->json_response(array('status' => false, 'message' => 'Invalid doc_type. Valid: ' . implode(', ', $valid_types)), 400);
        }

        $driver = $this->Driver_model->get_driver_by_id(intval($driver_id));
        if (!$driver) {
            $this->json_response(array('status' => false, 'message' => 'Driver not found.'), 404);
        }

        $upload_path = FCPATH . 'uploads/drivers/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }

        $config = array(
            'upload_path'   => $upload_path,
            'allowed_types' => 'jpg|jpeg|png|pdf|webp',
            'max_size'      => 5120, // 5MB
            'file_name'     => $doc_type . '_' . $driver_id . '_' . time()
        );

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('document')) {
            $this->json_response(array('status' => false, 'message' => $this->upload->display_errors('', '')), 400);
        }

        $upload_data = $this->upload->data();
        $file_path = 'uploads/drivers/' . $upload_data['file_name'];

        // Delete old file if exists
        if (!empty($driver[$doc_type]) && file_exists(FCPATH . $driver[$doc_type])) {
            unlink(FCPATH . $driver[$doc_type]);
        }

        $this->Driver_model->update_driver($driver_id, array($doc_type => $file_path));
        $updated_driver = $this->Driver_model->get_driver_by_id($driver_id);

        $this->json_response(array(
            'status'   => true,
            'message'  => 'Document uploaded successfully!',
            'file_url' => base_url($file_path),
            'driver'   => $updated_driver
        ));
    }

    /**
     * POST /api/driver_update_fcm
     * Update FCM token for push notifications
     */
    public function driver_update_fcm() {
        $input = $this->get_post_input();
        $driver_id = isset($input['driver_id']) ? intval($input['driver_id']) : 0;
        $fcm_token = isset($input['fcm_token']) ? trim($input['fcm_token']) : '';

        if (empty($driver_id) || empty($fcm_token)) {
            $this->json_response(array('status' => false, 'message' => 'driver_id and fcm_token are required.'), 400);
        }

        $this->Driver_model->update_fcm_token($driver_id, $fcm_token);

        $this->json_response(array('status' => true, 'message' => 'FCM token updated successfully.'));
    }

    /**
     * GET /api/driver_new_bookings
     * Get all new/unassigned bookings available for drivers
     */
    public function driver_new_bookings() {
        $bookings = $this->Booking_model->get_new_bookings();
        $this->json_response(array(
            'status' => true,
            'count'  => count($bookings),
            'data'   => $bookings
        ));
    }

    /**
     * POST /api/driver_accept_booking
     * Driver accepts a booking (first-come-first-served)
     */
    public function driver_accept_booking() {
        $input = $this->get_post_input();
        $booking_id = isset($input['booking_id']) ? trim($input['booking_id']) : '';
        $driver_id  = isset($input['driver_id']) ? intval($input['driver_id']) : 0;

        if (empty($booking_id) || empty($driver_id)) {
            $this->json_response(array('status' => false, 'message' => 'booking_id and driver_id are required.'), 400);
        }

        $driver = $this->Driver_model->get_driver_by_id($driver_id);
        if (!$driver) {
            $this->json_response(array('status' => false, 'message' => 'Driver not found.'), 404);
        }

        $res = $this->Booking_model->assign_driver(
            $booking_id,
            $driver_id,
            $driver['name'],
            $driver['phone']
        );

        $this->json_response($res);
    }

    /**
     * GET /api/driver_my_bookings?driver_id=X&status=Y
     * Get bookings assigned to a specific driver
     */
    public function driver_my_bookings() {
        $driver_id = $this->input->get('driver_id');
        $status    = $this->input->get('status');

        if (empty($driver_id)) {
            $this->json_response(array('status' => false, 'message' => 'driver_id is required.'), 400);
        }

        $bookings = $this->Booking_model->get_driver_bookings(intval($driver_id), $status);

        $this->json_response(array(
            'status' => true,
            'count'  => count($bookings),
            'data'   => $bookings
        ));
    }

    /**
     * POST /api/driver_update_trip_status
     * Update trip status: assigned -> picked_up -> completed
     */
    public function driver_update_trip_status() {
        $input = $this->get_post_input();
        $booking_id = isset($input['booking_id']) ? trim($input['booking_id']) : '';
        $driver_id  = isset($input['driver_id']) ? intval($input['driver_id']) : 0;
        $new_status = isset($input['status']) ? trim($input['status']) : '';

        if (empty($booking_id) || empty($driver_id) || empty($new_status)) {
            $this->json_response(array('status' => false, 'message' => 'booking_id, driver_id, and status are required.'), 400);
        }

        $valid_statuses = array('picked_up', 'completed');
        if (!in_array($new_status, $valid_statuses)) {
            $this->json_response(array('status' => false, 'message' => 'Invalid status. Valid: picked_up, completed'), 400);
        }

        $res = $this->Booking_model->update_trip_status($booking_id, $driver_id, $new_status);
        $this->json_response($res);
    }

    private function normalize_phonetic($str) {
        $str = strtolower(trim($str));
        $replaces = array(
            'au' => 'u', 'oo' => 'u', 'ee' => 'i', 'ai' => 'y',
            'dh' => 'd', 'th' => 't', 'gh' => 'g', 'kh' => 'k',
            'bh' => 'b', 'ph' => 'p', 'ch' => 'c', 'sh' => 's',
            'zh' => 'z', 'll' => 'l', 'pp' => 'p', 'tt' => 't',
            'rr' => 'r', 'mm' => 'm', 'nn' => 'n'
        );
        $str = strtr($str, $replaces);
        return preg_replace('/[^a-z0-9]/', '', $str);
    }
}
