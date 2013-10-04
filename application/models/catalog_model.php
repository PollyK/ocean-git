<?php

class catalog_model extends CI_Model {

    function __construct() {
        parent::__construct();
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

    public function get_catalog_tree(){
        $sql = "SELECT *, t.id as counter, g.id as main_group_id  FROM `groups` g, `tree` t WHERE g.`tree_id` = t.group_id
             order by counter ASC";
        $res = $this->db->query($sql);
        if($res->num_rows()){
            return $res->result();
        }
        return false;
    }

}