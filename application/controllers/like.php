<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Like extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('likes_m');
    }

    public function like() {
        $post = $this->input->post();
        if($this->likes_m->insertLike($post)) {
            return true;
        } else {
            return false;
        }
    }

    public function unlike() {
        $post = $this->input->post(); 
        if($this->likes_m->deleteLike($post)) {
            return true;
        } else {
            return false;
        }
    }
}

