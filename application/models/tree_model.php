<?php

class tree_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function trancate() {
        $sql = 'DELETE FROM `tree`';
        $this->db->query($sql);
        $this->db->query(" ALTER TABLE tree AUTO_INCREMENT = 1 ");
        
    }

    function cp1251_utf8($sInput) {
        $sOutput = "";

        for ($i = 0; $i < strlen($sInput); $i++) {
            $iAscii = ord($sInput[$i]);

            if ($iAscii >= 192 && $iAscii <= 255)
                $sOutput .= "&#" . ( 1040 + ( $iAscii - 192 ) ) . ";";
            else if ($iAscii == 168)
                $sOutput .= "&#" . ( 1025 ) . ";";
            else if ($iAscii == 184)
                $sOutput .= "&#" . ( 1105 ) . ";";
            else
                $sOutput .= $sInput[$i];
        }

        return $sOutput;
    }

    public function insert($data) {
        
        foreach ($data as $key => $value) {
            $text_value = $this->cp1251_utf8($value);

            $this->db->set($key, html_entity_decode($text_value) );
        }
        $this->db->insert('tree');
    }

    public function update_record($id, $update) {
        foreach ($update as $key => $item) {
            $this->db->set($key, $item);
        }
        $this->db->where('id', $id);
        $this->db->update('tree');
    }

}