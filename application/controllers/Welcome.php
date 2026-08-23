<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url', 'form', 'email_helper'));
		$this->load->library('session');
		$this->load->model('Vehicle_model');
		$this->load->model('Booking_model');
		$this->load->model('Setting_model');
		$this->load->model('Enquiry_model');
		$this->load->model('Coupon_model');
		$this->load->model('Customer_model');
		$this->load->model('Blog_model');
	}

	public function index()
	{
		$data['vehicles']     = $this->Vehicle_model->get_all_vehicles(true);
		$data['settings']     = $this->Setting_model->get_all_settings();
		$data['recent_blogs'] = $this->Blog_model->get_recent_blogs(3);
		$this->load->view('home', $data);
	}

	public function calculate_fare()
	{
		$trip_type    = $this->input->post('trip_type'); // oneway or roundtrip
		$vehicle_type = $this->input->post('vehicle_type');
		$distance_km  = floatval($this->input->post('distance_km')); // one-way distance
		$pickup_date  = $this->input->post('pickup_date');
		$return_date  = $this->input->post('return_date');
		$coupon_code  = strtoupper(trim($this->input->post('coupon_code')));

		$vehicle = $this->Vehicle_model->get_vehicle_by_type($vehicle_type);
		if (!$vehicle) {
			echo json_encode(array('status' => false, 'message' => 'Invalid vehicle selected'));
			return;
		}

		if ($trip_type === 'oneway') {
			$per_km = floatval($vehicle['per_km_oneway']);
			$min_km = intval($vehicle['min_km_oneway']);
			$driver_batta = floatval($vehicle['driver_batta_oneway']);
			$effective_distance = $distance_km;
		} else {
			$per_km = floatval($vehicle['per_km_roundtrip']);
			$min_km = intval($vehicle['min_km_roundtrip']);
			$driver_batta = floatval($vehicle['driver_batta_roundtrip']);
			$effective_distance = $distance_km * 2; // Return trip total distance
		}

		// Calculate estimated toll count and toll price
		$toll_count = 0;
		$estimated_toll_fee = 0;
		if ($distance_km > 40) {
			$one_way_tolls = max(1, round($distance_km / 55));
			$toll_rate_per_gate = 85;
			if ($vehicle_type === 'suv') {
				$toll_rate_per_gate = 105;
			} else if ($vehicle_type === 'innova') {
				$toll_rate_per_gate = 115;
			} else if ($vehicle_type === 'tempo') {
				$toll_rate_per_gate = 140;
			}

			if ($trip_type === 'oneway') {
				$toll_count = $one_way_tolls;
				$estimated_toll_fee = $toll_count * $toll_rate_per_gate;
			} else {
				$toll_count = $one_way_tolls * 2;
				$is_same_day = (empty($return_date) || $return_date === $pickup_date);
				$multiplier = $is_same_day ? 1.5 : 2.0;
				$estimated_toll_fee = round($one_way_tolls * $toll_rate_per_gate * $multiplier);
			}
		}

		$billable_km = max($effective_distance, $min_km);
		$km_fare = $billable_km * $per_km;
		$subtotal = $km_fare + $driver_batta + $estimated_toll_fee + floatval($vehicle['base_fare']);

		// Validate Coupon if supplied
		$discount_amount = 0;
		$coupon_applied  = false;
		$coupon_message  = '';
		if (!empty($coupon_code)) {
			$passenger_phone = $this->input->post('passenger_phone');
			$passenger_email = $this->input->post('passenger_email');
			$coupon_res = $this->Coupon_model->validate_coupon($coupon_code, $subtotal, $passenger_phone, $passenger_email);
			if ($coupon_res['status']) {
				$discount_amount = $coupon_res['discount_amount'];
				$coupon_applied  = true;
				$coupon_message  = $coupon_res['message'];
			} else {
				$coupon_message  = $coupon_res['message'];
			}
		}

		$estimated_total = max(0, $subtotal - $discount_amount);

		echo json_encode(array(
			'status'             => true,
			'vehicle_name'       => $vehicle['name'],
			'distance_km'        => $distance_km,
			'effective_distance' => $effective_distance,
			'billable_km'        => $billable_km,
			'per_km_rate'        => $per_km,
			'km_fare'            => round($km_fare, 2),
			'driver_batta'       => round($driver_batta, 2),
			'base_fare'          => floatval($vehicle['base_fare']),
			'subtotal'           => round($subtotal, 2),
			'toll_count'         => $toll_count,
			'estimated_toll_fee' => round($estimated_toll_fee, 2),
			'coupon_code'        => $coupon_code,
			'coupon_applied'     => $coupon_applied,
			'coupon_message'     => $coupon_message,
			'discount_amount'    => round($discount_amount, 2),
			'estimated_total'    => round($estimated_total, 2)
		));
	}

	public function create_booking()
	{
		$trip_type       = $this->input->post('trip_type');
		$pickup_location = $this->input->post('pickup_location');
		$drop_location   = $this->input->post('drop_location');
		$pickup_date     = $this->input->post('pickup_date');
		$pickup_time     = $this->input->post('pickup_time');
		$return_date     = $this->input->post('return_date');
		$vehicle_type    = $this->input->post('vehicle_type');
		$distance_km     = floatval($this->input->post('distance_km'));

		$passenger_name  = $this->input->post('passenger_name');
		$passenger_phone = $this->input->post('passenger_phone');
		$passenger_email = $this->input->post('passenger_email');
		$notes           = $this->input->post('notes');
		$coupon_code     = strtoupper(trim($this->input->post('coupon_code')));

		if (empty($pickup_location) || empty($drop_location) || empty($pickup_date) || empty($passenger_name) || empty($passenger_phone)) {
			echo json_encode(array('status' => false, 'message' => 'Please fill in all required fields.'));
			return;
		}

		$vehicle = $this->Vehicle_model->get_vehicle_by_type($vehicle_type);
		if (!$vehicle) {
			$vehicle = $this->Vehicle_model->get_vehicle_by_id(1);
		}

		if ($trip_type === 'oneway') {
			$per_km = floatval($vehicle['per_km_oneway']);
			$min_km = intval($vehicle['min_km_oneway']);
			$driver_batta = floatval($vehicle['driver_batta_oneway']);
			$effective_distance = $distance_km;
		} else {
			$per_km = floatval($vehicle['per_km_roundtrip']);
			$min_km = intval($vehicle['min_km_roundtrip']);
			$driver_batta = floatval($vehicle['driver_batta_roundtrip']);
			$effective_distance = $distance_km * 2;
		}

		$billable_km = max($effective_distance, $min_km);
		
		$toll_count = 0;
		$estimated_toll_fee = 0;
		if ($distance_km > 40) {
			$one_way_tolls = max(1, round($distance_km / 55));
			$toll_rate_per_gate = 85;
			if ($vehicle_type === 'suv') {
				$toll_rate_per_gate = 105;
			} else if ($vehicle_type === 'innova') {
				$toll_rate_per_gate = 115;
			} else if ($vehicle_type === 'tempo') {
				$toll_rate_per_gate = 140;
			}

			if ($trip_type === 'oneway') {
				$estimated_toll_fee = $one_way_tolls * $toll_rate_per_gate;
			} else {
				$is_same_day = (empty($return_date) || $return_date === $pickup_date);
				$multiplier = $is_same_day ? 1.5 : 2.0;
				$estimated_toll_fee = round($one_way_tolls * $toll_rate_per_gate * $multiplier);
			}
		}

		$subtotal = ($billable_km * $per_km) + $driver_batta + $estimated_toll_fee + floatval($vehicle['base_fare']);

		$discount_amount = 0;
		if (!empty($coupon_code)) {
			$coupon_res = $this->Coupon_model->validate_coupon($coupon_code, $subtotal, $passenger_phone, $passenger_email);
			if ($coupon_res['status']) {
				$discount_amount = $coupon_res['discount_amount'];
			}
		}

		$estimated_total = max(0, $subtotal - $discount_amount);
		$booking_id = $this->Booking_model->generate_booking_id();

		// Attach or create customer profile
		$customer_id = $this->session->userdata('customer_id');
		if (!$customer_id) {
			$customer = $this->Customer_model->get_customer_by_phone($passenger_phone);
			if (!$customer) {
				$this->Customer_model->create_or_update_otp($passenger_name, $passenger_phone, $passenger_email);
				$customer = $this->Customer_model->get_customer_by_phone($passenger_phone);
			}
			if ($customer) {
				$customer_id = $customer['id'];
				$this->session->set_userdata(array(
					'customer_logged_in' => true,
					'customer_id'        => $customer['id'],
					'customer_name'      => $customer['name'],
					'customer_phone'     => $customer['phone'],
					'customer_email'     => $customer['email']
				));
			}
		}

		$booking_data = array(
			'booking_id'      => $booking_id,
			'trip_type'       => $trip_type === 'oneway' ? 'One Way Drop' : 'Outstation Round Trip',
			'pickup_location' => $pickup_location,
			'drop_location'   => $drop_location,
			'pickup_date'     => $pickup_date,
			'pickup_time'     => $pickup_time ? $pickup_time : '09:00',
			'return_date'     => !empty($return_date) ? $return_date : null,
			'vehicle_id'      => $vehicle['id'],
			'customer_id'     => $customer_id,
			'vehicle_name'    => $vehicle['name'],
			'distance_km'     => $distance_km,
			'per_km_rate'     => $per_km,
			'driver_batta'    => $driver_batta,
			'toll_fee'        => $estimated_toll_fee,
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

		$this->Booking_model->create_booking($booking_data);

		// Send SMTP Email Notification to Passenger
		if (!empty($passenger_email)) {
			$subject = "Booking Confirmation - " . $booking_id . " | DropTaxi";
			$email_body = "
			<div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden;'>
				<div style='background-color: #f59e0b; color: #000; padding: 20px; text-align: center;'>
					<h2 style='margin: 0; font-size: 24px;'>DropTaxi Booking Confirmation</h2>
					<p style='margin: 5px 0 0; font-weight: bold;'>Booking ID: {$booking_id}</p>
				</div>
				<div style='padding: 25px; color: #334155;'>
					<p>Dear <strong>{$passenger_name}</strong>,</p>
					<p>Thank you for booking with DropTaxi! Your trip request has been received and confirmed.</p>
					
					<table style='width: 100%; border-collapse: collapse; margin-top: 15px;'>
						<tr style='background-color: #f8fafc;'><td style='padding: 10px; font-weight: bold;'>Trip Type:</td><td style='padding: 10px;'>{$booking_data['trip_type']}</td></tr>
						<tr><td style='padding: 10px; font-weight: bold;'>Pickup Location:</td><td style='padding: 10px;'>{$pickup_location}</td></tr>
						<tr style='background-color: #f8fafc;'><td style='padding: 10px; font-weight: bold;'>Drop Location:</td><td style='padding: 10px;'>{$drop_location}</td></tr>
						<tr><td style='padding: 10px; font-weight: bold;'>Pickup Date & Time:</td><td style='padding: 10px;'>{$pickup_date} at {$pickup_time}</td></tr>
						<tr style='background-color: #f8fafc;'><td style='padding: 10px; font-weight: bold;'>Vehicle:</td><td style='padding: 10px;'>{$vehicle['name']}</td></tr>
						<tr><td style='padding: 10px; font-weight: bold;'>Estimated Fare:</td><td style='padding: 10px; font-weight: bold; color: #16a34a;'>₹" . number_format($estimated_total, 2) . "</td></tr>
					</table>
					
					<p style='margin-top: 20px;'>Our driver will be assigned shortly and contact you before pickup.</p>
				</div>
				<div style='background-color: #0f172a; color: #94a3b8; padding: 15px; text-align: center; font-size: 12px;'>
					Need Help? Call Us 24/7 at +91 98765 43210 | DropTaxi Services
				</div>
			</div>";

			send_smtp_email($passenger_email, $subject, $email_body);
		}

		// Also notify Admin
		$admin_email = $this->Setting_model->get_setting('contact_email', 'admin@droptaxi.com');
		if (!empty($admin_email)) {
			$admin_subject = "NEW BOOKING RECEIVED - " . $booking_id;
			$admin_body = "<h3>New Taxi Booking Alert</h3><p>Booking ID: {$booking_id}</p><p>Passenger: {$passenger_name} ({$passenger_phone})</p><p>Route: {$pickup_location} to {$drop_location}</p><p>Vehicle: {$vehicle['name']}</p><p>Estimated Fare: ₹{$estimated_total}</p>";
			send_smtp_email($admin_email, $admin_subject, $admin_body);
		}

		echo json_encode(array(
			'status' => true,
			'booking_id' => $booking_id,
			'redirect_url' => base_url('welcome/booking_status/' . $booking_id)
		));
	}

	public function booking_status($booking_id)
	{
		$data['booking'] = $this->Booking_model->get_booking_by_id($booking_id);
		if (!$data['booking']) {
			show_404();
			return;
		}
		$data['settings'] = $this->Setting_model->get_all_settings();
		$this->load->view('booking_confirmation', $data);
	}

	public function create_razorpay_order()
	{
		$booking_id = $this->input->post('booking_id');
		$booking = $this->Booking_model->get_booking_by_id($booking_id);

		if (!$booking) {
			echo json_encode(array('status' => false, 'message' => 'Invalid booking ID'));
			return;
		}

		$this->load->library('Razorpay_lib');
		$res = $this->razorpay_lib->create_order($booking['estimated_fare'], $booking_id);

		if ($res['status']) {
			$this->Booking_model->update_booking($booking_id, array(
				'razorpay_order_id' => $res['order']['id']
			));
			echo json_encode(array(
				'status' => true,
				'order_id' => $res['order']['id'],
				'amount' => $res['order']['amount'],
				'key_id' => $res['key_id'],
				'passenger_name' => $booking['passenger_name'],
				'passenger_email' => $booking['passenger_email'],
				'passenger_phone' => $booking['passenger_phone']
			));
		} else {
			echo json_encode(array('status' => false, 'message' => $res['message']));
		}
	}

	public function verify_payment()
	{
		$booking_id          = $this->input->post('booking_id');
		$razorpay_order_id   = $this->input->post('razorpay_order_id');
		$razorpay_payment_id = $this->input->post('razorpay_payment_id');
		$razorpay_signature  = $this->input->post('razorpay_signature');

		$this->load->library('Razorpay_lib');
		$valid = $this->razorpay_lib->verify_signature($razorpay_order_id, $razorpay_payment_id, $razorpay_signature);

		if ($valid) {
			$this->Booking_model->update_booking($booking_id, array(
				'payment_status' => 'paid',
				'payment_id'     => $razorpay_payment_id,
				'booking_status' => 'confirmed'
			));
			echo json_encode(array('status' => true, 'message' => 'Payment verified successfully!'));
		} else {
			echo json_encode(array('status' => false, 'message' => 'Payment verification failed. Invalid signature.'));
		}
	}

	public function save_enquiry()
	{
		$name    = $this->input->post('name');
		$email   = $this->input->post('email');
		$phone   = $this->input->post('phone');
		$subject = $this->input->post('subject');
		$message = $this->input->post('message');

		if (empty($name) || empty($phone)) {
			$this->session->set_flashdata('error', 'Please provide your name and phone number.');
			redirect('welcome#contact');
			return;
		}

		$data = array(
			'name'    => $name,
			'email'   => $email,
			'phone'   => $phone,
			'subject' => $subject ? $subject : 'Website Inquiry',
			'message' => $message,
			'status'  => 'unread'
		);

		$this->Enquiry_model->save_enquiry($data);
		$this->session->set_flashdata('success', 'Thank you! Your enquiry has been submitted. We will contact you shortly.');
		redirect('welcome#contact');
	}

	public function send_otp()
	{
		$name  = $this->input->post('name');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');

		if (empty($phone)) {
			echo json_encode(array('status' => false, 'message' => 'Please enter a valid phone number.'));
			return;
		}

		$res = $this->Customer_model->create_or_update_otp($name, $phone, $email);
		echo json_encode($res);
	}

	public function verify_otp()
	{
		$phone = $this->input->post('phone');
		$otp   = $this->input->post('otp');

		if (empty($phone) || empty($otp)) {
			echo json_encode(array('status' => false, 'message' => 'Please enter both phone number and OTP code.'));
			return;
		}

		$res = $this->Customer_model->verify_otp($phone, $otp);
		if ($res['status']) {
			$c = $res['customer'];
			$this->session->set_userdata(array(
				'customer_logged_in' => true,
				'customer_id'        => $c['id'],
				'customer_name'      => $c['name'],
				'customer_phone'     => $c['phone'],
				'customer_email'     => $c['email']
			));
		}
		echo json_encode($res);
	}

	public function customer_logout()
	{
		$this->session->unset_userdata(array('customer_logged_in', 'customer_id', 'customer_name', 'customer_phone', 'customer_email'));
		echo json_encode(array('status' => true, 'message' => 'Logged out successfully!'));
	}

	public function get_distance()
	{
		$pickup = trim($this->input->post('pickup') ?: $this->input->get('pickup'));
		$drop   = trim($this->input->post('drop') ?: $this->input->get('drop'));

		if (empty($pickup) || empty($drop)) {
			echo json_encode(array('status' => false, 'message' => 'Both pickup and drop locations are required.'));
			return;
		}

		$distance = $this->calculate_route_distance($pickup, $drop);
		echo json_encode(array(
			'status' => true,
			'distance_km' => $distance,
			'pickup' => $pickup,
			'drop' => $drop
		));
	}

	public function places_autocomplete()
	{
		$input = trim($this->input->get('input') ?: $this->input->post('input'));
		if (empty($input)) {
			echo json_encode(array('status' => true, 'input' => '', 'predictions' => array()));
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

		// 2. Comprehensive South India & Tamil Nadu curated areas and places
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

		usort($local_matches, function($a, $b) {
			return $a['score'] - $b['score'];
		});

		foreach ($local_matches as $m) {
			unset($m['score']);
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

		// 3. OpenStreetMap Nominatim live search fallback
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

		if (empty($predictions)) {
			$predictions[] = array(
				'description'    => ucfirst($input) . ', Tamil Nadu, India',
				'main_text'      => ucfirst($input),
				'secondary_text' => 'Tamil Nadu, India',
				'place_id'       => 'custom_' . time()
			);
		}

		echo json_encode(array(
			'status'      => true,
			'input'       => $input,
			'predictions' => array_slice($predictions, 0, 10)
		));
	}

	private function calculate_route_distance($pickup, $drop)
	{
		$p = strtolower($pickup);
		$d = strtolower($drop);

		// Area / Suburb mapping to primary city/hub
		$area_to_city = array(
			'melapalayam' => 'tirunelveli',
			'palayamkottai' => 'tirunelveli',
			'pettai' => 'tirunelveli',
			'thatchanallur' => 'tirunelveli',
			'vannarpettai' => 'tirunelveli',
			'samathanapuram' => 'tirunelveli',
			'perumalpuram' => 'tirunelveli',
			'high ground' => 'tirunelveli',
			'ktc nagar' => 'tirunelveli',
			'maharaja nagar' => 'tirunelveli',
			'ngo colony' => 'tirunelveli',
			'reddiarpatti' => 'tirunelveli',
			'ambasamudram' => 'tirunelveli',
			'kallidaikurichi' => 'tirunelveli',
			'cheranmahadevi' => 'tirunelveli',
			'kalakkad' => 'tirunelveli',
			'nanguneri' => 'tirunelveli',
			'valliyur' => 'tirunelveli',
			'tisayanvilai' => 'tirunelveli',
			'radhapuram' => 'tirunelveli',
			'kudankulam' => 'tirunelveli',
			'sankarankovil' => 'sankarankovil',
			'alangulam' => 'tenkasi',
			'surandai' => 'tenkasi',
			'kadayanallur' => 'tenkasi',
			'puliyangudi' => 'tenkasi',
			'sengottai' => 'tenkasi',
			'sivagiri' => 'tenkasi',
			'kutralam' => 'courtallam',
			'anna nagar' => 'chennai',
			't. nagar' => 'chennai',
			't nagar' => 'chennai',
			'thyagaraya nagar' => 'chennai',
			'velachery' => 'chennai',
			'guindy' => 'chennai',
			'tambaram' => 'chennai',
			'chromepet' => 'chennai',
			'pallavaram' => 'chennai',
			'porur' => 'chennai',
			'poonamallee' => 'chennai',
			'medavakkam' => 'chennai',
			'sholinganallur' => 'chennai',
			'omr' => 'chennai',
			'perungudi' => 'chennai',
			'thoraipakkam' => 'chennai',
			'navallur' => 'chennai',
			'siruseri' => 'chennai',
			'adyar' => 'chennai',
			'besant nagar' => 'chennai',
			'thiruvanmiyur' => 'chennai',
			'mylapore' => 'chennai',
			'nungambakkam' => 'chennai',
			'alwarpet' => 'chennai',
			'vadapalani' => 'chennai',
			'ashok nagar' => 'chennai',
			'saidapet' => 'chennai',
			'perambur' => 'chennai',
			'ambattur' => 'chennai',
			'avadi' => 'chennai',
			'kolathur' => 'chennai',
			'madhavaram' => 'chennai',
			'koyambedu' => 'chennai',
			'kilambakkam' => 'chennai',
			'gandhipuram' => 'coimbatore',
			'r.s. puram' => 'coimbatore',
			'rs puram' => 'coimbatore',
			'peelamedu' => 'coimbatore',
			'singanallur' => 'coimbatore',
			'saravanampatti' => 'coimbatore',
			'ganapathy' => 'coimbatore',
			'ukkadam' => 'coimbatore',
			'saibaba colony' => 'coimbatore',
			'thudiyalur' => 'coimbatore',
			'villapuram' => 'madurai',
			'avaniyapuram' => 'madurai',
			'munichalai' => 'madurai',
			'sellur' => 'madurai',
			'anaiyur' => 'madurai',
			'kochadai' => 'madurai',
			'ss colony' => 'madurai',
			'ponmeni' => 'madurai',
			'pasumalai' => 'madurai',
			'othakadai' => 'madurai',
			'tirumangalam' => 'madurai',
			'thirumangalam' => 'madurai',
			'mattuthavani' => 'madurai',
			'periyar bus stand' => 'madurai',
			'arappalayam' => 'madurai',
			'goripalayam' => 'madurai',
			'simmakkal' => 'madurai',
			'teppakulam' => 'madurai',
			'thiruparankundram' => 'madurai',
			'thirunagar' => 'madurai',
			'srirangam' => 'trichy',
			'thillai nagar' => 'trichy',
			'cantonment' => 'trichy',
			'chatram' => 'trichy',
			'thuvakudi' => 'trichy',
			'suramangalam' => 'salem',
			'fairlands' => 'salem',
			'hasthampatti' => 'salem',
			'meyyanur' => 'salem',
			'majestic' => 'bangalore',
			'indiranagar' => 'bangalore',
			'koramangala' => 'bangalore',
			'whitefield' => 'bangalore',
			'hsr layout' => 'bangalore',
			'electronic city' => 'bangalore',
			'jayanagar' => 'bangalore',
			'btm layout' => 'bangalore',
			'marathahalli' => 'bangalore',
			'yelahanka' => 'bangalore',
		);

		// Comprehensive Tamil Nadu & South India City Distance Matrix
		$city_coords = array(
			'chennai'        => array('lat' => 13.0827, 'lng' => 80.2707),
			'tirunelveli'    => array('lat' => 8.7139,  'lng' => 77.7567),
			'nellai'         => array('lat' => 8.7139,  'lng' => 77.7567),
			'madurai'        => array('lat' => 9.9252,  'lng' => 78.1198),
			'coimbatore'     => array('lat' => 11.0168, 'lng' => 76.9558),
			'trichy'         => array('lat' => 10.7905, 'lng' => 78.7047),
			'tiruchirappalli'=> array('lat' => 10.7905, 'lng' => 78.7047),
			'salem'          => array('lat' => 11.6643, 'lng' => 78.1460),
			'bangalore'      => array('lat' => 12.9716, 'lng' => 77.5946),
			'bengaluru'      => array('lat' => 12.9716, 'lng' => 77.5946),
			'pondicherry'    => array('lat' => 11.9416, 'lng' => 79.8083),
			'puducherry'     => array('lat' => 11.9416, 'lng' => 79.8083),
			'nagercoil'      => array('lat' => 8.1833,  'lng' => 77.4119),
			'kanyakumari'    => array('lat' => 8.0883,  'lng' => 77.5385),
			'tuticorin'      => array('lat' => 8.7642,  'lng' => 78.1348),
			'thoothukudi'    => array('lat' => 8.7642,  'lng' => 78.1348),
			'tiruppur'       => array('lat' => 11.1085, 'lng' => 77.3411),
			'erode'          => array('lat' => 11.3410, 'lng' => 77.7172),
			'thanjavur'      => array('lat' => 10.7870, 'lng' => 79.1378),
			'tanjore'        => array('lat' => 10.7870, 'lng' => 79.1378),
			'dindigul'       => array('lat' => 10.3673, 'lng' => 77.9803),
			'vellore'        => array('lat' => 12.9165, 'lng' => 79.1325),
			'tiruvannamalai' => array('lat' => 12.2253, 'lng' => 79.0747),
			'kanchipuram'    => array('lat' => 12.8342, 'lng' => 79.7036),
			'cuddalore'      => array('lat' => 11.7480, 'lng' => 79.7714),
			'kumbakonam'     => array('lat' => 10.9601, 'lng' => 79.3845),
			'karur'          => array('lat' => 10.9601, 'lng' => 78.0766),
			'theni'          => array('lat' => 10.0104, 'lng' => 77.4768),
			'sivakasi'       => array('lat' => 9.4533,  'lng' => 77.7971),
			'virudhunagar'   => array('lat' => 9.5680,  'lng' => 77.9624),
			'tenkasi'        => array('lat' => 8.9594,  'lng' => 77.3152),
			'courtallam'     => array('lat' => 8.9328,  'lng' => 77.2743),
			'kutralam'       => array('lat' => 8.9328,  'lng' => 77.2743),
			'karaikudi'      => array('lat' => 10.0667, 'lng' => 78.7833),
			'ramanathapuram' => array('lat' => 9.3639,  'lng' => 78.8395),
			'rameswaram'     => array('lat' => 9.2876,  'lng' => 79.3129),
			'nagapattinam'   => array('lat' => 10.7672, 'lng' => 79.8449),
			'velankanni'     => array('lat' => 10.6807, 'lng' => 79.8433),
			'hosur'          => array('lat' => 12.7409, 'lng' => 77.8253),
			'krishnagiri'    => array('lat' => 12.5186, 'lng' => 78.2137),
			'dharmapuri'     => array('lat' => 12.1211, 'lng' => 78.1582),
			'ooty'           => array('lat' => 11.4102, 'lng' => 76.6950),
			'kodaikanal'     => array('lat' => 10.2381, 'lng' => 77.4892),
			'pollachi'       => array('lat' => 10.6582, 'lng' => 77.0088),
			'namakkal'       => array('lat' => 11.2189, 'lng' => 78.1674),
			'pudukkottai'    => array('lat' => 10.3797, 'lng' => 78.8208),
			'chengalpattu'   => array('lat' => 12.6841, 'lng' => 79.9836),
			'villupuram'     => array('lat' => 11.9401, 'lng' => 79.4861),
			'mayiladuthurai' => array('lat' => 11.1075, 'lng' => 79.6524),
			'tiruvarur'      => array('lat' => 10.7725, 'lng' => 79.6365),
			'tiruchendur'    => array('lat' => 8.4958,  'lng' => 78.1218),
			'sankarankovil'  => array('lat' => 9.1714,  'lng' => 77.5326),
			'kovilpatti'     => array('lat' => 9.1751,  'lng' => 77.8687),
			'rajapalayam'    => array('lat' => 9.4532,  'lng' => 77.5539),
			'srivilliputhur' => array('lat' => 9.5107,  'lng' => 77.6335),
			'tirupati'       => array('lat' => 13.6288, 'lng' => 79.4192),
			'mysore'         => array('lat' => 12.2958, 'lng' => 76.6394),
			'kochi'          => array('lat' => 9.9312,  'lng' => 76.2673),
			'trivandrum'     => array('lat' => 8.5241,  'lng' => 76.9366)
		);

		// Popular highway exact calibrated route distances
		$direct_routes = array(
			'chennai___tirunelveli'     => 625,
			'chennai___nellai'          => 625,
			'chennai___bangalore'       => 350,
			'chennai___bengaluru'       => 350,
			'chennai___coimbatore'      => 510,
			'chennai___madurai'         => 465,
			'chennai___trichy'          => 330,
			'chennai___tiruchirappalli' => 330,
			'chennai___salem'           => 345,
			'chennai___pondicherry'     => 155,
			'chennai___puducherry'      => 155,
			'chennai___kanyakumari'     => 705,
			'chennai___nagercoil'       => 695,
			'chennai___thoothukudi'     => 600,
			'chennai___tuticorin'       => 600,
			'chennai___vellore'         => 140,
			'chennai___erode'           => 430,
			'chennai___tiruppur'        => 470,
			'chennai___thanjavur'       => 345,
			'chennai___dindigul'        => 425,
			'chennai___tiruvannamalai'  => 195,
			'chennai___kumbakonam'      => 295,
			'chennai___tenkasi'         => 650,
			'chennai___courtallam'      => 655,
			'chennai___ooty'            => 555,
			'chennai___kodaikanal'      => 525,
			'chennai___rameswaram'      => 560,
			'chennai___tirupati'        => 135,
			'chennai___hosur'           => 305,
			'chennai___cuddalore'       => 185,
			'chennai___karur'           => 395,
			'chennai___theni'           => 495,
			'chennai___sivakasi'        => 540,
			'chennai___virudhunagar'    => 510,
			'chennai___nagapattinam'    => 320,
			'chennai___velankanni'      => 330,
			'chennai___tiruchendur'     => 640,
			'bangalore___coimbatore'    => 365,
			'bangalore___madurai'       => 435,
			'bangalore___tirunelveli'   => 595,
			'bangalore___trichy'        => 335,
			'bangalore___salem'         => 205,
			'bangalore___pondicherry'   => 310,
			'coimbatore___madurai'      => 215,
			'coimbatore___tirunelveli'  => 365,
			'coimbatore___trichy'       => 215,
			'coimbatore___salem'        => 165,
			'coimbatore___ooty'         => 85,
			'madurai___tirunelveli'     => 160,
			'madurai___trichy'          => 135,
			'madurai___salem'           => 235,
			'madurai___kanyakumari'     => 240,
			'madurai___rameswaram'      => 170,
			'madurai___kodaikanal'      => 115,
			'madurai___theni'           => 75,
			'tirunelveli___kanyakumari' => 85,
			'tirunelveli___nagercoil'   => 75,
			'tirunelveli___thoothukudi' => 50,
			'tirunelveli___tenkasi'     => 55,
			'tirunelveli___courtallam'  => 60,
			'tirunelveli___trivandrum'  => 145,
			'trichy___thanjavur'        => 55,
			'trichy___kumbakonam'       => 90,
			'salem___erode'             => 65,
			'salem___yercaud'           => 30
		);

		// Check area aliases first
		$found_p = null;
		$found_d = null;

		foreach ($area_to_city as $area => $mapped_city) {
			if ($found_p === null && stripos($p, $area) !== false) {
				$found_p = $mapped_city;
			}
			if ($found_d === null && stripos($d, $area) !== false) {
				$found_d = $mapped_city;
			}
		}

		// Check direct substring matches for key cities
		foreach ($city_coords as $city => $coord) {
			if ($found_p === null && stripos($p, $city) !== false) {
				$found_p = $city;
			}
			if ($found_d === null && stripos($d, $city) !== false) {
				$found_d = $city;
			}
		}

		if ($found_p && $found_d) {
			$pair1 = $found_p . '___' . $found_d;
			$pair2 = $found_d . '___' . $found_p;

			if (isset($direct_routes[$pair1])) {
				return $direct_routes[$pair1];
			}
			if (isset($direct_routes[$pair2])) {
				return $direct_routes[$pair2];
			}

			// Calculate Haversine distance with road curvature factor (1.26x)
			$lat1 = $city_coords[$found_p]['lat'];
			$lon1 = $city_coords[$found_p]['lng'];
			$lat2 = $city_coords[$found_d]['lat'];
			$lon2 = $city_coords[$found_d]['lng'];

			$earth_radius = 6371; // km
			$dLat = deg2rad($lat2 - $lat1);
			$dLon = deg2rad($lon2 - $lon1);
			$a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
			$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
			$air_dist = $earth_radius * $c;

			// Road distance factor in South India is approximately 1.25x
			$road_dist = max(20, round($air_dist * 1.25));
			return $road_dist;
		}

		return 150; // Fallback only if no recognized cities
	}

	private function get_curated_places()
	{
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

	private function normalize_phonetic($str)
	{
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


