<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function verify_login($username_or_email, $password)
    {
        $this->db->group_start();
        $this->db->where('username', $username_or_email);
        $this->db->or_where('email', $username_or_email);
        $this->db->group_end();

        $query = $this->db->get('admins');
        if ($query->num_rows() === 1) {
            $admin = $query->row_array();
            if (password_verify($password, $admin['password'])) {
                return $admin;
            }
        }
        return false;
    }

    public function get_admin_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('admins');
        return $query->row_array();
    }

    public function update_profile($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('admins', $data);
    }
}
