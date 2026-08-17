<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiry_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function save_enquiry($data)
    {
        return $this->db->insert('enquiries', $data);
    }

    public function get_all_enquiries()
    {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('enquiries');
        return $query->result_array();
    }

    public function count_unread_enquiries()
    {
        $this->db->where('status', 'unread');
        return $this->db->count_all_results('enquiries');
    }

    public function update_status($id, $status)
    {
        $this->db->where('id', $id);
        return $this->db->update('enquiries', array('status' => $status));
    }

    public function delete_enquiry($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('enquiries');
    }
}
