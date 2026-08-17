<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_settings()
    {
        $query = $this->db->get('settings');
        $result = $query->result_array();
        $settings = array();
        foreach ($result as $row) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
        return $settings;
    }

    public function get_setting($key, $default = '')
    {
        $this->db->where('setting_key', $key);
        $query = $this->db->get('settings');
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return $row['setting_value'];
        }
        return $default;
    }

    public function save_setting($key, $value)
    {
        $this->db->where('setting_key', $key);
        $query = $this->db->get('settings');
        if ($query->num_rows() > 0) {
            $this->db->where('setting_key', $key);
            return $this->db->update('settings', array('setting_value' => $value));
        } else {
            return $this->db->insert('settings', array('setting_key' => $key, 'setting_value' => $value));
        }
    }

    public function save_batch_settings($data)
    {
        foreach ($data as $key => $value) {
            $this->save_setting($key, $value);
        }
        return true;
    }
}
