<?php

class product_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function trancate() {
        $sql = 'DELETE FROM `goods`';
        $this->db->query($sql);
    }

//    function cp1251_utf8($sInput) {
//        $sOutput = "";
//
//        for ($i = 0; $i < strlen($sInput); $i++) {
//            $iAscii = ord($sInput[$i]);
//
//            if ($iAscii >= 192 && $iAscii <= 255)
//                $sOutput .= "&#" . ( 1040 + ( $iAscii - 192 ) ) . ";";
//            else if ($iAscii == 168)
//                $sOutput .= "&#" . ( 1025 ) . ";";
//            else if ($iAscii == 184)
//                $sOutput .= "&#" . ( 1105 ) . ";";
//            else
//                $sOutput .= $sInput[$i];
//        }
//
//        return $sOutput;
//    }

    public function insert($data) {
        $this->db->query("SET NAMES 'cp1251'");
        
        foreach ($data as $key => $value) {
            //$text_value = $this->cp1251_utf8($value);
            //$this->db->set($key, html_entity_decode($text_value) );
            //echo html_entity_decode($text_value).$value;
            $this->db->set($key, $value);
        }
        $this->db->insert('goods');
    }

    public function update_record($id, $update) {
        foreach ($update as $key => $item) {
            $this->db->set($key, $item);
        }
        $this->db->where('id', $id);
        $this->db->update('goods');
    }
    
    public function return_product($id, $qty) {
        $sql = "UPDATE goods SET qty=qty+".$qty." WHERE id = '".$id."'";
        $this->db->query($sql);
    }
    
    public function get_group_products($group_id){
        $this->db->where('group_id', $group_id);
        $result = $this->db->get('goods');
        if($result->num_rows()){
            return $result->result();
        }else{
            return false;
        }
    }
    
    public function get_all_products(){
        $result = $this->db->get('goods');
        if($result->num_rows()){
            return $result->result();
        }else{
            return false;
        }
    }
    
    public function find_products($keyword){
        //$escaped = $this->cp1251_utf8($keyword);
        $sql = "SELECT * FROM goods WHERE product_name LIKE '%".$keyword."%'";
        $res = $this->db->query($sql);
        return $res->result();
    }
    
    public function find_product($article){
        //$escaped = $this->cp1251_utf8($keyword);
        $sql = "SELECT * FROM goods WHERE article = '".$article."'";
        $res = $this->db->query($sql);
        return $res->result();
    }
    
    public function find_product_by_id($good_id){
        //$escaped = $this->cp1251_utf8($keyword);
        $sql = "SELECT * FROM goods WHERE id = '".$good_id."'";
        $result = $this->db->query($sql);
        if($result->num_rows()){
            $res = $result->result();
            return $res[0];
        }else{
            return false;
        }
    }

}