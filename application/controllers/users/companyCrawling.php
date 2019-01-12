<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class companyCrawling extends CI_Controller {

    public function __construct() {
        parent::__construct();

        header("Content-Type: text/html; charset=UTF-8");

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('encrypt');
        $this->load->library('session');
        
        $this->data['session'] = $this->session->all_userdata();   
        $this->data['head'] = $this->load->view('layouts/components/head', $this->data, true);
        $this->data['footer'] = $this->load->view('layouts/components/footer', array(), true);
    }

	public function index() {
		$this->data['content'] = $this->load->view('crawling/Snoopy-2.0.0/companycrawling', array(), true);

		echo $this->data['head'];
		echo $this->data['content'];
		echo $this->data['footer'];
	}
}


