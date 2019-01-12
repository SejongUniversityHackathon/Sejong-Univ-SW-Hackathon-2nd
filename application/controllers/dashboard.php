<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
            parent::__construct();

            $this->load->helper('url');
            $this->load->library('encrypt');
            $this->load->model('login_m');
            $this->load->library('session');
            $this->load->database();
            
            $this->data = array();
            $this->data['head'] = $this->load->view('layouts/components/head', array(), true);
            $this->data['footer'] = $this->load->view('layouts/components/footer', array(), true);

            $this->data['session'] = $this->session->all_userdata();
            if($this->data['session']['logged_in'] == true && $this->data['session']['is_admin'] == false) {

 			} else {
				echo "<script>alert('로그인이 필요합니다.');</script>";
				header("Location: " . site_url() . 'index.php/users/login');
            }

    }

	public function index()
	{
		echo $this->data['head'];
        $this->data['content'] = $this->load->view('components/dashboard', $this->data, true);
        echo $this->data['content'];
		echo $this->data['footer'];
	}
}

