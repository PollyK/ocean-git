<?php

class settings_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    public function find_setting($name){
        //$escaped = $this->cp1251_utf8($keyword);
        $sql = "SELECT * FROM settings WHERE name = '".$name."'";
        $res = $this->db->query($sql);
        $result = $res->result();
        return $result[0]->value;
    }

}