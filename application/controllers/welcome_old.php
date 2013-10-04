<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index() {
        $data['day_night'] = 'day';
        $time_local = (int)date('H', time());
        $night_time = array(21,22,23,0,1,2,3,4,5,6);
        if (in_array($time_local, $night_time)) {
            $data['day_night'] = 'night';
		$this->load->view('start_1', $data);
        }else{
	        $this->load->view('start', $data);
	}
    }

    private function assign_left_panel(&$data){
        $result = get_catalog_tree();
        $data['catalog'] = $result;
        
        $result_menu = get_main_menu();
        $data['main_menu'] = $result_menu;
        
        $data['banners'] = get_active_banners();
    }
            
    
    public function catalog() {
        $this->assign_left_panel($data);
        $this->load->view('catalog', $data);
    }

    public function cart() {
        $this->assign_left_panel($data);
        
        $orders = $this->session->userdata('orders');
        $cart = array();
        $result_price = $this->session->userdata('cart_price');


        if ($orders) {
            foreach ($orders as $record) {
                $product = $this->product_model->find_product($record["art"]);
                if (isset($cart[$record["art"]])) {
                    $cart[$record["art"]]['qty'] = $cart[$record["art"]]['qty'] + $record['count'];
                } else {
                    $cart[$record["art"]]['qty'] = $record['count'];
                    $cart[$record["art"]]['id'] = $product[0]->id;
                    $cart[$record["art"]]['price'] = $product[0]->price;
                    $cart[$record["art"]]['product_name'] = $product[0]->product_name;
                    $cart[$record["art"]]['unit'] = $product[0]->unit;
                }
            }
        }
        $data['cart'] = $cart;
        $data['result_price'] = $result_price;

        $this->load->view('cart', $data);
    }
    
    public function cleare_cart() {
        $this->session->unset_userdata('cart_count');
        $this->session->unset_userdata('cart_price');
        $this->session->unset_userdata('orders');

        redirect(SITE_URL . 'welcome/cart');
    }

    public function create_order() {
        $this->assign_left_panel($data);

        if ($this->input->post('id')) {
            $cart = array();

            $cart['id'] = $this->input->post('id');
            $cart['article'] = $this->input->post('article');
            $cart['product_name'] = $this->input->post('product_name');
            $cart['price'] = $this->input->post('price');
            $cart['qty'] = $this->input->post('qty');
            $cart['unit'] = $this->input->post('unit');

            $contact['contact_name'] = $this->input->post('contact_name');
            $contact['contact_phone'] = $this->input->post('contact_phone');
            $contact['contact_dop'] = $this->input->post('contact_dop');

            $result_price = $this->session->userdata('cart_price');
            $data['result_price'] = $result_price;

            $data['cart'] = $cart;
            $data['contact'] = $contact;
        }


        $this->load->view('create_order', $data);
    }

    public function confirm_order() {
        $this->assign_left_panel($data);

        $cart['id'] = $this->input->post('id');
        $cart['qty'] = $this->input->post('qty');

        $contact['contact_name'] = $this->input->post('contact_name');
        $contact['contact_phone'] = $this->input->post('contact_phone');
        $contact['contact_dop'] = $this->input->post('contact_dop');
        
       // $this->session->userdata('orders');die;
        if ($this->session->userdata('orders')) {

            $orders_data = array(
                'date' => date("Y-m-d h:i:s"),
                'contact_name' => $contact['contact_name'],
                'contact_phone' => $contact['contact_phone'],
                'contact_dopinfo' => $contact['contact_dop'],
                'ip' => $_SERVER["REMOTE_ADDR"]
            );

            $order_id = $this->orders_model->insert($orders_data);
            for ($i = 0; $i < count($cart['id']); $i++) {
                $headling_data = array(
                    'good_id' => $cart['id'][$i],
                    'order_id' => $order_id,
                    'qty' => $cart['qty'][$i]
                );
                $this->headings_model->insert($headling_data);

                $good = $this->product_model->find_product_by_id($cart['id'][$i]);
                $good_data = array(
                    'qty' => ($good->qty - $cart['qty'][$i])
                );
                $this->product_model->update_record($good->id, $good_data);
            }
            $data_template['orders_data'] = $orders_data;
            
            $data_template['goods_on_order'] = $this->orders_model->find_product_from_order($order_id);
            
            $subject = 'Новый заказ'; 
            $message = '<b>Поступил новый заказ №'.$order_id.' ['.date("Y-m-d h:i:s").']</b>';

            $template = $this->load->view('admin/order_template', $data_template, true);
            $message .= $template;
		
$subject = 'Новый заказ'; 
            $headers = 'Content-type: text/html; charset="utf8"' . "\r\n" .
                    'From: '.SEND_TO_EMAIL."\r\n" .
                'Reply-To: noreply@ocean.ru' . "\r\n";
            
            mail(SEND_TO_EMAIL, $subject, $message, $headers);
            mail("378470@gmail.com", $subject, $message, $headers);           
            $this->session->unset_userdata('cart_count');
            $this->session->unset_userdata('cart_price');
            $this->session->unset_userdata('orders');
            
            $data['message'] = 'Ваш заказ отправлен.';
        } else {
            $data['message'] = 'Для оформления заказа необходимо наличие товаров в корзине.';
        }

        $this->load->view('done_order', $data);
    }

    public function page($alias = false) {
        $this->assign_left_panel($data);
        $page = $this->pages_model->get_page_by_alias($alias);
        $data['content'] = $page->content;
        $data['additional_css'] = true;
        $data['alias'] = $alias;
        $this->load->view('page', $data);
    }

    public function about() {
        $this->assign_left_panel($data);

        $this->load->view('about', $data);
    }

    public function production() {
        $this->assign_left_panel($data);
        $this->load->view('production', $data);
    }

    public function discount() {
       $this->assign_left_panel($data);

        $this->load->view('discount', $data);
    }

    public function delivery() {
        $this->assign_left_panel($data);

        $this->load->view('delivery', $data);
    }

    public function faq() {
        $this->assign_left_panel($data);

        if ($this->input->post('action')) {
            $insert['question'] = $this->input->post('faq_question');
            $insert['answer'] = $this->input->post('');
            $insert['user_email'] = $this->input->post('faq_email');
            $insert['is_published'] = 0;
            $insert['is_new'] = 1;
            $insert['date'] = date('Y-m-d H:i:s');
            $this->faq_model->create_record($insert);
            $this->session->set_flashdata("message", "Ваш вопрос успешно отправлен администратору. Мы свяжемся с вами в ближайшее время.");
            redirect(SITE_URL . "welcome/faq");
        }
        $data['faq'] = $this->faq_model->get_published_faq();

        $this->load->view('faq', $data);
    }

    public function news() {
        $this->assign_left_panel($data);

        $articles = $this->articles_model->get_articles();
        $data['news'] = $articles;

        $this->load->view('news', $data);
    }

    public function show_news($news_id) {
       $this->assign_left_panel($data);

        $article = $this->articles_model->get_one_article($news_id);

        $data['one_record'] = $article;

        $this->load->view('show_news', $data);
    }

    public function search() {
        $keyword = $this->input->post('keyword');
        $products = $this->product_model->find_products($keyword);
        $counter = count($products);

        $orders = $this->session->userdata('orders');

        $output = array(
            "sEcho" => 0,
            "iTotalRecords" => $counter,
            "iTotalDisplayRecords" => $counter,
            "aaData" => array()
        );
        if ($products) {
            foreach ($products as $item) {
                $row = false;

                $filename_th = "dump/photo_goods/th_" . $item->article . ".png";

                $filename_orig = "dump/photo_goods/" . $item->article . ".png";



                if (file_exists(REAL_PATH . $filename_th) && file_exists(REAL_PATH . $filename_orig)) {
                    $site_url = base_url();
                    $product_name = htmlspecialchars($item->product_name);
                    $row_img = "<a class=\"fancybox\" title=\"$product_name\" rel=\"group\" href=\"$site_url$filename_orig\"><img width=\"50\" src=\"$site_url$filename_th\"></a>";
                } else {
                    $row_img = "";
                }

                if ($orders) {
                    foreach ($orders as $record) {
                        if ($item->article == $record['art']) {
                            $item->qty = $item->qty - $record['count'];
                        }
                    }
                }

                $row[] = $row_img ."<div class='article'>". $item->article."</div>";

                if ($item->qty > 0) {



                    $row[] = $item->product_name;
                    $row[] = $item->made_in;
                    $row[] = $item->price;

                    $row[] = $item->qty;
                    $row[] = $item->unit;
                    $row[] = '<input type="text" value="1" style="width:50px;">';
                    $row[] = '<button class="basket-table-img"></button>';

                    $output['aaData'][] = $row;
                }
            }
        }
        echo json_encode($output);
    }

    public function load_catalog_products() {
        $group_id = (int) $this->input->post('group_id');
        $products = $this->product_model->get_group_products($group_id);

        $counter = count($products);

        $orders = $this->session->userdata('orders');

        $output = array(
            "sEcho" => 0,
            "iTotalRecords" => $counter,
            "iTotalDisplayRecords" => $counter,
            "aaData" => array()
        );
        if ($products) {
            foreach ($products as $item) {
                $row = false;

                if ($orders) {
                    foreach ($orders as $record) {
                        if ($item->article == $record['art']) {
                            $item->qty = $item->qty - $record['count'];
                        }
                    }
                }

                $filename_th = "dump/photo_goods/th_" . $item->article . ".jpg";
                $filename_orig = "dump/photo_goods/" . $item->article . ".jpg";
                if (file_exists(REAL_PATH . $filename_th) && file_exists(REAL_PATH . $filename_orig)) {
                    $site_url = base_url();
                    $product_name = htmlspecialchars($item->product_name);
                    $row_img = "<a class=\"fancybox\" title=\"$product_name\" rel=\"group\" href=\"$site_url$filename_orig\"><img width=\"50\" src=\"$site_url$filename_th\"></a>";
                } else {
                    $row_img = "";
                }

                $row[] = $row_img ."<div class='article'>". $item->article."</div>";
                
                if ($item->qty > 0) {



                    $row[] = str_replace('"',"&quot;",$item->product_name);
                    $row[] = $item->made_in;
                    $row[] = $item->price;

                    $row[] = $item->qty;
                    $row[] = $item->unit;
                    $row[] = '<input type="text" value="1" style="width:50px;">';
                    $row[] = '<button class="basket-table-img"></button>';

                    $output['aaData'][] = $row;
                }
            }
        }


        echo json_encode($output);
    }

    public function init_product_table() {
        $view_string = $this->load->view('products_table', $data = false, true);
        $output = array($view_string);
        echo json_encode($output);
    }

    public function add_to_cart() {
        $art = $this->input->post('art');
        $count = $this->input->post('count');
        $price = $this->input->post('price');

        $orders = $this->session->userdata('orders');
        if (!$orders) {
            $orders = array();
        }

        $orders[] = array('art' => $art, 'count' => $count);

        $this->session->set_userdata('orders', $orders);

        $cart_count = $this->session->userdata('cart_count');
        $cart_price = $this->session->userdata('cart_price');

        $cart_count += $count;
        $cart_price += $count * $price;

        $this->session->set_userdata('cart_count', $cart_count);
        $this->session->set_userdata('cart_price', $cart_price);

        $output = array($cart_count, $cart_price);
        echo json_encode($output);
    }

}
