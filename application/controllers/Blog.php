<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'text'));
        $this->load->model('Blog_model');
        $this->load->model('Setting_model');
        $this->load->model('Vehicle_model');
    }

    public function index() {
        $data['settings'] = $this->Setting_model->get_all_settings();
        $data['blogs']    = $this->Blog_model->get_all_blogs('published');
        $data['recent_blogs'] = $this->Blog_model->get_recent_blogs(4);
        $data['vehicles'] = $this->Vehicle_model->get_all_vehicles(1);

        // SEO Meta
        $data['meta_title'] = 'DropTaxi Blog & Travel Guides | Outstation Taxi Tips & Route Advice';
        $data['meta_keywords'] = 'taxi booking blog, one way drop taxi tips, outstation cabs guide, tamil nadu travel, drop taxi routes';
        $data['meta_description'] = 'Read the latest DropTaxi blogs, travel advice, one-way taxi route guides, fare saving tips, and outstation cab booking guides across Tamil Nadu.';
        $data['canonical_url'] = base_url('blog');

        $this->load->view('blog/index', $data);
    }

    public function detail($slug = null) {
        if (empty($slug)) {
            redirect('blog');
        }

        $blog = $this->Blog_model->get_blog_by_slug($slug);
        if (!$blog) {
            show_404();
        }

        // Increment Views
        $this->Blog_model->increment_views($blog['id']);

        $data['blog']         = $blog;
        $data['settings']     = $this->Setting_model->get_all_settings();
        $data['recent_blogs'] = $this->Blog_model->get_recent_blogs(4, $blog['id']);
        $data['vehicles']     = $this->Vehicle_model->get_all_vehicles(1);

        // Dynamic SEO Meta
        $data['meta_title']       = !empty($blog['meta_title']) ? $blog['meta_title'] : $blog['title'] . ' | DropTaxi';
        $data['meta_keywords']    = !empty($blog['meta_keywords']) ? $blog['meta_keywords'] : 'taxi booking, one way drop taxi, outstation cabs';
        $data['meta_description'] = !empty($blog['meta_description']) ? $blog['meta_description'] : ($blog['excerpt'] ?: substr(strip_tags($blog['content']), 0, 155));
        $data['canonical_url']    = base_url('blog/' . $blog['slug']);
        $data['og_image']         = !empty($blog['featured_image']) ? base_url($blog['featured_image']) : base_url('assets/images/og-banner.jpg');

        $this->load->view('blog/detail', $data);
    }
}
