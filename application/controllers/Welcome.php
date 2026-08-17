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
	}

	public function index()
	{
		$data['vehicles'] = $this->Vehicle_model->get_all_vehicles(true);
		$data['settings'] = $this->Setting_model->get_all_settings();
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
}
