<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_customers($limit = null, $offset = 0)
    {
        $this->db->order_by('id', 'DESC');
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get('customers');
        return $query->result_array();
    }

    public function count_customers()
    {
        return $this->db->count_all('customers');
    }

    public function get_customer_by_phone($phone)
    {
        $this->db->where('phone', trim($phone));
        $query = $this->db->get('customers');
        return $query->row_array();
    }

    public function get_customer_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('customers');
        return $query->row_array();
    }

    public function create_or_update_otp($name, $phone, $email)
    {
        $phone = trim($phone);
        $name  = trim($name);
        $email = trim($email);

        $otp = sprintf("%04d", rand(1000, 9999));
        $expiry = date('Y-m-d H:i:s', strtotime('+10 minutes'));

        $existing = $this->get_customer_by_phone($phone);
        if ($existing) {
            if ($existing['status'] === 'blocked') {
                return array('status' => false, 'message' => 'Your account is blocked. Please contact support.');
            }
            $update_data = array(
                'otp_code'   => $otp,
                'otp_expiry' => $expiry
            );
            if (!empty($name)) $update_data['name'] = $name;
            if (!empty($email)) $update_data['email'] = $email;

            $this->db->where('id', $existing['id']);
            $this->db->update('customers', $update_data);
            $customer_id = $existing['id'];
        } else {
            $insert_data = array(
                'name'        => !empty($name) ? $name : 'Passenger',
                'phone'       => $phone,
                'email'       => $email,
                'otp_code'    => $otp,
                'otp_expiry'  => $expiry,
                'is_verified' => 0,
                'status'      => 'active'
            );
            $this->db->insert('customers', $insert_data);
            $customer_id = $this->db->insert_id();
        }

        return array(
            'status'      => true,
            'message'     => 'OTP sent successfully to ' . $phone,
            'otp'         => $otp,
            'customer_id' => $customer_id,
            'phone'       => $phone
        );
    }

    public function verify_otp($phone, $otp)
    {
        $customer = $this->get_customer_by_phone($phone);
        if (!$customer) {
            return array('status' => false, 'message' => 'Customer profile not found.');
        }

        if ($customer['status'] === 'blocked') {
            return array('status' => false, 'message' => 'Your account is blocked. Please contact support.');
        }

        if (empty($customer['otp_code']) || $customer['otp_code'] !== trim($otp)) {
            return array('status' => false, 'message' => 'Invalid OTP code entered.');
        }

        if (!empty($customer['otp_expiry']) && strtotime($customer['otp_expiry']) < time()) {
            return array('status' => false, 'message' => 'OTP has expired. Please request a new OTP.');
        }

        // Mark verified and clear OTP
        $this->db->where('id', $customer['id']);
        $this->db->update('customers', array(
            'is_verified' => 1,
            'otp_code'    => null,
            'otp_expiry'  => null
        ));

        $updated_customer = $this->get_customer_by_id($customer['id']);

        return array(
            'status'   => true,
            'message'  => 'Phone number verified successfully!',
            'customer' => $updated_customer
        );
    }

    public function update_status($customer_id, $status)
    {
        $this->db->where('id', $customer_id);
        return $this->db->update('customers', array('status' => $status));
    }

    public function get_customer_bookings_count($phone_or_id)
    {
        $this->db->group_start();
        $this->db->where('customer_id', $phone_or_id);
        $this->db->or_where('passenger_phone', $phone_or_id);
        $this->db->group_end();
        return $this->db->count_all_results('bookings');
    }
}
