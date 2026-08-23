<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('Blog_model');
    }

    public function index() {
        $blogs = $this->Blog_model->get_all_blogs('published');

        header("Content-Type: application/xml; charset=utf-8");
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
        echo '        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"' . "\n";
        echo '        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9' . "\n";
        echo '        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";

        // 1. Homepage (Top Priority 1.0)
        echo "  <url>\n";
        echo "    <loc>" . base_url() . "</loc>\n";
        echo "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
        echo "    <changefreq>daily</changefreq>\n";
        echo "    <priority>1.0</priority>\n";
        echo "  </url>\n";

        // 2. Blog Index Page
        echo "  <url>\n";
        echo "    <loc>" . base_url('blog') . "</loc>\n";
        echo "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
        echo "    <changefreq>daily</changefreq>\n";
        echo "    <priority>0.9</priority>\n";
        echo "  </url>\n";

        // 3. Dynamic Blog Articles
        if (!empty($blogs)) {
            foreach ($blogs as $b) {
                $lastmod = !empty($b['updated_at']) ? date('Y-m-d', strtotime($b['updated_at'])) : date('Y-m-d', strtotime($b['created_at']));
                echo "  <url>\n";
                echo "    <loc>" . base_url('blog/' . $b['slug']) . "</loc>\n";
                echo "    <lastmod>" . $lastmod . "</lastmod>\n";
                echo "    <changefreq>weekly</changefreq>\n";
                echo "    <priority>0.8</priority>\n";
                echo "  </url>\n";
            }
        }

        echo '</urlset>';
    }
}
