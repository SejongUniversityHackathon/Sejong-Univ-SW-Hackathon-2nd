<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
    }

	public function index() {
	}

    public function getCollegeMajors() {
        $this->load->model('lecture_m');
        $post = $this->input->post();
        $this->data['majors'] = $this->lecture_m->getCollegeMajors($post['id']);
        echo json_encode($this->data['majors']);
    }

    public function getMajorLectures() {
        $this->load->model('lecture_m');
        $post = $this->input->post();
        $this->data['lectures'] = $this->lecture_m->getMajorLectures($post['id']);
        echo json_encode($this->data['lectures']);
    }

    public function like() {
        $this->load->model('likes_m');
        $post = $this->input->post();
        echo var_dump($post);
        if($this->likes_m->insertLike($post)) {
            echo true;
        } else {
            echo false;
        }
    }

    public function unlike() {
        $this->load->model('likes_m');
        $post = $this->input->post(); 
        echo var_dump($post);
        if($this->likes_m->deleteLike($post)) {
            echo true;
        } else {
            echo false;
        }
    }

    public function done() {
        $this->load->model('lecture_m');
        $post = $this->input->post();
        echo var_dump($post);
        if($this->lecture_m->done($post)) {
            echo true;
        } else {
            echo false;
        }
    }

    public function undone() {
        $this->load->model('lecture_m');
        $post = $this->input->post(); 
        echo var_dump($post);
        if($this->lecture_m->undone($post)) {
            echo true;
        } else {
            echo false;
        }
    }

    public function isDone() {
        $this->load->model('lecture_m');
        $post = $this->input->post(); 
        $done = $this->lecture_m->isDone($post);
        echo json_encode($done);
    }
}

