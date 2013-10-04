<?php

class pages_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_pages(){
        $result = $this->db->get('pages');
        if($result->num_rows()){
            return $result->result();
        }else{
            return false;
        }
    }
    
    public function get_page_by_alias($alias){
        $this->db->where('alias', $alias);
        $result = $this->db->get('pages');
        if($result->num_rows()){
            $res = $result->result();
            return $res[0];
        }else{
            return false;
        }
    }
    
    public function get_page_by_id($id){
        $this->db->where('id', $id);
        $result = $this->db->get('pages');
        if($result->num_rows()){
            $res = $result->result();
            return $res[0];
        }else{
            return false;
        }
    }
    
    public function create_page($data){
        //$this->db->query("SET NAMES 'cp1251'");
        
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->insert('pages');
    }
    
    public function update_record($id, $update) {
        foreach ($update as $key => $item) {
            $this->db->set($key, $item);
        }
        $this->db->where('id', $id);
        $this->db->update('pages');
    }
    
    public function delete_record($id) {
        $this->db->where('id', $id);
        $this->db->delete('pages');
    }

}