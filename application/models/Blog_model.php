<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_blogs($status = null, $limit = null, $offset = 0) {
        if ($status !== null) {
            $this->db->where('status', $status);
        }
        $this->db->order_by('created_at', 'DESC');
        if ($limit !== null) {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get('blogs');
        return $query->result_array();
    }

    public function get_blog_by_id($id) {
        $this->db->where('id', intval($id));
        $query = $this->db->get('blogs');
        return $query->row_array();
    }

    public function get_blog_by_slug($slug) {
        $this->db->where('slug', trim($slug));
        $this->db->where('status', 'published');
        $query = $this->db->get('blogs');
        return $query->row_array();
    }

    public function create_blog($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        if (!isset($data['slug']) || empty($data['slug'])) {
            $data['slug'] = $this->generate_unique_slug($data['title']);
        }
        $this->db->insert('blogs', $data);
        return $this->db->insert_id();
    }

    public function update_blog($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        if (isset($data['slug'])) {
            $data['slug'] = $this->generate_unique_slug($data['slug'], $id);
        }
        $this->db->where('id', intval($id));
        return $this->db->update('blogs', $data);
    }

    public function delete_blog($id) {
        $blog = $this->get_blog_by_id($id);
        if ($blog && !empty($blog['featured_image']) && file_exists(FCPATH . $blog['featured_image'])) {
            @unlink(FCPATH . $blog['featured_image']);
        }
        $this->db->where('id', intval($id));
        return $this->db->delete('blogs');
    }

    public function increment_views($id) {
        $this->db->set('views', 'views+1', FALSE);
        $this->db->where('id', intval($id));
        return $this->db->update('blogs');
    }

    public function get_recent_blogs($limit = 5, $exclude_id = null) {
        $this->db->where('status', 'published');
        if ($exclude_id) {
            $this->db->where('id !=', intval($exclude_id));
        }
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get('blogs');
        return $query->result_array();
    }

    public function generate_unique_slug($title, $exclude_id = null) {
        $slug = url_title($title, '-', TRUE);
        if (empty($slug)) {
            $slug = 'post-' . time();
        }

        $this->db->where('slug', $slug);
        if ($exclude_id) {
            $this->db->where('id !=', intval($exclude_id));
        }
        $count = $this->db->count_all_results('blogs');

        if ($count > 0) {
            $slug = $slug . '-' . time();
        }

        return $slug;
    }
}
