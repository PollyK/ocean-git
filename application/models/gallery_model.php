<?php

class gallery_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

  
    public function get_record($id){
        $this->db->where('id',$id);
        $result = $this->db->get('gallery');
        if($result->num_rows){
            $res = $result->row();
            return $res;
        }
        return false;
    }
    
    public function update_record($id, $update) {
        foreach ($update as $key => $item) {
            $this->db->set($key, $item);
        }
        $this->db->where('id', $id);
        $this->db->update('gallery');
    }
    
    public function delete_record($id) {
        $this->db->where('id', $id);
        $this->db->delete('gallery');
    }
    
    public function create_record($data){
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->insert('gallery');
        return $this->db->insert_id();
    }
 
    public function get_all_photos(){
        $result = $this->db->get('gallery');
        if($result->num_rows){
            $res = $result->result();
            return $res;
        }
        return false;
    }
    
}