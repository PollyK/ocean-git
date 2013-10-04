<?php

class faq_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

  
    public function get_record($id){
        $this->db->where('id',$id);
        $result = $this->db->get('faq');
        if($result->num_rows){
            $res = $result->result();
            return $res[0];
        }
        return false;
    }
    
    public function update_record($id, $update) {
        foreach ($update as $key => $item) {
            $this->db->set($key, $item);
        }
        $this->db->where('id', $id);
        $this->db->update('faq');
    }
    
    public function delete_record($id) {
        $this->db->where('id', $id);
        $this->db->delete('faq');
    }
    
    public function create_record($data){
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->insert('faq');
    }
    
    public function get_published_faq(){
        $this->db->where('is_published',1);
        $result = $this->db->get('faq');
        if($result->num_rows){
            $res = $result->result();
            return $res;
        }
        return false;
    }
    
    public function get_new_questions(){
        $this->db->where('is_new',1);
        $result = $this->db->get('faq');
        if($result->num_rows){
            $res = $result->result();
            return $res;
        }
        return false;
    }
    
    public function get_old_questions(){
        $this->db->where('is_new',0);
        $result = $this->db->get('faq');
        if($result->num_rows){
            $res = $result->result();
            return $res;
        }
        return false;
    }
}