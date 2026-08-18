<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_booking_id()
    {
        return 'DT' . date('Ymd') . rand(1000, 9999);
    }

    public function create_booking($data)
    {
        if (empty($data['booking_id'])) {
            $data['booking_id'] = $this->generate_booking_id();
        }
        $this->db->insert('bookings', $data);
        return $data['booking_id'];
    }

    public function get_booking_by_id($booking_id)
    {
        $this->db->where('booking_id', $booking_id);
        $query = $this->db->get('bookings');
        return $query->row_array();
    }

    public function get_all_bookings($status_filter = null, $limit = null, $offset = 0)
    {
        if (!empty($status_filter)) {
            $this->db->where('booking_status', $status_filter);
        }
        $this->db->order_by('id', 'DESC');
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get('bookings');
        return $query->result_array();
    }

    public function count_bookings($status = null)
    {
        if ($status) {
            $this->db->where('booking_status', $status);
        }
        return $this->db->count_all_results('bookings');
    }

    public function get_total_revenue()
    {
        $this->db->select_sum('total_fare');
        $this->db->where('booking_status !=', 'cancelled');
        $query = $this->db->get('bookings');
        $row = $query->row_array();
        return $row['total_fare'] ? $row['total_fare'] : 0.00;
    }

    public function get_total_driver_batta()
    {
        $this->db->select_sum('driver_batta');
        $this->db->where('booking_status !=', 'cancelled');
        $query = $this->db->get('bookings');
        $row = $query->row_array();
        return $row['driver_batta'] ? floatval($row['driver_batta']) : 0.00;
    }

    public function update_booking($booking_id, $data)
    {
        $this->db->where('booking_id', $booking_id);
        return $this->db->update('bookings', $data);
    }

    public function delete_booking($booking_id)
    {
        $this->db->where('booking_id', $booking_id);
        return $this->db->delete('bookings');
    }

    // ===== Driver App Methods =====

    /**
     * Get all new/unassigned bookings for drivers to see
     */
    public function get_new_bookings()
    {
        $this->db->where('booking_status', 'new');
        $this->db->where('driver_id IS NULL', null, false);
        $this->db->order_by('pickup_date', 'ASC');
        $this->db->order_by('pickup_time', 'ASC');
        $query = $this->db->get('bookings');
        return $query->result_array();
    }

    /**
     * Assign a driver to a booking (first-come-first-served)
     */
    public function assign_driver($booking_id, $driver_id, $driver_name, $driver_phone)
    {
        // Check booking is still available
        $booking = $this->get_booking_by_id($booking_id);
        if (!$booking) {
            return array('status' => false, 'message' => 'Booking not found.');
        }
        if ($booking['booking_status'] !== 'new' || !empty($booking['driver_id'])) {
            return array('status' => false, 'message' => 'This booking has already been taken by another driver.');
        }

        $this->db->where('booking_id', $booking_id);
        $this->db->where('booking_status', 'new');
        $this->db->where('driver_id IS NULL', null, false);
        $result = $this->db->update('bookings', array(
            'driver_id'      => $driver_id,
            'driver_name'    => $driver_name,
            'driver_phone'   => $driver_phone,
            'booking_status' => 'assigned',
            'accepted_at'    => date('Y-m-d H:i:s')
        ));

        if ($result && $this->db->affected_rows() > 0) {
            $updated_booking = $this->get_booking_by_id($booking_id);
            return array('status' => true, 'message' => 'Booking accepted successfully!', 'booking' => $updated_booking);
        }

        return array('status' => false, 'message' => 'This booking has already been taken by another driver.');
    }

    /**
     * Get bookings assigned to a specific driver
     */
    public function get_driver_bookings($driver_id, $status = null)
    {
        $this->db->where('driver_id', $driver_id);
        if (!empty($status)) {
            $this->db->where('booking_status', $status);
        }
        $this->db->order_by('pickup_date', 'DESC');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('bookings');
        return $query->result_array();
    }

    /**
     * Update trip status with timestamp tracking
     */
    public function update_trip_status($booking_id, $driver_id, $new_status)
    {
        $booking = $this->get_booking_by_id($booking_id);
        if (!$booking) {
            return array('status' => false, 'message' => 'Booking not found.');
        }
        if (intval($booking['driver_id']) !== intval($driver_id)) {
            return array('status' => false, 'message' => 'You are not assigned to this booking.');
        }

        // Validate status transitions
        $valid_transitions = array(
            'assigned'  => 'picked_up',
            'picked_up' => 'completed'
        );

        $current_status = $booking['booking_status'];
        if (!isset($valid_transitions[$current_status]) || $valid_transitions[$current_status] !== $new_status) {
            return array('status' => false, 'message' => 'Invalid status transition from ' . $current_status . ' to ' . $new_status);
        }

        $update_data = array('booking_status' => $new_status);
        if ($new_status === 'picked_up') {
            $update_data['picked_up_at'] = date('Y-m-d H:i:s');
        } elseif ($new_status === 'completed') {
            $update_data['completed_at'] = date('Y-m-d H:i:s');
        }

        $this->db->where('booking_id', $booking_id);
        $this->db->update('bookings', $update_data);

        $updated_booking = $this->get_booking_by_id($booking_id);
        return array('status' => true, 'message' => 'Trip status updated to ' . $new_status, 'booking' => $updated_booking);
    }
}
