<?php

class banners_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_all_banners(){
        $result = $this->db->get('banners');
        if($result->num_rows()){
            return $result->result();
        }else{
            return false;
        }
    }
    
    public function get_active_banners(){
        $this->db->where('visible', "1");
        $result = $this->db->get('banners');
        if($result->num_rows()){
            return $result->result();
        }else{
            return false;
        }
    }
    
    public function get_banner($id){
        $this->db->where('id', $id);
        $result = $this->db->get('banners');
        if($result->num_rows()){
            $res = $result->result();
            return $res[0];
        }else{
            return false;
        }
    }
    
    
    public function create_banner($data){
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->insert('banners');
        return $this->db->insert_id();
    }
    
    public function update_banner($id, $update) {
        foreach ($update as $key => $item) {
            $this->db->set($key, $item);
        }
        $this->db->where('id', $id);
        $this->db->update('banners');
    }
    
    public function delete_banner($id) {
        $this->db->where('id', $id);
        $this->db->delete('banners');
    }

}