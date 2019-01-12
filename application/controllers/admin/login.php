<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();

        header("Content-Type: text/html; charset=UTF-8");

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('encrypt');
        $this->load->library('session');

        $this->load->model('login_m');

        
        $this->data['session'] = $this->session->all_userdata();   
        $this->data['head'] = $this->load->view('admin/layouts/components/head', $this->data, true);
        $this->data['footer'] = $this->load->view('layouts/components/footer', array(), true);
    }

	public function index() {
		$this->data['content'] = $this->load->view('admin/components/login', array(), true);

		echo $this->data['head'];
		echo $this->data['content'];
		echo $this->data['footer'];
	}

	public function loginCheck() {
		$id = $this->input->post('userid');
		$password = $this->input->post('password');
		$data = $this->login_m->auth($id);
		if($this->encrypt->decode($data[0]->password) == $password) {
			$userSession = array(
				'id' => $data[0]->id,
				'userid' => $data[0]->userid,
				'username'  => $data[0]->username,
				'email'     => $data[0]->email,
				'logged_in' => TRUE,
				'is_admin' => TRUE
			);

			$this->session->set_userdata($userSession);
			header("Location: " . site_url() . "index.php/admin/track");
		} else {
			echo "<script>alert('아이디 또는 비밀번호가 다릅니다.'); location.href=document.referrer;</script>?>";
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect(site_url() . 'index.php/admin/login');
	}
}

