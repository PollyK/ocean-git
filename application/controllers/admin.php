<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    private $nav_items = array(
        'pages' => array("title" => "Структура Сайта",
            "url" => "pages",
            "subpages" => array(
                'page_list' => array("title" => "Разделы", "url" => "pages"),
                'create_page' => array("title" => "Создать раздел", "url" => "pages/create_page")
            )
        ),
        'news' => array("title" => "Новости",
            "url" => "news",
            "subpages" => array(
                'news_list' => array("title" => "Новости", "url" => "news"),
                'create_news' => array("title" => "Создать новость", "url" => "news/create_news")
            )
        ),
//        'graphics' => array("title" => "Графические разделы",
//            "url" => ""),
        'faq' => array("title" => "Вопрос-ответ",
            "url" => "faq",
            "subpages" => array(
                'all' => array("title" => "Просмотр", "url" => "faq")
            )
        ),
//        'quiz' => array("title" => "Анкеты",
//            "url" => ""),
        'orders' => array("title" => "Заказы",
            "url" => "orders",
            "subpages" => array(
                'orders_list' => array("title" => "Заказы", "url" => "orders")
            )
        ),
        'banners' => array("title" => "Баннеры",
            "url" => "banners",
            "subpages" => array(
                'banners' => array("title" => "Баннеры", "url" => "banners"),
                'add_banners' => array("title" => "Добавить баннер", "url" => "add_banners")
            )
        ),
        'gallery' => array("title" => "Галерея",
            "url" => "gallery",
            "subpages" => array(
                'photos' => array("title" => "Фото", "url" => "photos")
            )
        ),
        'service' => array("title" => "Сервис",
            "url" => "service",
            "subpages" => array(
                'files2import' => array("title" => "Файлы к импорту", "url" => "service"),
                'catalog' => array("title" => "Просмотр каталога", "url" => "catalog")
            )
        )
    );

    public function __construct() {

        parent::__construct();

        $user_session = $this->session->userdata('admin_session');
        //if (!$user_session && ($_SERVER['REQUEST_URI'] != "/admin/login" && $_SERVER['REQUEST_URI'] != "/admin/login_action")) {
        if (!$user_session && substr_count($_SERVER['REQUEST_URI'], "/admin/login") == 0) {
            redirect(SITE_URL . 'admin/login');
        }
    }

    public function login() {
        $this->load->view('admin/login');
    }

    public function login_action() {
        $name = $this->input->post('name');
        $password = $this->input->post('password');

        $admin_name = $this->settings_model->find_setting('admin_name');
        $admin_password = $this->settings_model->find_setting('admin_password');



        if ($name != $admin_name && md5($password) != $admin_password) {
            redirect(SITE_URL . 'admin/login');
        }

        $this->session->set_userdata('admin_session', $admin_name);
        redirect(SITE_URL . 'admin');
    }

    public function logout() {
        $this->session->unset_userdata('admin_session');
        redirect(SITE_URL . 'admin/login');
    }

    public function index() {
        $data['nav_menu'] = $this->nav_items;
        $this->fetch_service_data($data);
        $data['active_subpage'] = "files2import";
        $this->load->view('admin/main_template', $data);
    }

    public function pages($action = false) {
        $data['nav_menu'] = $this->nav_items;
        $pages = $this->pages_model->get_pages();
        $data['pages'] = $pages;
        $this->fetch_service_data($data);
        $data['active_page'] = "pages";
        $data['active_subpage'] = "page_list";

        $data['action'] = "list";

        if ($action == 'create_page') {
            $data['active_page'] = "pages";
            $data['active_subpage'] = "create_page";

            $data['action'] = "create";
        }

        $this->load->view('admin/pages', $data);
    }

    public function edit_page($page_id) {

        $data['nav_menu'] = $this->nav_items;

        $page = $this->pages_model->get_page_by_id($page_id);
        $data['page'] = $page;

        $this->fetch_service_data($data);
        $data['active_page'] = "news";
        $data['active_subpage'] = "news_list";

        $data['action'] = "list";



        $this->load->view('admin/edit_page', $data);
    }

    public function delete_page($page_id) {
        $this->pages_model->delete_record($page_id);
        redirect(SITE_URL . "admin/pages");
    }

    public function gallery() {
        $data['nav_menu'] = $this->nav_items;

        $photos = $this->gallery_model->get_all_photos();

        $data['photos'] = $photos;

        $data['active_page'] = "gallery";
        $data['active_subpage'] = "photos";
        $data['action'] = "list";

        $this->load->view('admin/gallery', $data);
    }

    public function faq($action = false, $parameter = false) {
        $data['nav_menu'] = $this->nav_items;
        $data['active_page'] = "faq";
        //$data['content'] = "admin/pages/faq";
        $data['active_subpage'] = "all";
        if ($action) {
            SWITCH ($action) {
                case 'answer': {
                        $record_id = $this->input->post('record_id');
                        $record = $this->faq_model->get_record($record_id);
                        $answer = $this->input->post('answer');
                        $do_post = ($this->input->post('is_publish')) ? 1 : 0;

                        $user_email = $this->input->post('user_email');
                        $update['answer'] = $answer;
                        $update['is_new'] = 0;
                        $update['is_published'] = $do_post;
                        $this->faq_model->update_record($record_id, $update);
                        $message =
                                <<<EOH
На ваш вопрос: 
---
$record->question
---
Получен ответ:
$answer
    
С уважением,
Администрация Океан-Омск
EOH;
                        mail($user_email, "Ответ за Ваш вопрос с Океан-Омск", $message);
                        $this->session->set_flashdata('message', "Ваш ответ успешно сохранен");
                        redirect(SITE_URL . "admin/faq/view/" . $record_id);
                    }break;
                case 'view': {
                        $record = $this->faq_model->get_record($parameter);
                        if ($record) {
                            $data['record'] = $record;
                            $data['active_subpage'] = "all";
                            $this->load->view('admin/faq_view', $data);
                        }
                    }break;

                case 'delete': {
                        $record = $this->faq_model->get_record($parameter);
                        if ($record) {
                            $this->faq_model->delete_record($parameter);
                        }
                        $this->session->set_flashdata('message', "Вопрос успешно удален");
                        redirect(SITE_URL . "admin/faq");
                    }break;
            }
        } else {
            $data['new_questions'] = $this->faq_model->get_new_questions();
            $data['old_questions'] = $this->faq_model->get_old_questions();
            $this->load->view('admin/faq', $data);
        }
    }

    public function news($action = false) {

        $data['nav_menu'] = $this->nav_items;

        $articles = $this->articles_model->get_articles();
        $data['articles'] = $articles;

        $this->fetch_service_data($data);
        $data['active_page'] = "news";
        $data['active_subpage'] = "news_list";
        $data['action'] = "list";

        if ($action == 'create_news') {
            $data['active_page'] = "news";
            $data['active_subpage'] = "create_news";
            $data['action'] = "create";
        }
        $this->load->view('admin/news', $data);
    }

    public function edit_news($article_id) {

        $data['nav_menu'] = $this->nav_items;

        $article = $this->articles_model->get_one_article($article_id);
        $data['article'] = $article;

        $this->fetch_service_data($data);
        $data['active_page'] = "news";
        $data['active_subpage'] = "news_list";

        $data['action'] = "list";



        $this->load->view('admin/edit_news', $data);
    }

    public function delete_news($article_id) {

        $article = $this->articles_model->get_one_article($article_id);

        unlink(REAL_PATH . "stuff/news_images/" . $article->image);

        $this->articles_model->delete_record($article_id);

        redirect(SITE_URL . "admin/news");
    }

    public function create_news($action = false) {

        $date = $this->input->post('date');
        $title = $this->input->post('title');
        $short_content = $this->input->post('short_content');
        $content = $this->input->post('content');

        $config['upload_path'] = REAL_PATH . 'stuff/news_images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = 'news_' . time();

        $this->load->library('upload', $config);

        if (!$action) {
            if (!$this->upload->do_upload('news_file')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = $this->upload->data();
                $news_file = $data['file_name'];
                chmod($data['full_path'], 0777);
            }

            $data = array(
                'date' => $date,
                'title' => $title,
                'short_descr' => $short_content,
                'descr' => $content,
                'image' => $news_file,
                'type' => 'news'
            );
            $this->articles_model->create_article($data);
        } else {
            $old_image = $this->input->post('old_image');

            if (!$this->upload->do_upload('news_file')) {
                //$error = array('error' => $this->upload->display_errors());
                //var_dump($error);die;
                $news_file = $old_image;
            } else {
                $data = $this->upload->data();
                $news_file = $data['file_name'];
                chmod($data['full_path'], 0777);

                $file = $this->upload->data();
                $uploaded_filename = $file['file_name'];
                $source = $file['full_path'];
                $cmd = "convert " . $source . " -resize 768x " . $source;
                exec($cmd);
            }

            $news_id = $this->input->post('news_id');

            $data = array(
                'date' => $date,
                'title' => $title,
                'short_descr' => $short_content,
                'descr' => $content,
                'image' => $news_file,
                'type' => 'news'
            );
            $this->articles_model->update_record($news_id, $data);
        }

        redirect(SITE_URL . "admin/news");
    }

    public function orders($action = false) {
        $data['nav_menu'] = $this->nav_items;
        $pages = $this->pages_model->get_pages();
        $data['pages'] = $pages;
        $this->fetch_service_data($data);
        $data['active_page'] = "orders";
        $data['active_subpage'] = "orders_list";
        $all_orders = array();

        $orders = $this->orders_model->find_orders();
        foreach ($orders as $key => $order) {
            //var_dump($order->id); 
            $goods_on_order = $this->orders_model->find_product_from_order($order->id);

            $all_orders[$key]['order'] = $order;
            $all_orders[$key]['goods_on_order'] = $goods_on_order;
        }
        $data['all_orders'] = $all_orders;
        $data['action'] = "list";

        $this->load->view('admin/orders', $data);
    }

    public function change_order_status($order_id) {

        $order_data = array(
            'status' => '1'
        );
        $this->orders_model->update_record($order_id, $order_data);

        redirect(SITE_URL . "admin/orders");
    }

    public function delete_order($order_id) {

        $headings = $this->headings_model->find_headings($order_id);
        foreach ($headings as $one_record) {
            $this->product_model->return_product($one_record->good_id, $one_record->qty);
        }
        $this->headings_model->delete_headings_by_order($order_id);
        $this->orders_model->delete_order($order_id);

        redirect(SITE_URL . "admin/orders");
    }

    public function create_page($action = false) {
        $alias = $this->input->post('alias');
        $title = $this->input->post('title');
        $content = $this->input->post('content');

        if (!$action) {
            $data = array(
                'alias' => $alias,
                'title' => $title,
                'content' => $content,
                'url' => $alias,
                'type' => 0
            );
            $this->pages_model->create_page($data);
        } else {
            $page_id = $this->input->post('page_id');
            $data = array(
                'alias' => $alias,
                'title' => $title,
                'content' => $content,
                'url' => $alias
            );
            $this->pages_model->update_record($page_id, $data);
        }
        redirect(SITE_URL . "admin/pages");
    }

    /* SERVICE START */

    private function fetch_service_data(&$data) {
        $this->load->helper('file');
        $files_list = get_dir_file_info("dump", $top_level_only = TRUE);
        //var_dump($files_list, REAL_PATH . "dump");die;
        if ($files_list) {
            foreach ($files_list as $key => &$item) {
                if ($item['name'] != "photo_goods") {
                    $item['size'] = format_bytes($item['size']);
                    $item['date'] = date('d-m-Y', $item['date']);

                    $content = read_file($item['server_path']);
                    $parsed_content = explode("\n", $content);
                    $item['items_amount'] = count($parsed_content);
                } else {
                    unset($files_list[$key]);
                }
            }
        }
        $data['content'] = "admin/pages/service_files_to_import";
        $data['file_to_import'] = $files_list;

        $data['active_page'] = "service";
        $data['active_subpage'] = "files2import";
    }

    private function fetch_catalog_data(&$data) {
        $result = get_catalog_tree();
        $data['catalog'] = $result;
        $data['content'] = "admin/pages/catalog";
        $data['active_page'] = "service";
        $data['active_subpage'] = "catalog";
    }

    public function load_catalog_products() {

        $group_id = (int) $this->input->post('group_id');
        $products = $this->product_model->get_group_products($group_id);

        $counter = count($products);
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
                $row[] = $item->article;
                if (file_exists(REAL_PATH . $filename_th) && file_exists(REAL_PATH . $filename_orig)) {
                    $site_url = SITE_URL;
                    $product_name = htmlentities($item->product_name);
                    $row[] = "<a class=\"fancybox\" title=\"$product_name\" rel=\"group\" href=\"$site_url$filename_orig\"><img width=\"50\" src=\"$site_url$filename_th\"></a>";
                } else {
                    $row[] = "";
                }
                $row[] = $item->product_name;
                $row[] = $item->article;
                $row[] = $item->made_in;
                $row[] = $item->unit;
                $row[] = $item->price;
                $row[] = $item->qty;
                $output['aaData'][] = $row;
            }
        }
        echo json_encode($output);
    }

    public function catalog() {
        $data['nav_menu'] = $this->nav_items;
        $this->fetch_catalog_data($data);
        $this->load->view('admin/main_template', $data);
    }

    private function fetch_banners_data(&$data) {
        $banners = $this->banners_model->get_all_banners();
        $data['banners'] = $banners;

        $data['content'] = "admin/pages/banners";
        $data['active_page'] = "banners";
        $data['active_subpage'] = "banners";
    }

    public function delete_banner($id) {
        $this->banners_model->delete_banner($id);
        set_success_message("Баннер успешно удален");
        redirect(SITE_URL . "admin/banners");
    }

    public function banners() {
        $data['nav_menu'] = $this->nav_items;
        $this->fetch_banners_data($data);
        $this->load->view('admin/main_template', $data);
    }

    public function do_update_banner() {
        $banner_id = $this->input->post('banner_id');
        $banner = $this->banners_model->get_banner($banner_id);
        if (!$banner) {
            set_error_message("Баннер не найден");
            redirect(SITE_URL . "admin/banners");
        } else {
            $config['upload_path'] = REAL_PATH . 'stuff/news_images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = $banner->banner_photo;
            $this->load->library('upload', $config);


            $update_banner['banner_header'] = $this->input->post('title');
            $update_banner['visible'] = $this->input->post('is_published');
            $update_banner['on_flash'] = $this->input->post('on_flash');
            $update_banner['date'] = date('Y-m-d H:i:s');
            $update_banner['banner_link_to_article'] = $this->input->post('article_id');
            $update_banner['banner_photo'] = $banner->banner_photo;

            if (!$this->upload->do_upload('banner_file')) {
                
            } else {
                $file = $this->upload->data();
                $uploaded_filename = $file['file_name'];
                $source = $file['full_path'];
                $cmd = "convert " . $source . " -resize 768x " . $source;
                exec($cmd);
                $update_banner['banner_photo'] = $uploaded_filename;
            }
            $this->banners_model->remove_banner($banner_id);
            $this->banners_model->create_banner($update_banner);
            set_success_message("Баннер успешно Обновлен");
            redirect(SITE_URL . "admin/banners");
        }
    }

    public function do_create_banner() {
        //banner_file
        $config['upload_path'] = REAL_PATH . 'stuff/news_images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = uniqid() . date("YmdHis");
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('banner_file')) {
            set_error_message($this->upload->display_errors());
            redirect(SITE_URL . "admin/add_banners");
        } else {
            $file = $this->upload->data();
            $uploaded_filename = $file['file_name'];
            $source = $file['full_path'];
            $cmd = "convert " . $source . " -resize 768x " . $source;
            exec($cmd);
            $insert_banner['banner_photo'] = $uploaded_filename;
            $insert_banner['banner_header'] = $this->input->post('title');
            $insert_banner['visible'] = $this->input->post('is_published');
            $insert_banner['on_flash'] = $this->input->post('on_flash');
            $insert_banner['date'] = date('Y-m-d H:i:s');
            $insert_banner['banner_link_to_article'] = $this->input->post('article_id');

            $id = $this->banners_model->create_banner($insert_banner);
            if ($id) {
                set_success_message("Баннер успешно добавлен");
            } else {
                set_error_message("Баннер не создан. Свяжитесь с поддержкой (3812 378470)");
            }
            redirect(SITE_URL . "admin/banners");
        }
    }

    public function edit_banner($id) {
        $banner = $this->banners_model->get_banner($id);
        if ($banner) {
            $available_articles = $this->articles_model->get_articles();
            $data['available_articles'] = $available_articles;
            $data['banner'] = $banner;
            $data['active_page'] = "banners";
            $data['active_subpage'] = "banners";
            $data['nav_menu'] = $this->nav_items;
            $this->load->view('admin/edit_banner', $data);
        } else {
            set_error_message("Баннер не найден");
            redirect(SITE_URL . "admin/banners");
        }
    }

    public function add_banners() {
        $available_articles = $this->articles_model->get_articles();
        $data['available_articles'] = $available_articles;
        $data['active_page'] = "banners";
        $data['active_subpage'] = "add_banners";
        $data['nav_menu'] = $this->nav_items;
        $this->load->view('admin/add_banner', $data);
    }

    public function service() {
        $data['nav_menu'] = $this->nav_items;
        $this->fetch_service_data($data);
        $this->load->view('admin/main_template', $data);
    }

    public function service_do_import() {
        $this->load->helper('file');
        $files = $this->input->post('files');
        foreach ($files as $file_item) {
            $file_info = pathinfo($file_item);

            $content = read_file($file_item);
            $parsed_content = explode("\n", $content);

            if ($file_info['filename'] == "goods") {
                $this->product_model->trancate();
                foreach ($parsed_content as $line) {
                    $line_data = explode('||', $line);
                    if (count($line_data) == 7) {
                        $new_record = false;
                        $new_record['group_id'] = trim($line_data[0]);
                        $new_record['article'] = trim($line_data[1]);
                        $new_record['product_name'] = trim($line_data[2]);
                        $new_record['made_in'] = trim($line_data[3]);
                        $new_record['unit'] = trim($line_data[4]);
                        $new_record['price'] = trim($line_data[5]);
                        $new_record['qty'] = trim($line_data[6]);

                        $this->product_model->insert($new_record);
                    }
                }
            }

            if ($file_info['filename'] == "groups") {

                $this->group_model->trancate();
                foreach ($parsed_content as $line) {
                    $line_data = explode('||', $line);
                    if (count($line_data) == 3) {
                        $new_record = false;

                        $group_name = $line_data[2];
                        $group_tmp = explode(" ", $group_name);
                        $tree_id = $group_tmp[0];

                        $group_name = str_replace($tree_id, "", $group_name);


                        $new_record['id'] = $line_data[0];
                        $new_record['nest_id'] = $line_data[1];
                        $new_record['tree_id'] = $tree_id;
                        $new_record['group_name'] = $group_name;

                        $this->group_model->insert($new_record);
                    }
                }
            }

            if ($file_info['filename'] == "tree") {
                $this->tree_model->trancate();

                foreach ($parsed_content as $line) {
                    $line_data = explode('||', $line);
                    if (count($line_data) == 1 && trim($line_data[0])) {
                        $new_record = false;
                        $new_record['group_id'] = trim($line_data[0]);
                        $this->tree_model->insert($new_record);
                    }
                }
            }
        }

        set_success_message('Выбранные файлы удачно импортированы');
        redirect(SITE_URL . "admin/service");
    }

    public function upload_gallery_image() {
        //banner_file
        $config['upload_path'] = REAL_PATH . 'stuff/gallery/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = uniqid() . date("YmdHis");
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('image_file')) {
            set_error_message($this->upload->display_errors());
            redirect(SITE_URL . "admin/gallery");
        } else {
            $file = $this->upload->data();
            $uploaded_filename = $file['file_name'];

            $file = $this->upload->data();
            $source = $file['full_path'];
            $cmd = "convert " . $source . " -resize 768x " . $source;
            exec($cmd);

            $config2['image_library'] = 'gd2';
            $config2['source_image'] = $config['upload_path'] . $uploaded_filename;
            $config2['new_image'] = $config['upload_path'] . "th_" . $uploaded_filename;
            $config2['create_thumb'] = false;
            $config2['maintain_ratio'] = false;
            $config2['width'] = 100;
            $config2['height'] = 100;
            $this->load->library('image_lib');
            $this->image_lib->initialize($config2);

            $status = $this->image_lib->resize();
            $insert['name'] = $this->input->post('title');
            $insert['image'] = 'stuff/gallery/' . $uploaded_filename;
            $insert['image_th'] = 'stuff/gallery/th_' . $uploaded_filename;
            $id = $this->gallery_model->create_record($insert);

            if ($id) {
                set_success_message("Фото успешно добавлено");
            } else {
                set_error_message("Фото не создано. Свяжитесь с поддержкой (3812 378470)");
            }
            redirect(SITE_URL . "admin/gallery");
        }
    }

    public function delete_gallery_photo($id) {
        $record = $this->gallery_model->get_record($id);
        if ($record) {
            $file = REAL_PATH . $record->image;
            $file_th = REAL_PATH . $record->image_th;
            unlink($file);
            unlink($file_th);
            $this->gallery_model->delete_record($id);
            set_success_message("Фото удалено");
        } else {
            set_error_message("Фото не найдено");
        }
        redirect(SITE_URL . "admin/gallery");
    }

    public function do_update_gallery_photo() {
        $id = $this->input->post('id');
        $record = $this->gallery_model->get_record($id);
        if ($record) {
            $update['name'] = $this->input->post('title');

            $config['upload_path'] = REAL_PATH . 'stuff/gallery/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = uniqid() . date("YmdHis");
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('photo_file')) {
                //set_error_message($this->upload->display_errors());
            } else {
                $file = $this->upload->data();
                $uploaded_filename = $file['file_name'];
                $config2['image_library'] = 'gd2';
                $config2['source_image'] = $config['upload_path'] . $uploaded_filename;
                $config2['new_image'] = $config['upload_path'] . "th_" . $uploaded_filename;
                $config2['create_thumb'] = false;
                $config2['maintain_ratio'] = false;
                $config2['width'] = 100;
                $config2['height'] = 100;
                $this->load->library('image_lib');
                $this->image_lib->initialize($config2);
                $status = $this->image_lib->resize();
                $update['image'] = 'stuff/gallery/' . $uploaded_filename;
                $update['image_th'] = 'stuff/gallery/th_' . $uploaded_filename;
            }
            $this->gallery_model->update_record($id, $update);
        } else {
            set_error_message("Фото не найдено");
        }
        redirect(SITE_URL . "admin/gallery");
    }

    public function edit_gallery_photo($id) {
        $record = $this->gallery_model->get_record($id);
        if ($record) {
            $data['photo'] = $record;

            $data['nav_menu'] = $this->nav_items;

            $data['active_page'] = "gallery";
            $data['active_subpage'] = "photos";
            $data['action'] = "list";

            $this->load->view('admin/edit_gallery_photo', $data);
        } else {
            set_error_message("Фото не найдено");
            redirect(SITE_URL . "admin/gallery");
        }
    }

    /* SERVICE END */
}
