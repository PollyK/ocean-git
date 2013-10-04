<?php

class headings_model extends CI_Model {

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
        $this->db->insert('headings');
        return $this->db->insert_id();
    }

    public function find_headings($order_id){
        //$escaped = $this->cp1251_utf8($keyword);
        $sql = "SELECT * FROM headings WHERE order_id=".$order_id;
        $res = $this->db->query($sql);
        return $res->result();
    }
    
    public function delete_headings_by_order($order_id){
        //$escaped = $this->cp1251_utf8($keyword);
        
        $this->db->where('order_id', $order_id);
        $this->db->delete('headings');
    }
    

}