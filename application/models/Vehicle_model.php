<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_vehicles($only_active = false)
    {
        if ($only_active) {
            $this->db->where('status', 'active');
        }
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('vehicles');
        return $query->result_array();
    }

    public function get_active_vehicles()
    {
        return $this->get_all_vehicles(true);
    }

    public function get_vehicle_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('vehicles');
        return $query->row_array();
    }

    public function get_vehicle_by_type($type_key)
    {
        $this->db->where('type_key', $type_key);
        $query = $this->db->get('vehicles');
        return $query->row_array();
    }

    public function add_vehicle($data)
    {
        return $this->db->insert('vehicles', $data);
    }

    public function update_vehicle($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('vehicles', $data);
    }

    public function delete_vehicle($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('vehicles');
    }
}
