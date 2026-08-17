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
}
