<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Razorpay_lib {

    private $key_id;
    private $key_secret;
    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('Setting_model');

        $settings = $this->CI->Setting_model->get_all_settings();
        $this->key_id = isset($settings['razorpay_key_id']) ? $settings['razorpay_key_id'] : '';
        $this->key_secret = isset($settings['razorpay_key_secret']) ? $settings['razorpay_key_secret'] : '';
    }

    public function create_order($amount_in_rupees, $receipt_id)
    {
        if (empty($this->key_id) || empty($this->key_secret)) {
            return array('status' => false, 'message' => 'Razorpay credentials not configured in admin settings.');
        }

        $url = "https://api.razorpay.com/v1/orders";
        $amount_in_paise = round($amount_in_rupees * 100);

        $fields = array(
            'amount' => $amount_in_paise,
            'currency' => 'INR',
            'receipt' => $receipt_id,
            'payment_capture' => 1
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $this->key_id . ":" . $this->key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));

        $result = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code == 200 && !empty($result)) {
            $response = json_decode($result, true);
            return array('status' => true, 'order' => $response, 'key_id' => $this->key_id);
        } else {
            return array('status' => false, 'message' => 'Razorpay order creation failed: ' . $result);
        }
    }

    public function verify_signature($razorpay_order_id, $razorpay_payment_id, $razorpay_signature)
    {
        $expected_signature = hash_hmac('sha256', $razorpay_order_id . '|' . $razorpay_payment_id, $this->key_secret);
        return hash_equals($expected_signature, $razorpay_signature);
    }
}
