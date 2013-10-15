<?php

class orders_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function insert($data) {
        foreach ($data as $key => $value) {
            //$text_value = $this->cp1251_utf8($value);
            //$this->db->set($key, html_entity_decode($text_value) );
            //echo html_entity_decode($text_value).$value;
            $this->db->set($key, $value);
        }
        $this->db->insert('orders');
        return $this->db->insert_id();
    }

    public function find_orders(){
        //$escaped = $this->cp1251_utf8($keyword);
        $sql = "SELECT * FROM orders";
        $res = $this->db->query($sql);
        return $res->result();
    }
    
    public function find_product_from_order($order_id){
        $sql = "SELECT *,headings.qty as order_qty  FROM headings, goods WHERE headings.order_id='".$order_id."' AND goods.id = headings.good_id";
        
        $res = $this->db->query($sql);
        return $res->result();
        
    }
    
    public function get_order($id){
        $this->db->where('id', $id);
        $res = $this->db->get('orders');
        if($res->num_rows()){
            return $res->row();
        }else{
            return false;
        }
    }
    
    public function update_record($id, $update) {
        foreach ($update as $key => $item) {
            $this->db->set($key, $item);
        }
        $this->db->where('id', $id);
        $this->db->update('orders');
    }
    
    public function delete_order($order_id){
        //$escaped = $this->cp1251_utf8($keyword);        
        $this->db->where('id', $order_id);
        $this->db->delete('orders');
    }
    
    public function get_my_orders($user_id){
        $this->db->where('user_id', $user_id);
        $this->db->order_by('date', 'ASC');
        $res = $this->db->get('orders');
        if($res->num_rows()){
            return $res->result();
        }else{
            return false;
        }
    }

}