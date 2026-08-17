<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('send_smtp_email')) {
    function send_smtp_email($to_email, $subject, $message_html) {
        $CI =& get_instance();
        $CI->load->model('Setting_model');
        $CI->load->library('email');

        $settings = $CI->Setting_model->get_all_settings();

        $smtp_host     = isset($settings['smtp_host']) ? $settings['smtp_host'] : '';
        $smtp_port     = isset($settings['smtp_port']) ? $settings['smtp_port'] : 587;
        $smtp_user     = isset($settings['smtp_user']) ? $settings['smtp_user'] : '';
        $smtp_pass     = isset($settings['smtp_pass']) ? $settings['smtp_pass'] : '';
        $smtp_crypto   = isset($settings['smtp_crypto']) ? $settings['smtp_crypto'] : 'tls';
        $from_email    = !empty($settings['smtp_from_email']) ? $settings['smtp_from_email'] : 'noreply@droptaxi.com';
        $from_name     = !empty($settings['smtp_from_name']) ? $settings['smtp_from_name'] : 'DropTaxi Booking';

        if (empty($smtp_host) || empty($smtp_user)) {
            $config = array(
                'protocol'  => 'mail',
                'mailtype'  => 'html',
                'charset'   => 'utf-8',
                'newline'   => "\r\n",
                'crlf'      => "\r\n"
            );
        } else {
            $config = array(
                'protocol'    => 'smtp',
                'smtp_host'   => $smtp_host,
                'smtp_port'   => (int)$smtp_port,
                'smtp_user'   => $smtp_user,
                'smtp_pass'   => $smtp_pass,
                'smtp_crypto' => $smtp_crypto,
                'mailtype'    => 'html',
                'charset'     => 'utf-8',
                'newline'     => "\r\n",
                'crlf'        => "\r\n"
            );
        }

        $CI->email->initialize($config);
        $CI->email->from($from_email, $from_name);
        $CI->email->to($to_email);
        $CI->email->subject($subject);
        $CI->email->message($message_html);

        if ($CI->email->send()) {
            return true;
        } else {
            log_message('error', 'Email Send Error: ' . $CI->email->print_debugger(array('headers')));
            return false;
        }
    }
}
