<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    private $key = "swerwer489d8vmm;ddd";

    private function crypt_text($string) {
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($this->key), $string, MCRYPT_MODE_CBC, md5(md5($this->key))));
        return $encrypted;
    }

    private function decrypt_text($string) {
        $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($this->key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($this->key))), "\0");
        return $decrypted;
    }

    function generatePassword($length = 9, $strength = 0) {
        $vowels = 'aeuy';
        $consonants = 'bdghjmnpqrstvz';
        if ($strength & 1) {
            $consonants .= 'BDGHJLMNPQRSTVWXZ';
        }
        if ($strength & 2) {
            $vowels .= "AEUY";
        }
        if ($strength & 4) {
            $consonants .= '23456789';
        }
        if ($strength & 8) {
            $consonants .= '@#$%';
        }

        $password = '';
        $alt = time() % 2;
        for ($i = 0; $i < $length; $i++) {
            if ($alt == 1) {
                $password .= $consonants[(rand() % strlen($consonants))];
                $alt = 0;
            } else {
                $password .= $vowels[(rand() % strlen($vowels))];
                $alt = 1;
            }
        }
        return $password;
    }

    public function login() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->user_model->auth_user($email, $password);
        if ($user) {
            $this->session->set_userdata('user_id', $user->id);
        } else {
            $email_exists = $this->user_model->get_user_by_email($email);
            if ($email_exists) {
                $email_key = $this->crypt_text($email);
                $this->session->set_flashdata('message', 'Неверный пароль . 
                <form action="' . SITE_URL . 'user/resend/" method="post" id="resend_password_form">
                    <input type="hidden" name="key" value="' . $email_key . '">
                 </form>

<a onclick="$(\'#resend_password_form\').submit()">Восстановить пароль?</a>');
            } else {
                $this->session->set_flashdata('message', 'Неверные данные для входа');
            }
        }
        redirect(SITE_URL . "welcome/catalog");
    }

    public function resend() {
        $key = $this->input->post('key');
        $email = $this->decrypt_text($key);
        $email_exists = $this->user_model->get_user_by_email($email);
        if ($email_exists) {
            $secret_key = $email_exists->secret_key;
            $reset_url = SITE_URL . "user/reset/" . $secret_key;
            $message = "<h4>Для сброса пароля перейдите по ссылке <a href='" . $reset_url . "'>http://ocean-omsk.ru</a> </h4>";
            $subject = "Восстановление пароля на океан-омск";

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
            $headers .= 'From: <admin@ocean-omsk.ru>' . "\r\n";
            $status = mail($email, $subject, $message, $headers);
            if ($status) {
                $this->session->set_flashdata('message', 'Проверьте свой e-mail');
            } else {
                $this->session->set_flashdata('message', 'Возникла ошибка при отправке e-mail');
            }
        } else {
            $this->session->set_flashdata('message', 'e-mail не найден. Попробуйте его зарегистрировать');
        }
        redirect(SITE_URL . "welcome/catalog");
    }

    private function assign_left_panel(&$data) {
        $result = get_catalog_tree();
        $data['catalog'] = $result;

        $result_menu = get_main_menu();
        $data['main_menu'] = $result_menu;

        $data['banners'] = get_active_banners();
    }

    public function do_reset() {
        $code = $this->input->post('code');
        $new_password = $this->input->post('new_password');

        $user = $this->user_model->get_user_by_code($code);
        if ($user) {
            $update['password'] = md5($new_password);
            $this->user_model->update_record($user->id, $update);
            $this->session->set_flashdata('message', 'Пароль сохранен. Вы можете войти в панель сайта');
        } else {
            $this->session->set_flashdata('message', 'Пользователь не найден. Обратитесь к администратору сайта');
        }
        redirect(SITE_URL . "welcome/catalog");
    }

    public function reset($code) {
        $this->assign_left_panel($data);
        $user = $this->user_model->get_user_by_code($code);
        if ($user) {
            $data['user'] = $user;
            $this->load->view('user/reset_password', $data);
        } else {
            $this->session->set_flashdata('message', 'Неверный формат адреса. Обратитесь к администратору сайта');
            redirect(SITE_URL . "welcome/catalog");
        }
    }

    public function welcome() {
        $email = $this->input->post('new_user_email');

        $email_exists = $this->user_model->get_user_by_email($email);

        if ($email_exists && trim($email)) {
            $email_key = $this->crypt_text($email);
            $this->session->set_flashdata('message', 'e-mail зарегистрирован в системе. 
                <form action="' . SITE_URL . 'user/resend/" method="post" id="resend_password_form">
                    <input type="hidden" name="key" value="' . $email_key . '">
                 </form>

<a onclick="$(\'#resend_password_form\').submit()">Восстановить пароль?</a>');
        } else {
            if (!trim($email)) {
                $this->session->set_flashdata('message', 'Некорректный e-mail');
            } else {
                $regular_password = $this->generatePassword(6);
                $insert['email'] = $email;
                $insert['status'] = 0;
                $insert['password'] = md5($regular_password);
                $insert['secret_key'] = md5($email . time());

                $message = "<h4>Ваш пароль для входа на сайт <a href='http://ocean-omsk.ru'>http://ocean-omsk.ru</a> : " . $regular_password . "</h4>";
                $subject = "Ваш пароль на океан-омск";
                $status_insert = $this->user_model->insert($insert);

                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
                $headers .= 'From: <admin@ocean-omsk.ru>' . "\r\n";
                $status = mail($email, $subject, $message, $headers);
                if ($status) {
                    $this->session->set_flashdata('message', 'Проверьте свой e-mail');
                } else {
                    $this->session->set_flashdata('message', 'Возникла ошибка при отправке e-mail');
                }
            }
        }

        redirect(SITE_URL . "welcome/catalog");
    }

    public function import() {
        $this->load->helper('file');
        $string = read_file(REAL_PATH . 'dump/');
    }

    public function logout() {
        $this->session->unset_userdata('user_id');
        redirect(SITE_URL . "welcome/catalog");
    }

    public function update_profile() {
        $user_id = $this->session->userdata('user_id');
        $update['fio'] = $this->input->post('fio');
        $update['phone'] = $this->input->post('phone');
        if ($new_password = $this->input->post('new_password')) {
            $update['password'] = md5($new_password);
        }
        $this->user_model->update_record($user_id, $update);
        $this->session->set_flashdata('message', 'Профиль обновлен');
        redirect(SITE_URL . "user/profile");
    }

    public function profile() {
        $this->assign_left_panel($data);
        $user_data = false;
        if ($user_id = $this->session->userdata('user_id')) {
            $user_data = $this->user_model->get_user_by_id($user_id);
            if ($user_data) {
                $data['user'] = $user_data;
            }
        }
        if ($user_data) {
            $this->load->view('user/profile', $data);
        } else {
            redirect(SITE_URL . "welcome/catalog");
        }
    }

    public function orders() {
        $this->assign_left_panel($data);
        if ($user_id = $this->session->userdata('user_id')) {
            $my_orders = false;
            $orders = $this->orders_model->get_my_orders($user_id);
            if ($orders) {
                foreach ($orders as &$order) {

                    $order_id = $order->id;
                    $items = $this->headings_model->find_headings($order_id);
                    $sum = 0;
                    if ($items) {
                        $place_item = false;
                        foreach ($items as $item) {
                            $product = $this->product_model->find_product_by_id($item->good_id);
                            if ($product) {
                                $sum += $product->price * $item->qty;
                                $sum = number_format($sum, 2, '.', '') . " руб.";
                                $order->sum = $sum;
                                $place_item = true;
                            }
                        }
                        if ($place_item) {
                            $my_orders[] = $order;
                        }
                    }
                }
            }
            $data['orders'] = $my_orders;
            $this->load->view('user/my_orders', $data);
        } else {
            redirect(SITE_URL . "welcome/catalog");
        }
    }

    public function load_order() {
        $load_order_data = $this->session->userdata('view_order');
        $view_result_price = $this->session->userdata('view_result_price');
        $view_cart_count = $this->session->userdata('view_cart_count');

        $this->session->set_userdata('cart_count', $view_cart_count);
        $this->session->set_userdata('cart_price', $view_result_price);
        $this->session->set_userdata('orders', $load_order_data);
        redirect(SITE_URL . "welcome/cart");
    }

    public function view_order($order_id) {
        $this->session->unset_userdata('view_order');
        $this->session->unset_userdata('view_result_price');
        $this->session->unset_userdata('view_cart_count');

        $this->assign_left_panel($data);
        if ($user_id = $this->session->userdata('user_id')) {
            $order = $this->orders_model->get_order($order_id);
            if ($order && $order->user_id == $user_id) {
                $items = $this->headings_model->find_headings($order_id);
                $orders = false;
                $cart_items_amount = 0;
                if ($items) {
                    $orders = array();
                    foreach ($items as &$item) {
                        $product = $this->product_model->find_product_by_id($item->good_id);
                        if ($product) {
                            $orders[] = array('art' => $product->article, 'count' => $item->qty);
                            $cart_items_amount++;
                        }
                    }
                }
                $this->session->set_userdata('view_cart_count', $cart_items_amount);
                $this->session->set_userdata('view_order', $orders);
                if ($orders) {
                    $result_price = 0;
                    foreach ($orders as $record) {

                        $product = $this->product_model->find_product($record["art"]);

                        $cart[$record["art"]]['qty'] = $record['count'];
                        $cart[$record["art"]]['id'] = $product[0]->id;
                        $cart[$record["art"]]['price'] = $product[0]->price;
                        $cart[$record["art"]]['product_name'] = $product[0]->product_name;
                        $cart[$record["art"]]['unit'] = $product[0]->unit;

                        $result_price += $record['count'] * $product[0]->price;
                    }
                    if ($user_id = $this->session->userdata('user_id')) {
                        $user_data = $this->user_model->get_user_by_id($user_id);
                        if ($user_data) {
                            $data['order_name'] = $user_data->fio;
                            $data['order_phone'] = $user_data->phone;
                            $data['order_creds'] = get_cookie('order_creds');
                        }
                    } else {
                        $data['order_name'] = get_cookie('order_name');
                        $data['order_phone'] = get_cookie('order_phone');
                        $data['order_creds'] = get_cookie('order_creds');
                    }

                    $this->session->set_userdata('view_result_price', $result_price);
                    $data['cart'] = $cart;
                    $data['result_price'] = $result_price;
                }
                $this->load->view('user/cart', $data);
            } else {
                $this->session->set_flashdata('message', 'Заказ не найден');
                redirect(SITE_URL . "user/orders");
            }
        } else {
            redirect(SITE_URL . "welcome/catalog");
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */