<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Driver_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all drivers ordered by newest first
     */
    public function get_all_drivers($limit = null, $offset = 0)
    {
        $this->db->order_by('id', 'DESC');
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get('drivers');
        return $query->result_array();
    }

    /**
     * Count total drivers
     */
    public function count_drivers()
    {
        return $this->db->count_all('drivers');
    }

    /**
     * Get a single driver by ID
     */
    public function get_driver_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('drivers');
        return $query->row_array();
    }

    /**
     * Get a single driver by phone number
     */
    public function get_driver_by_phone($phone)
    {
        $this->db->where('phone', trim($phone));
        $query = $this->db->get('drivers');
        return $query->row_array();
    }

    /**
     * Add a new driver
     */
    public function add_driver($data)
    {
        $this->db->insert('drivers', $data);
        return $this->db->insert_id();
    }

    /**
     * Update an existing driver
     */
    public function update_driver($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('drivers', $data);
    }

    /**
     * Delete a driver and their uploaded documents
     */
    public function delete_driver($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('drivers');
    }

    /**
     * Update active/inactive status
     */
    public function update_status($id, $status)
    {
        $this->db->where('id', $id);
        return $this->db->update('drivers', array('status' => $status));
    }

    /**
     * Toggle a verification field (is_verified or is_phone_verified)
     */
    public function update_verification($id, $field, $value)
    {
        if (!in_array($field, array('is_verified', 'is_phone_verified'))) {
            return false;
        }
        $this->db->where('id', $id);
        return $this->db->update('drivers', array($field => intval($value)));
    }

    // ===== Driver App OTP Methods =====

    /**
     * Create or update OTP for a driver (self-registration + login)
     */
    public function create_or_update_otp($name, $phone)
    {
        $phone = trim($phone);
        $name  = trim($name);

        $otp = sprintf("%04d", rand(1000, 9999));
        $expiry = date('Y-m-d H:i:s', strtotime('+10 minutes'));

        $existing = $this->get_driver_by_phone($phone);
        if ($existing) {
            if ($existing['status'] === 'inactive') {
                return array('status' => false, 'message' => 'Your account is inactive. Please contact admin.');
            }
            $update_data = array(
                'otp_code'   => $otp,
                'otp_expiry' => $expiry
            );
            if (!empty($name) && $name !== $existing['name']) {
                $update_data['name'] = $name;
            }
            $this->db->where('id', $existing['id']);
            $this->db->update('drivers', $update_data);
            $driver_id = $existing['id'];
        } else {
            // Self-registration: create new driver entry
            $insert_data = array(
                'name'              => !empty($name) ? $name : 'Driver',
                'phone'             => $phone,
                'otp_code'          => $otp,
                'otp_expiry'        => $expiry,
                'is_phone_verified' => 0,
                'is_verified'       => 0,
                'status'            => 'active'
            );
            $this->db->insert('drivers', $insert_data);
            $driver_id = $this->db->insert_id();
        }

        return array(
            'status'    => true,
            'message'   => 'OTP sent successfully to ' . $phone,
            'otp'       => $otp,
            'driver_id' => $driver_id,
            'phone'     => $phone
        );
    }

    /**
     * Verify OTP and mark phone as verified
     */
    public function verify_otp($phone, $otp)
    {
        $driver = $this->get_driver_by_phone($phone);
        if (!$driver) {
            return array('status' => false, 'message' => 'Driver profile not found.');
        }

        if ($driver['status'] === 'inactive') {
            return array('status' => false, 'message' => 'Your account is inactive. Please contact admin.');
        }

        if (empty($driver['otp_code']) || $driver['otp_code'] !== trim($otp)) {
            return array('status' => false, 'message' => 'Invalid OTP code entered.');
        }

        if (!empty($driver['otp_expiry']) && strtotime($driver['otp_expiry']) < time()) {
            return array('status' => false, 'message' => 'OTP has expired. Please request a new OTP.');
        }

        // Mark verified and clear OTP
        $this->db->where('id', $driver['id']);
        $this->db->update('drivers', array(
            'is_phone_verified' => 1,
            'otp_code'          => null,
            'otp_expiry'        => null
        ));

        $updated_driver = $this->get_driver_by_id($driver['id']);

        return array(
            'status'  => true,
            'message' => 'Phone number verified successfully!',
            'driver'  => $updated_driver
        );
    }

    /**
     * Update FCM token for push notifications
     */
    public function update_fcm_token($driver_id, $token)
    {
        $this->db->where('id', $driver_id);
        return $this->db->update('drivers', array('fcm_token' => $token));
    }

    /**
     * Get all active, phone-verified drivers
     */
    public function get_active_verified_drivers()
    {
        $this->db->where('status', 'active');
        $this->db->where('is_phone_verified', 1);
        $query = $this->db->get('drivers');
        return $query->result_array();
    }
}
