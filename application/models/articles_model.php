<?php

class articles_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_articles(){
        $this->db->order_by("date", "desc"); 
        $result = $this->db->get('articles');
        
        if($result->num_rows()){
            return $result->result();
        }else{
            return false;
        }
    }
    
    public function get_one_article($news_id){
        $this->db->where('id', $news_id);
        $result = $this->db->get('articles');
        if($result->num_rows()){
            $res = $result->result();
            return $res[0];
        }else{
            return false;
        }
    }
    
    public function create_article($data){
        //$this->db->query("SET NAMES 'cp1251'");
        
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->insert('articles');
    }
    
    public function update_record($id, $update) {
        foreach ($update as $key => $item) {
            $this->db->set($key, $item);
        }
        $this->db->where('id', $id);
        $this->db->update('articles');
    }
    
    public function delete_record($id) {
        $this->db->where('id', $id);
        $this->db->delete('articles');
    }

}