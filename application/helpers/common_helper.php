<?php

function format_bytes($size, $precision = 2) {
    $base = log($size) / log(1024);
    $suffixes = array('', 'k', 'M', 'G', 'T');
    return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
}

function set_error_message($message) {
    $CI = & get_instance();
    $CI->session->set_flashdata('error_message', $message);
}

function get_error_message() {
    $CI = & get_instance();
    return ($CI->session->flashdata('error_message')) ? $CI->session->flashdata('error_message') : false;
}

function set_success_message($message) {
    $CI = & get_instance();
    $CI->session->set_flashdata('success_message', $message);
}

function get_success_message() {
    $CI = & get_instance();
    return ($CI->session->flashdata('success_message')) ? $CI->session->flashdata('success_message') : false;
}

function get_main_menu() {
    $CI = & get_instance();
    $result = false;
    $main_menu = $CI->pages_model->get_pages();
    return $main_menu;
}

function get_active_banners(){
    $CI = & get_instance();
    $banners = $CI->banners_model->get_active_banners();
    return $banners;
}


function get_catalog_tree() {
    $CI = & get_instance();
    $result = false;
    $catalog_tree = $CI->catalog_model->get_catalog_tree();
    if ($catalog_tree) {
        foreach ($catalog_tree as $item) {
            $nests = explode(".", $item->tree_id);
            switch (count($nests) - 1) {
                case 1: {
                        $result[$nests[0]]['group_id'] = $item->main_group_id;
                        $result[$nests[0]]['name'] = $item->group_name;
                        $result[$nests[0]]['tree_id'] = $item->tree_id;
                        $result[$nests[0]]['content'] = false;
                    }break;
                case 2: {
                        $result[$nests[0]]['content'][$nests[1]] = array('group_id' => $item->main_group_id, 'name' => trim($item->group_name), 'content' => false, 'tree_id' => $item->tree_id);
                    }break;
                case 3: {
                        $result[$nests[0]]['content'][$nests[1]]['content'][$nests[2]] = array('group_id' => $item->main_group_id, 'name' => trim($item->group_name), 'content' => false, 'tree_id' => $item->tree_id);
                    }break;
                case 4: {
                        $result[$nests[0]]['content'][$nests[1]]['content'][$nests[2]]['content'][$nests[3]] = array('group_id' => $item->main_group_id, 'name' => trim($item->group_name), 'content' => false, 'tree_id' => $item->tree_id);
                    }break;
            }
        }
        foreach ($result as &$item) {
            $group_id = $item['group_id'];
            $products = $CI->product_model->get_group_products($group_id);

            if ($item['content'] == false && !$products) {
                unset($item);
            } else {

                $tmp = end($item['content']);
            }
        }
    }
    return $result;
}

?>
