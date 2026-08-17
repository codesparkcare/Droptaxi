<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_coupons()
    {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('coupons');
        return $query->result_array();
    }

    public function get_coupon_by_code($code)
    {
        $this->db->where('UPPER(code)', strtoupper(trim($code)));
        $query = $this->db->get('coupons');
        return $query->row_array();
    }

    public function validate_coupon($code, $subtotal)
    {
        $coupon = $this->get_coupon_by_code($code);
        if (!$coupon) {
            return array('status' => false, 'message' => 'Invalid coupon code.');
        }

        if ($coupon['status'] !== 'active') {
            return array('status' => false, 'message' => 'This coupon code is no longer active.');
        }

        if (!empty($coupon['expiry_date']) && strtotime($coupon['expiry_date']) < strtotime(date('Y-m-d'))) {
            return array('status' => false, 'message' => 'This coupon code has expired.');
        }

        if ($subtotal < floatval($coupon['min_order_amount'])) {
            return array('status' => false, 'message' => 'Minimum booking fare of ₹' . number_format($coupon['min_order_amount'], 0) . ' required for this coupon.');
        }

        $discount = 0;
        if ($coupon['discount_type'] === 'flat') {
            $discount = floatval($coupon['discount_value']);
        } else if ($coupon['discount_type'] === 'percent') {
            $discount = ($subtotal * floatval($coupon['discount_value'])) / 100;
        }

        $discount = min($discount, $subtotal);

        return array(
            'status' => true,
            'message' => 'Coupon applied! Saved ₹' . number_format($discount, 0),
            'code' => strtoupper($coupon['code']),
            'discount_type' => $coupon['discount_type'],
            'discount_value' => floatval($coupon['discount_value']),
            'discount_amount' => round($discount, 2)
        );
    }

    public function add_coupon($data)
    {
        return $this->db->insert('coupons', $data);
    }

    public function update_coupon($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('coupons', $data);
    }

    public function delete_coupon($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('coupons');
    }
}
