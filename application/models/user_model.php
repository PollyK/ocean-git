<?php

class user_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function insert($data) {
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->insert('user');
    }

    public function update_record($id, $update) {
        foreach ($update as $key => $item) {
            $this->db->set($key, $item);
        }
        $this->db->where('id', $id);
        $this->db->update('user');
    }

    public function auth_user($email, $password){
        $this->db->where('email', $email);
        $this->db->where('password', md5($password));
        $res = $this->db->get('user');
        if($res->num_rows()){
            return $res->row();
        }
        return false;
    }
    
    public function get_user_by_email($email) {
        $this->db->where('email', $email);
        $res = $this->db->get('user');
        if ($res->num_rows()) {
            $result = $res->row();
            return $result;
        }
        return false;
    }
    
    public function get_user_by_code($code){
        $this->db->where('secret_key', $code);
        $res = $this->db->get('user');
        if ($res->num_rows()) {
            $result = $res->row();
            return $result;
        }
        return false;
    }

}