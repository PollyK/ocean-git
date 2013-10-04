<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller {

	public function index(){
            
	}
        
        public function import(){
            $this->load->helper('file');
            $string = read_file(REAL_PATH.'dump/');
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */