<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url', 'form', 'email_helper'));
		$this->load->library('session');
		$this->load->model('Admin_model');
		$this->load->model('Booking_model');
		$this->load->model('Vehicle_model');
		$this->load->model('Setting_model');
		$this->load->model('Enquiry_model');
		$this->load->model('Coupon_model');
		$this->load->model('Customer_model');
		$this->load->model('Driver_model');
		$this->load->model('Blog_model');
	}

	private function check_auth() {
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('admin/login');
		}
	}

	public function login() {
		if ($this->session->userdata('admin_logged_in')) {
			redirect('admin/index');
		}

		if ($this->input->post()) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$admin = $this->Admin_model->verify_login($username, $password);
			if ($admin) {
				$this->session->set_userdata(array(
					'admin_logged_in' => true,
					'admin_id'        => $admin['id'],
					'admin_name'      => $admin['name'],
					'admin_email'     => $admin['email'],
					'admin_role'      => $admin['role']
				));
				redirect('admin/index');
			} else {
				$this->session->set_flashdata('error', 'Invalid Username/Email or Password.');
			}
		}

		$this->load->view('admin/login');
	}

	public function logout() {
		$this->session->unset_userdata(array('admin_logged_in', 'admin_id', 'admin_name', 'admin_email', 'admin_role'));
		$this->session->sess_destroy();
		redirect('admin/login');
	}

	public function index() {
		$this->check_auth();

		$data['total_bookings']     = $this->Booking_model->count_bookings();
		$data['new_bookings']       = $this->Booking_model->count_bookings('new');
		$data['total_revenue']      = $this->Booking_model->get_total_revenue();
		$data['total_driver_batta'] = $this->Booking_model->get_total_driver_batta();
		$data['unread_enquiries']   = $this->Enquiry_model->count_unread_enquiries();

		$data['recent_bookings']    = $this->Booking_model->get_all_bookings(null, 8, 0);
		$data['vehicles']           = $this->Vehicle_model->get_all_vehicles();

		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/sidebar');
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/layout/footer');
	}

	public function bookings() {
		$this->check_auth();

		$status = $this->input->get('status');
		$data['bookings'] = $this->Booking_model->get_all_bookings($status);
		$data['selected_status'] = $status;

		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/sidebar');
		$this->load->view('admin/bookings', $data);
		$this->load->view('admin/layout/footer');
	}

	public function update_booking_status() {
		$this->check_auth();

		$booking_id = $this->input->post('booking_id');
		$booking_status = $this->input->post('booking_status');
		$payment_status = $this->input->post('payment_status');

		if ($booking_id) {
			$update = array();
			if ($booking_status) $update['booking_status'] = $booking_status;
			if ($payment_status) $update['payment_status'] = $payment_status;

			$this->Booking_model->update_booking($booking_id, $update);
			$this->session->set_flashdata('success', 'Booking updated successfully!');
		}
		$redirect = $this->input->post('redirect_to') ? $this->input->post('redirect_to') : 'admin/bookings';
		redirect($redirect);
	}

	public function update_fare_details() {
		$this->check_auth();

		$booking_id   = $this->input->post('booking_id');
		$driver_batta = floatval($this->input->post('driver_batta'));
		$permit_fee   = floatval($this->input->post('permit_fee'));
		$toll_fee     = floatval($this->input->post('toll_fee'));

		$booking = $this->Booking_model->get_booking_by_id($booking_id);
		if ($booking) {
			$base_fare = ($booking['distance_km'] * $booking['per_km_rate']);
			$new_total = $base_fare + $driver_batta + $permit_fee + $toll_fee;

			$this->Booking_model->update_booking($booking_id, array(
				'driver_batta'   => $driver_batta,
				'permit_fee'     => $permit_fee,
				'toll_fee'       => $toll_fee,
				'estimated_fare' => $new_total,
				'total_fare'     => $new_total
			));
			$this->session->set_flashdata('success', 'Fare breakdown updated successfully!');
		}
		$redirect = $this->input->post('redirect_to') ? $this->input->post('redirect_to') : 'admin/bookings';
		redirect($redirect);
	}

	public function vehicles() {
		$this->check_auth();

		$data['vehicles'] = $this->Vehicle_model->get_all_vehicles();

		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/sidebar');
		$this->load->view('admin/vehicles', $data);
		$this->load->view('admin/layout/footer');
	}

	public function save_vehicle() {
		$this->check_auth();

		$id = $this->input->post('id');
		$data = array(
			'name'                   => $this->input->post('name'),
			'type_key'               => strtolower($this->input->post('type_key')),
			'capacity'               => intval($this->input->post('capacity')),
			'min_km_oneway'          => intval($this->input->post('min_km_oneway')),
			'min_km_roundtrip'       => intval($this->input->post('min_km_roundtrip')),
			'per_km_oneway'          => floatval($this->input->post('per_km_oneway')),
			'per_km_roundtrip'       => floatval($this->input->post('per_km_roundtrip')),
			'driver_batta_oneway'    => floatval($this->input->post('driver_batta_oneway')),
			'driver_batta_roundtrip' => floatval($this->input->post('driver_batta_roundtrip')),
			'description'            => $this->input->post('description'),
			'status'                 => $this->input->post('status')
		);

		if ($id) {
			$this->Vehicle_model->update_vehicle($id, $data);
			$this->session->set_flashdata('success', 'Vehicle tariff updated successfully!');
		} else {
			$this->Vehicle_model->add_vehicle($data);
			$this->session->set_flashdata('success', 'New vehicle added successfully!');
		}
		redirect('admin/vehicles');
	}

	public function settings() {
		$this->check_auth();

		$data['settings'] = $this->Setting_model->get_all_settings();

		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/sidebar');
		$this->load->view('admin/settings', $data);
		$this->load->view('admin/layout/footer');
	}

	public function save_settings() {
		$this->check_auth();

		$post = $this->input->post();
		if ($post) {
			$this->Setting_model->save_batch_settings($post);
			$this->session->set_flashdata('success', 'Settings saved successfully!');
		}
		redirect('admin/settings');
	}

	public function send_test_email() {
		$this->check_auth();

		$test_email = $this->input->post('test_email');
		if (!empty($test_email)) {
			$subject = "DropTaxi SMTP Test Email";
			$body = "<h2>SMTP Configuration Test</h2><p>Your SMTP email configuration is working successfully!</p><p>Sent on: " . date('Y-m-d H:i:s') . "</p>";

			$result = send_smtp_email($test_email, $subject, $body);
			if ($result) {
				$this->session->set_flashdata('success', 'Test email sent successfully to ' . html_escape($test_email));
			} else {
				$this->session->set_flashdata('error', 'Failed to send test email. Check your SMTP credentials in settings.');
			}
		}
		redirect('admin/settings');
	}

	public function enquiries() {
		$this->check_auth();

		$data['enquiries'] = $this->Enquiry_model->get_all_enquiries();

		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/sidebar');
		$this->load->view('admin/enquiries', $data);
		$this->load->view('admin/layout/footer');
	}

	public function coupons() {
		$this->check_auth();

		$data['coupons'] = $this->Coupon_model->get_all_coupons();

		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/sidebar');
		$this->load->view('admin/coupons', $data);
		$this->load->view('admin/layout/footer');
	}

	public function save_coupon() {
		$this->check_auth();

		$id = $this->input->post('id');
		$data = array(
			'code'             => strtoupper(trim($this->input->post('code'))),
			'discount_type'    => $this->input->post('discount_type'),
			'discount_value'   => floatval($this->input->post('discount_value')),
			'min_order_amount' => floatval($this->input->post('min_order_amount')),
			'is_one_time'      => intval($this->input->post('is_one_time')),
			'status'           => $this->input->post('status'),
			'expiry_date'      => !empty($this->input->post('expiry_date')) ? $this->input->post('expiry_date') : null
		);

		if ($id) {
			$this->Coupon_model->update_coupon($id, $data);
			$this->session->set_flashdata('success', 'Coupon code updated successfully!');
		} else {
			$this->Coupon_model->add_coupon($data);
			$this->session->set_flashdata('success', 'New coupon code created successfully!');
		}
		redirect('admin/coupons');
	}

	public function delete_coupon($id) {
		$this->check_auth();
		if ($id) {
			$this->Coupon_model->delete_coupon($id);
			$this->session->set_flashdata('success', 'Coupon code deleted successfully!');
		}
		redirect('admin/coupons');
	}

	public function customers() {
		$this->check_auth();

		$data['customers'] = $this->Customer_model->get_all_customers();
		$data['total_customers'] = $this->Customer_model->count_customers();

		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/sidebar');
		$this->load->view('admin/customers', $data);
		$this->load->view('admin/layout/footer');
	}

	public function update_customer_status() {
		$this->check_auth();

		$customer_id = $this->input->post('customer_id');
		$status      = $this->input->post('status');

		if ($customer_id && in_array($status, array('active', 'blocked'))) {
			$this->Customer_model->update_status($customer_id, $status);
			$this->session->set_flashdata('success', 'Customer account status updated successfully!');
		}
		redirect('admin/customers');
	}

	// ========== DRIVER MANAGEMENT ==========

	public function drivers() {
		$this->check_auth();

		$data['drivers'] = $this->Driver_model->get_all_drivers();
		$data['total_drivers'] = $this->Driver_model->count_drivers();

		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/sidebar');
		$this->load->view('admin/drivers', $data);
		$this->load->view('admin/layout/footer');
	}

	public function save_driver() {
		$this->check_auth();

		$id = $this->input->post('id');
		$data = array(
			'name'  => trim($this->input->post('name')),
			'phone' => trim($this->input->post('phone'))
		);

		// Handle file uploads
		$upload_path = FCPATH . 'uploads/drivers/';
		if (!is_dir($upload_path)) {
			mkdir($upload_path, 0755, true);
		}

		$doc_fields = array('licence_doc', 'aadhar_doc', 'pan_card_doc', 'bank_account_doc');
		foreach ($doc_fields as $field) {
			if (!empty($_FILES[$field]['name'])) {
				$config = array(
					'upload_path'   => $upload_path,
					'allowed_types' => 'jpg|jpeg|png|pdf|gif|webp',
					'max_size'      => 5120, // 5MB
					'file_name'     => time() . '_' . $_FILES[$field]['name']
				);

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload($field)) {
					$upload_data = $this->upload->data();
					$data[$field] = 'uploads/drivers/' . $upload_data['file_name'];

					// Delete old file if updating
					if ($id) {
						$existing = $this->Driver_model->get_driver_by_id($id);
						if (!empty($existing[$field]) && file_exists(FCPATH . $existing[$field])) {
							unlink(FCPATH . $existing[$field]);
						}
					}
				}
			}
		}

		if ($id) {
			$this->Driver_model->update_driver($id, $data);
			$this->session->set_flashdata('success', 'Driver details updated successfully!');
		} else {
			$this->Driver_model->add_driver($data);
			$this->session->set_flashdata('success', 'New driver added successfully!');
		}
		redirect('admin/drivers');
	}

	public function delete_driver($id) {
		$this->check_auth();
		if ($id) {
			// Delete uploaded files
			$driver = $this->Driver_model->get_driver_by_id($id);
			if ($driver) {
				$doc_fields = array('licence_doc', 'aadhar_doc', 'pan_card_doc', 'bank_account_doc');
				foreach ($doc_fields as $field) {
					if (!empty($driver[$field]) && file_exists(FCPATH . $driver[$field])) {
						unlink(FCPATH . $driver[$field]);
					}
				}
			}
			$this->Driver_model->delete_driver($id);
			$this->session->set_flashdata('success', 'Driver removed successfully!');
		}
		redirect('admin/drivers');
	}

	public function update_driver_status() {
		$this->check_auth();

		$driver_id = $this->input->post('driver_id');
		$status    = $this->input->post('status');

		if ($driver_id && in_array($status, array('active', 'inactive'))) {
			$this->Driver_model->update_status($driver_id, $status);
			$this->session->set_flashdata('success', 'Driver status updated successfully!');
		}
		redirect('admin/drivers');
	}

	public function toggle_driver_verification() {
		$this->check_auth();

		$driver_id = $this->input->post('driver_id');
		$field     = $this->input->post('field'); // is_verified or is_phone_verified
		$value     = intval($this->input->post('value'));

		if ($driver_id && in_array($field, array('is_verified', 'is_phone_verified'))) {
			$this->Driver_model->update_verification($driver_id, $field, $value);
			$this->session->set_flashdata('success', 'Driver verification status updated!');
		}
		redirect('admin/drivers');
	}

	// -------------------------------------------------------------
	// BLOG & SEO MANAGEMENT
	// -------------------------------------------------------------

	public function blogs() {
		$this->check_auth();
		$data['title'] = 'Blog & SEO Articles';
		$data['blogs'] = $this->Blog_model->get_all_blogs();

		$this->load->view('admin/layout/header', $data);
		$this->load->view('admin/layout/sidebar', $data);
		$this->load->view('admin/blogs/index', $data);
		$this->load->view('admin/layout/footer');
	}

	public function add_blog() {
		$this->check_auth();
		$data['title'] = 'Add New SEO Blog Post';
		$data['blog']  = null;

		if ($this->input->post()) {
			$this->handle_save_blog();
			return;
		}

		$this->load->view('admin/layout/header', $data);
		$this->load->view('admin/layout/sidebar', $data);
		$this->load->view('admin/blogs/form', $data);
		$this->load->view('admin/layout/footer');
	}

	public function edit_blog($id = null) {
		$this->check_auth();
		if (empty($id)) redirect('admin/blogs');

		$blog = $this->Blog_model->get_blog_by_id($id);
		if (!$blog) {
			$this->session->set_flashdata('error', 'Blog post not found.');
			redirect('admin/blogs');
		}

		$data['title'] = 'Edit Blog Post: ' . $blog['title'];
		$data['blog']  = $blog;

		if ($this->input->post()) {
			$this->handle_save_blog($id);
			return;
		}

		$this->load->view('admin/layout/header', $data);
		$this->load->view('admin/layout/sidebar', $data);
		$this->load->view('admin/blogs/form', $data);
		$this->load->view('admin/layout/footer');
	}

	private function handle_save_blog($id = null) {
		$title             = trim($this->input->post('title'));
		$slug              = trim($this->input->post('slug'));
		$category          = trim($this->input->post('category')) ?: 'Travel Guide';
		$author            = trim($this->input->post('author')) ?: 'DropTaxi Editorial';
		$excerpt           = trim($this->input->post('excerpt'));
		$content           = $this->input->post('content');
		$meta_title        = trim($this->input->post('meta_title')) ?: $title;
		$meta_keywords     = trim($this->input->post('meta_keywords'));
		$meta_description  = trim($this->input->post('meta_description')) ?: $excerpt;
		$status            = $this->input->post('status') === 'draft' ? 'draft' : 'published';

		if (empty($title) || empty($content)) {
			$this->session->set_flashdata('error', 'Title and Content are required fields.');
			redirect($id ? 'admin/edit_blog/' . $id : 'admin/add_blog');
			return;
		}

		$blog_data = array(
			'title'            => $title,
			'slug'             => $slug,
			'category'         => $category,
			'author'           => $author,
			'excerpt'          => $excerpt,
			'content'          => $content,
			'meta_title'       => $meta_title,
			'meta_keywords'    => $meta_keywords,
			'meta_description' => $meta_description,
			'status'           => $status,
			'published_at'     => ($status === 'published') ? date('Y-m-d H:i:s') : null
		);

		// Handle Featured Image Upload
		if (!empty($_FILES['featured_image']['name'])) {
			$config['upload_path']   = FCPATH . 'uploads/blogs/';
			$config['allowed_types'] = 'jpg|jpeg|png|webp|svg';
			$config['max_size']      = 4096;
			$config['encrypt_name']  = TRUE;

			if (!is_dir($config['upload_path'])) {
				@mkdir($config['upload_path'], 0777, TRUE);
			}

			$this->load->library('upload', $config);
			if ($this->upload->do_upload('featured_image')) {
				$upload_data = $this->upload->data();
				$blog_data['featured_image'] = 'uploads/blogs/' . $upload_data['file_name'];
			}
		}

		if ($id) {
			$this->Blog_model->update_blog($id, $blog_data);
			$this->session->set_flashdata('success', 'Blog article updated successfully!');
		} else {
			$new_id = $this->Blog_model->create_blog($blog_data);
			$this->session->set_flashdata('success', 'New blog article published successfully!');
		}

		redirect('admin/blogs');
	}

	public function delete_blog($id = null) {
		$this->check_auth();
		if ($id) {
			$this->Blog_model->delete_blog($id);
			$this->session->set_flashdata('success', 'Blog post deleted successfully.');
		}
		redirect('admin/blogs');
	}

	public function toggle_blog_status($id = null) {
		$this->check_auth();
		if ($id) {
			$blog = $this->Blog_model->get_blog_by_id($id);
			if ($blog) {
				$new_status = ($blog['status'] === 'published') ? 'draft' : 'published';
				$this->Blog_model->update_blog($id, array('status' => $new_status));
				$this->session->set_flashdata('success', 'Blog status changed to ' . ucfirst($new_status));
			}
		}
		redirect('admin/blogs');
	}
}
