<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller {

    private $secret_key = 'droptaxi2026'; // Secret key to allow migration via URL

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->dbforge();
        $this->load->library('session');
        $this->load->helper(array('url', 'html'));
        $this->load->model('Setting_model');
    }

    private function check_access()
    {
        // 1. Check if logged in as Admin
        if ($this->session->userdata('admin_logged_in')) {
            return true;
        }

        // 2. Check secret migration key via GET or POST
        $key = $this->input->get('key') ?: $this->input->post('key');
        if (!empty($key) && $key === $this->secret_key) {
            return true;
        }

        return false;
    }

    public function index()
    {
        if (!$this->check_access()) {
            http_response_code(403);
            echo '<!DOCTYPE html><html><head><title>403 Access Denied</title>';
            echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">';
            echo '</head><body class="bg-light d-flex align-items-center justify-content-center" style="min-height:100vh;">';
            echo '<div class="card shadow-sm border-0 p-4" style="max-width: 480px; border-radius: 16px;">';
            echo '<div class="text-center mb-3"><i class="text-danger" style="font-size: 3rem;">🔒</i></div>';
            echo '<h4 class="fw-bold text-center text-dark">Database Migration Protected</h4>';
            echo '<p class="text-secondary text-center small">To run database updates, please login to Admin or provide the secure migration key.</p>';
            echo '<form method="GET" action="' . base_url('migrate') . '">';
            echo '<div class="mb-3"><input type="password" name="key" class="form-control" placeholder="Enter Migration Secret Key" required></div>';
            echo '<button type="submit" class="btn btn-warning w-100 fw-bold">Authenticate & Run Migration</button>';
            echo '</form>';
            echo '<div class="text-center mt-3"><a href="' . base_url('admin/login') . '" class="small text-muted">Or Login as Admin</a></div>';
            echo '</div></body></html>';
            return;
        }

        $logs = array();
        $format = $this->input->get('format');

        // Step 1: Create or verify Tables
        $logs[] = $this->verify_tables();

        // Step 2: Verify and add any missing columns
        $logs = array_merge($logs, $this->verify_columns());

        // Step 3: Seed / verify essential settings
        $logs[] = $this->verify_settings();

        // Step 4: Verify default vehicle classes & admin
        $logs[] = $this->verify_seed_data();

        if ($format === 'json') {
            header('Content-Type: application/json');
            echo json_encode(array(
                'status'    => true,
                'message'   => 'Database migration completed successfully!',
                'timestamp' => date('Y-m-d H:i:s'),
                'logs'      => $logs
            ));
            return;
        }

        // Render clean HTML report
        $data['logs'] = $logs;
        $this->render_migration_ui($logs);
    }

    private function verify_tables()
    {
        $tables = array(
            'admins' => "CREATE TABLE IF NOT EXISTS `admins` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(100) NOT NULL,
                `username` varchar(100) NOT NULL,
                `email` varchar(150) NOT NULL,
                `password` varchar(255) NOT NULL,
                `role` enum('superadmin','admin','staff') NOT NULL DEFAULT 'admin',
                `status` tinyint(1) NOT NULL DEFAULT 1,
                `last_login` datetime DEFAULT NULL,
                `created_at` datetime NOT NULL,
                `updated_at` datetime NOT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `username` (`username`),
                UNIQUE KEY `email` (`email`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

            'customers' => "CREATE TABLE IF NOT EXISTS `customers` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(150) NOT NULL,
                `phone` varchar(20) NOT NULL,
                `email` varchar(150) DEFAULT NULL,
                `otp_code` varchar(10) DEFAULT NULL,
                `otp_expiry` datetime DEFAULT NULL,
                `is_verified` tinyint(1) NOT NULL DEFAULT 0,
                `created_at` datetime NOT NULL,
                `updated_at` datetime NOT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `phone` (`phone`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

            'drivers' => "CREATE TABLE IF NOT EXISTS `drivers` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(100) NOT NULL,
                `phone` varchar(20) NOT NULL,
                `email` varchar(100) DEFAULT NULL,
                `password` varchar(255) NOT NULL,
                `license_number` varchar(50) DEFAULT NULL,
                `vehicle_type` varchar(50) DEFAULT 'sedan',
                `vehicle_number` varchar(30) DEFAULT NULL,
                `vehicle_model` varchar(100) DEFAULT NULL,
                `address` text DEFAULT NULL,
                `license_doc` varchar(255) DEFAULT NULL,
                `rc_doc` varchar(255) DEFAULT NULL,
                `insurance_doc` varchar(255) DEFAULT NULL,
                `fcm_token` text DEFAULT NULL,
                `status` enum('pending','approved','suspended') NOT NULL DEFAULT 'approved',
                `is_online` tinyint(1) NOT NULL DEFAULT 1,
                `rating` decimal(3,2) NOT NULL DEFAULT 5.00,
                `created_at` datetime NOT NULL,
                `updated_at` datetime NOT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `phone` (`phone`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

            'bookings' => "CREATE TABLE IF NOT EXISTS `bookings` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `booking_id` varchar(30) NOT NULL,
                `customer_id` int(11) DEFAULT NULL,
                `driver_id` int(11) DEFAULT NULL,
                `trip_type` enum('oneway','roundtrip') NOT NULL DEFAULT 'oneway',
                `pickup_location` varchar(255) NOT NULL,
                `drop_location` varchar(255) NOT NULL,
                `pickup_date` date NOT NULL,
                `pickup_time` time NOT NULL,
                `return_date` date DEFAULT NULL,
                `vehicle_type` varchar(50) NOT NULL,
                `vehicle_name` varchar(100) NOT NULL,
                `passenger_name` varchar(100) NOT NULL,
                `passenger_phone` varchar(20) NOT NULL,
                `passenger_email` varchar(150) DEFAULT NULL,
                `comments` text DEFAULT NULL,
                `distance_km` decimal(8,2) NOT NULL DEFAULT 0.00,
                `billable_km` decimal(8,2) NOT NULL DEFAULT 0.00,
                `per_km_rate` decimal(8,2) NOT NULL DEFAULT 0.00,
                `base_fare` decimal(10,2) NOT NULL DEFAULT 0.00,
                `km_fare` decimal(10,2) NOT NULL DEFAULT 0.00,
                `driver_batta` decimal(10,2) NOT NULL DEFAULT 0.00,
                `toll_count` int(11) NOT NULL DEFAULT 0,
                `toll_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
                `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
                `coupon_code` varchar(50) DEFAULT NULL,
                `total_fare` decimal(10,2) NOT NULL DEFAULT 0.00,
                `status` enum('pending','confirmed','assigned','started','completed','cancelled') NOT NULL DEFAULT 'pending',
                `payment_status` enum('pending','paid','failed') NOT NULL DEFAULT 'pending',
                `payment_method` enum('cash','razorpay','online') NOT NULL DEFAULT 'cash',
                `razorpay_order_id` varchar(100) DEFAULT NULL,
                `razorpay_payment_id` varchar(100) DEFAULT NULL,
                `created_at` datetime NOT NULL,
                `updated_at` datetime NOT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `booking_id` (`booking_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

            'vehicles' => "CREATE TABLE IF NOT EXISTS `vehicles` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(100) NOT NULL,
                `type_key` varchar(50) NOT NULL,
                `models` varchar(255) NOT NULL,
                `seating_capacity` int(11) NOT NULL DEFAULT 4,
                `luggage_capacity` int(11) NOT NULL DEFAULT 2,
                `has_ac` tinyint(1) NOT NULL DEFAULT 1,
                `image` varchar(255) DEFAULT NULL,
                `oneway_rate` decimal(8,2) NOT NULL DEFAULT 14.00,
                `roundtrip_rate` decimal(8,2) NOT NULL DEFAULT 13.00,
                `min_km_oneway` int(11) NOT NULL DEFAULT 130,
                `min_km_roundtrip` int(11) NOT NULL DEFAULT 250,
                `driver_batta_oneway` decimal(8,2) NOT NULL DEFAULT 300.00,
                `driver_batta_roundtrip` decimal(8,2) NOT NULL DEFAULT 400.00,
                `toll_rate_estimate` decimal(8,2) NOT NULL DEFAULT 85.00,
                `status` tinyint(1) NOT NULL DEFAULT 1,
                `created_at` datetime NOT NULL,
                `updated_at` datetime NOT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `type_key` (`type_key`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

            'coupons' => "CREATE TABLE IF NOT EXISTS `coupons` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `code` varchar(50) NOT NULL,
                `discount_type` enum('fixed','percentage') NOT NULL DEFAULT 'fixed',
                `discount_value` decimal(8,2) NOT NULL,
                `min_order_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
                `max_discount` decimal(8,2) DEFAULT NULL,
                `valid_from` date NOT NULL,
                `valid_to` date NOT NULL,
                `usage_limit` int(11) DEFAULT NULL,
                `used_count` int(11) NOT NULL DEFAULT 0,
                `status` tinyint(1) NOT NULL DEFAULT 1,
                `created_at` datetime NOT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `code` (`code`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

            'enquiries' => "CREATE TABLE IF NOT EXISTS `enquiries` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(100) NOT NULL,
                `phone` varchar(20) NOT NULL,
                `email` varchar(150) DEFAULT NULL,
                `pickup` varchar(255) DEFAULT NULL,
                `drop_loc` varchar(255) DEFAULT NULL,
                `message` text NOT NULL,
                `status` enum('new','contacted','closed') NOT NULL DEFAULT 'new',
                `created_at` datetime NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

            'settings' => "CREATE TABLE IF NOT EXISTS `settings` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `setting_key` varchar(100) NOT NULL,
                `setting_value` text DEFAULT NULL,
                `created_at` datetime NOT NULL,
                `updated_at` datetime NOT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `setting_key` (`setting_key`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

            'blogs' => "CREATE TABLE IF NOT EXISTS `blogs` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `title` varchar(255) NOT NULL,
                `slug` varchar(255) NOT NULL,
                `excerpt` text DEFAULT NULL,
                `content` longtext NOT NULL,
                `featured_image` varchar(255) DEFAULT NULL,
                `category` varchar(100) DEFAULT 'Travel Guide',
                `author` varchar(100) DEFAULT 'DropTaxi Editorial',
                `meta_title` varchar(255) DEFAULT NULL,
                `meta_keywords` text DEFAULT NULL,
                `meta_description` text DEFAULT NULL,
                `views` int(11) NOT NULL DEFAULT 0,
                `status` enum('published','draft') NOT NULL DEFAULT 'published',
                `published_at` datetime DEFAULT NULL,
                `created_at` datetime NOT NULL,
                `updated_at` datetime NOT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `slug` (`slug`),
                KEY `status` (`status`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
        );

        $created_count = 0;
        foreach ($tables as $t_name => $sql) {
            $this->db->query($sql);
            $created_count++;
        }

        return "Verified & synced " . count($tables) . " core tables (admins, customers, drivers, bookings, vehicles, coupons, enquiries, settings, blogs).";
    }

    private function verify_columns()
    {
        $log = array();

        // 1. Check customers table columns
        if ($this->db->table_exists('customers')) {
            if (!$this->db->field_exists('otp_code', 'customers')) {
                $this->dbforge->add_column('customers', array(
                    'otp_code' => array('type' => 'VARCHAR', 'constraint' => 10, 'null' => TRUE, 'after' => 'email'),
                    'otp_expiry' => array('type' => 'DATETIME', 'null' => TRUE, 'after' => 'otp_code'),
                    'is_verified' => array('type' => 'TINYINT', 'constraint' => 1, 'default' => 0, 'after' => 'otp_expiry')
                ));
                $log[] = "Added missing OTP and verification fields to 'customers' table.";
            }
        }

        // 2. Check bookings table columns
        if ($this->db->table_exists('bookings')) {
            $cols_to_add = array();
            if (!$this->db->field_exists('toll_count', 'bookings')) {
                $cols_to_add['toll_count'] = array('type' => 'INT', 'constraint' => 11, 'default' => 0, 'after' => 'driver_batta');
            }
            if (!$this->db->field_exists('toll_fee', 'bookings')) {
                $cols_to_add['toll_fee'] = array('type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00, 'after' => 'toll_count');
            }
            if (!$this->db->field_exists('customer_id', 'bookings')) {
                $cols_to_add['customer_id'] = array('type' => 'INT', 'constraint' => 11, 'null' => TRUE, 'after' => 'booking_id');
            }
            if (!empty($cols_to_add)) {
                $this->dbforge->add_column('bookings', $cols_to_add);
                $log[] = "Added missing columns (" . implode(', ', array_keys($cols_to_add)) . ") to 'bookings' table.";
            }
        }

        // 3. Check drivers table columns
        if ($this->db->table_exists('drivers')) {
            $driver_cols = array();
            if (!$this->db->field_exists('fcm_token', 'drivers')) {
                $driver_cols['fcm_token'] = array('type' => 'TEXT', 'null' => TRUE, 'after' => 'insurance_doc');
            }
            if (!$this->db->field_exists('is_online', 'drivers')) {
                $driver_cols['is_online'] = array('type' => 'TINYINT', 'constraint' => 1, 'default' => 1, 'after' => 'status');
            }
            if (!empty($driver_cols)) {
                $this->dbforge->add_column('drivers', $driver_cols);
                $log[] = "Added missing columns (" . implode(', ', array_keys($driver_cols)) . ") to 'drivers' table.";
            }
        }

        if (empty($log)) {
            $log[] = "All table schema columns are up to date.";
        }

        return $log;
    }

    private function verify_settings()
    {
        $default_settings = array(
            'site_title'             => 'DropTaxi - #1 One Way Drop Taxi & Outstation Cabs in Tamil Nadu',
            'contact_phone'          => '+91 98765 43210',
            'contact_email'          => 'info@droptaxi.com',
            'whatsapp_number'        => '919876543210',
            'google_map_key'         => 'AIzaSyDEO3zPEcZiGQ2zM5qcDvPqLbHgg9WFPbQ',
            'home_meta_title'        => 'DropTaxi | Best One Way Drop Taxi & Outstation Cabs in Tamil Nadu',
            'home_meta_keywords'     => 'taxi booking, one way drop taxi, two way drop taxi, near by droptaxi, online taxi, outstation drop taxi, drop taxi chennai, drop taxi madurai, drop taxi coimbatore, drop taxi tirunelveli, drop taxi trichy, drop taxi salem, intercity cab booking',
            'home_meta_description'  => 'Book reliable One Way Drop Taxi & Outstation Cabs across Tamil Nadu, Bangalore & Pondicherry. Pay only for one way. Lowest per km rates, zero hidden charges, 24x7 verified drivers.',
            'og_image'               => 'assets/images/og-banner.jpg',
            'razorpay_enabled'       => '1',
            'razorpay_key_id'        => 'rzp_test_samplekey123',
            'razorpay_key_secret'    => 'sample_secret_key_123',
            'smtp_host'              => 'smtp.gmail.com',
            'smtp_port'              => '587',
            'smtp_crypto'            => 'tls',
            'smtp_from_name'         => 'DropTaxi Service'
        );

        $updated_keys = 0;
        foreach ($default_settings as $k => $v) {
            $existing = $this->Setting_model->get_setting($k, null);
            if ($existing === null || ($k === 'google_map_key' && empty($existing))) {
                $this->Setting_model->save_setting($k, $v);
                $updated_keys++;
            }
        }

        return "Verified system SEO & gateway settings. Active Google Maps Key is: " . substr($this->Setting_model->get_setting('google_map_key', ''), 0, 12) . "...";
    }

    private function verify_seed_data()
    {
        // 1. Ensure at least one admin exists
        $admin_count = $this->db->count_all('admins');
        if ($admin_count === 0) {
            $this->db->insert('admins', array(
                'name'       => 'Administrator',
                'username'   => 'admin',
                'email'      => 'admin@droptaxi.com',
                'password'   => password_hash('admin123', PASSWORD_BCRYPT),
                'role'       => 'superadmin',
                'status'     => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ));
        }

        // 2. Ensure vehicles exist
        $v_count = $this->db->count_all('vehicles');
        if ($v_count === 0) {
            $vehicles = array(
                array(
                    'name' => 'Sedan (Dzire / Etios)', 'type_key' => 'sedan', 'models' => 'Swift Dzire, Toyota Etios, Hyundai Aura',
                    'seating_capacity' => 4, 'luggage_capacity' => 2, 'has_ac' => 1, 'image' => 'assets/images/cars/sedan.png',
                    'oneway_rate' => 14.00, 'roundtrip_rate' => 13.00, 'min_km_oneway' => 130, 'min_km_roundtrip' => 250,
                    'driver_batta_oneway' => 300.00, 'driver_batta_roundtrip' => 400.00, 'toll_rate_estimate' => 85.00,
                    'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')
                ),
                array(
                    'name' => 'SUV (Ertiga / Lodgy)', 'type_key' => 'suv', 'models' => 'Maruti Ertiga, Renault Lodgy, Kia Carens',
                    'seating_capacity' => 6, 'luggage_capacity' => 3, 'has_ac' => 1, 'image' => 'assets/images/cars/suv.png',
                    'oneway_rate' => 19.00, 'roundtrip_rate' => 17.00, 'min_km_oneway' => 130, 'min_km_roundtrip' => 250,
                    'driver_batta_oneway' => 400.00, 'driver_batta_roundtrip' => 500.00, 'toll_rate_estimate' => 105.00,
                    'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')
                ),
                array(
                    'name' => 'Innova / Crysta', 'type_key' => 'innova', 'models' => 'Toyota Innova, Innova Crysta',
                    'seating_capacity' => 7, 'luggage_capacity' => 4, 'has_ac' => 1, 'image' => 'assets/images/cars/innova.png',
                    'oneway_rate' => 22.00, 'roundtrip_rate' => 20.00, 'min_km_oneway' => 130, 'min_km_roundtrip' => 250,
                    'driver_batta_oneway' => 400.00, 'driver_batta_roundtrip' => 500.00, 'toll_rate_estimate' => 115.00,
                    'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')
                ),
                array(
                    'name' => 'Tempo Traveller (12+1)', 'type_key' => 'tempo', 'models' => 'Force Tempo Traveller 12/14 Seater AC',
                    'seating_capacity' => 12, 'luggage_capacity' => 8, 'has_ac' => 1, 'image' => 'assets/images/cars/tempo.png',
                    'oneway_rate' => 28.00, 'roundtrip_rate' => 25.00, 'min_km_oneway' => 150, 'min_km_roundtrip' => 300,
                    'driver_batta_oneway' => 600.00, 'driver_batta_roundtrip' => 700.00, 'toll_rate_estimate' => 140.00,
                    'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')
                )
            );
            foreach ($vehicles as $v) {
                $this->db->insert('vehicles', $v);
            }
        }

        // 3. Ensure SEO Blog posts exist
        $blog_count = $this->db->count_all('blogs');
        if ($blog_count === 0) {
            $sample_blogs = array(
                array(
                    'title'             => 'Top Benefits of One Way Drop Taxi in Tamil Nadu: Save 40% on Outstation Travel',
                    'slug'              => 'benefits-of-one-way-drop-taxi-tamil-nadu',
                    'category'          => 'Travel Guide',
                    'author'            => 'DropTaxi Editorial',
                    'excerpt'           => 'Discover why one way drop taxi booking is revolutionizing outstation travel in Tamil Nadu. Learn how to pay only for the distance you travel with zero return fare.',
                    'content'           => '<h2>Why Pay Double When You Only Need One Way?</h2><p>Traditional outstation taxi operators commonly charge round-trip fares even when you only need to travel from one city to another. With <strong>DropTaxi One Way service</strong>, you only pay for the exact distance travelled, saving up to 40% on your travel budget.</p><h3>Key Advantages of DropTaxi:</h3><ul><li><strong>Pay Only One-Way:</strong> Zero return kilometer charges for intercity trips.</li><li><strong>Doorstep Pickup & Drop:</strong> Convenient pickup from any neighborhood in Chennai, Madurai, Coimbatore, Tirunelveli, and Trichy.</li><li><strong>Transparent Billing:</strong> Pre-calculated fares with toll estimates and driver allowance included upfront.</li><li><strong>Well-Maintained AC Fleet:</strong> Clean Sedans (Dzire, Etios) and SUVs (Ertiga, Innova) with verified professional chauffeurs.</li></ul><p>Ready to experience hassle-free outstation travel? Book your one way taxi online now!</p>',
                    'meta_title'        => 'Benefits of One Way Drop Taxi in Tamil Nadu | Save 40% on Taxi Booking',
                    'meta_keywords'     => 'one way drop taxi, outstation drop taxi, drop taxi tamil nadu, taxi booking online, chennai to madurai drop taxi, coimbatore drop taxi',
                    'meta_description'  => 'Save up to 40% on outstation travel in Tamil Nadu with DropTaxi one-way drop taxi service. Pay only for one way with transparent per-km rates and verified drivers.',
                    'views'             => 142,
                    'status'            => 'published',
                    'published_at'      => date('Y-m-d H:i:s', strtotime('-5 days')),
                    'created_at'        => date('Y-m-d H:i:s', strtotime('-5 days')),
                    'updated_at'        => date('Y-m-d H:i:s')
                ),
                array(
                    'title'             => 'How to Book Online Taxi in Tamil Nadu: Complete Step-by-Step Guide',
                    'slug'              => 'how-to-book-online-taxi-tamil-nadu',
                    'category'          => 'Booking Tips',
                    'author'            => 'DropTaxi Team',
                    'excerpt'           => 'A simple step-by-step tutorial on booking one-way and round-trip outstation cabs online with instant fare calculation and immediate confirmation.',
                    'content'           => '<h2>Easy 3-Step Online Taxi Booking</h2><p>Booking a drop taxi has never been easier. Follow these simple steps to confirm your cab in under 2 minutes:</p><ol><li><strong>Enter Pickup & Drop Locations:</strong> Type your area name or city to instantly see the driving distance and estimated tolls.</li><li><strong>Choose Your Vehicle:</strong> Select from affordable Sedans, spacious 6-seater SUVs, luxury Innova Crysta, or 12-seater Tempo Travellers.</li><li><strong>Instant Confirmation:</strong> Receive your booking ID, driver assignment, and live SMS updates immediately.</li></ol><h3>Safety First with Verified Drivers</h3><p>Every driver undergoes strict background verification and vehicle safety audits, guaranteeing peace of mind on long highway journeys.</p>',
                    'meta_title'        => 'How to Book Online Taxi in Tamil Nadu | Online Drop Taxi Booking Guide',
                    'meta_keywords'     => 'online taxi, taxi booking, book cab online, drop taxi booking, outstation taxi booking tamil nadu, near by droptaxi',
                    'meta_description'  => 'Step-by-step guide to online taxi booking in Tamil Nadu. Book one-way and round-trip outstation cabs in 3 easy steps with instant fare calculation.',
                    'views'             => 98,
                    'status'            => 'published',
                    'published_at'      => date('Y-m-d H:i:s', strtotime('-3 days')),
                    'created_at'        => date('Y-m-d H:i:s', strtotime('-3 days')),
                    'updated_at'        => date('Y-m-d H:i:s')
                ),
                array(
                    'title'             => 'Finding Nearby Drop Taxi & Outstation Cabs for Fast Highway Travel',
                    'slug'              => 'finding-nearby-drop-taxi-outstation-cabs',
                    'category'          => 'Travel Guide',
                    'author'            => 'DropTaxi Editorial',
                    'excerpt'           => 'Need a nearby drop taxi urgently? Here is how to find the closest verified outstation cab with 24x7 emergency and scheduled pickup across South India.',
                    'content'           => '<h2>24x7 Nearby Outstation Cabs On Demand</h2><p>Whether you need an early morning airport transfer or an emergency one-way intercity cab, DropTaxi connects you with the nearest active chauffeur in your district.</p><h3>Coverage Across 38+ Districts:</h3><p>We serve all major highways and hubs including NH44, NH45, NH83 connecting Chennai, Madurai, Coimbatore, Salem, Tirunelveli, Trichy, Nagercoil, Tenkasi, and Bangalore.</p><p>Call our 24x7 helpline or book online for guaranteed on-time pickups!</p>',
                    'meta_title'        => 'Nearby Drop Taxi & Outstation Cabs Across Tamil Nadu | 24x7 Taxi Booking',
                    'meta_keywords'     => 'near by droptaxi, nearby taxi, outstation cabs near me, two way drop taxi, intercity drop taxi, emergency drop taxi',
                    'meta_description'  => 'Find reliable nearby drop taxi and outstation cabs across Tamil Nadu. 24x7 fast pickup, transparent per-km billing, and AC vehicles.',
                    'views'             => 85,
                    'status'            => 'published',
                    'published_at'      => date('Y-m-d H:i:s', strtotime('-1 days')),
                    'created_at'        => date('Y-m-d H:i:s', strtotime('-1 days')),
                    'updated_at'        => date('Y-m-d H:i:s')
                )
            );

            foreach ($sample_blogs as $b) {
                $this->db->insert('blogs', $b);
            }
        }

        return "Verified admin account, vehicle tariffs, and SEO blog articles.";
    }

    private function render_migration_ui($logs)
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>DropTaxi Database Migration & Sync</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
            <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
            <style>
                body {
                    font-family: 'Plus Jakarta Sans', sans-serif;
                    background: #f8fafc;
                    color: #1e293b;
                    min-height: 100vh;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding: 20px;
                }
                .migration-card {
                    background: #ffffff;
                    border-radius: 20px;
                    box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
                    border: 1px solid #e2e8f0;
                    max-width: 650px;
                    width: 100%;
                    overflow: hidden;
                }
                .log-item {
                    padding: 12px 16px;
                    border-radius: 10px;
                    background: #f8fafc;
                    border: 1px solid #f1f5f9;
                    margin-bottom: 10px;
                    font-size: 0.9rem;
                    display: flex;
                    align-items: center;
                    gap: 12px;
                }
            </style>
        </head>
        <body>
            <div class="migration-card p-4 p-md-5">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; font-size: 1.4rem;">
                        <i class="fa-solid fa-database"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">Database Migration & Sync</h4>
                        <p class="text-secondary small mb-0">DropTaxi Auto-Migration & Schema Synchronizer</p>
                    </div>
                </div>

                <div class="alert alert-success d-flex align-items-center gap-2 mb-4">
                    <i class="fa-solid fa-circle-check fs-5"></i>
                    <div><strong>Success!</strong> All database tables, schema columns, and default settings are up-to-date.</div>
                </div>

                <h6 class="fw-bold text-secondary text-uppercase mb-3" style="font-size: 0.75rem; letter-spacing: 0.5px;">Migration Execution Logs</h6>
                <div class="mb-4">
                    <?php foreach ($logs as $log): ?>
                        <div class="log-item">
                            <i class="fa-solid fa-check text-success"></i>
                            <span><?= html_escape($log) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="d-flex flex-wrap gap-2 pt-2 border-top">
                    <a href="<?= base_url('admin/index') ?>" class="btn btn-warning fw-bold px-4 py-2">
                        <i class="fa-solid fa-gauge-high me-2"></i>Go to Admin Dashboard
                    </a>
                    <a href="<?= base_url() ?>" class="btn btn-outline-secondary fw-semibold px-4 py-2">
                        <i class="fa-solid fa-globe me-2"></i>Visit Website
                    </a>
                </div>
            </div>
        </body>
        </html>
        <?php
    }
}
