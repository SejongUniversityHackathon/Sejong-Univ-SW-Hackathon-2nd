<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Track extends CI_Controller {

    public function __construct() {
        parent::__construct();

        header("Content-Type: text/html; charset=UTF-8");

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('encrypt');
        $this->load->library('session');

        $this->load->model('login_m');
        $this->load->model('track_m');
        $this->load->model('lecture_m');

        $this->data['session'] = $this->session->all_userdata();   
        if($this->data['session']["is_admin"] == true) {

        } else {
			echo "<script>alert('잘못된 접근입니다.');</script>";
			header("Location: " . site_url() . 'index.php/admin/login');
        }

        $this->data['head'] = $this->load->view('admin/layouts/components/head', $this->data, true);
        $this->data['footer'] = $this->load->view('layouts/components/footer', $this->data, true);
    }

	public function index() {

		$this->data['tracks'] = $this->track_m->getAllTracks();
        foreach($this->data['tracks'] as $row) {
            $lectureIds[$row->id] = join(',', (array)($this->lecture_m->getTrackLectureList($row->id)[0]));
        }

        // echo var_dump($lectureIds);
        foreach($this->data['tracks'] as $key => $value) {
            $tmpArr = explode(',', $lectureIds[$value->id]);
            // echo var_dump($tmpArr);
            $foo = $this->lecture_m->getTrackLectures($tmpArr);
            $fooArr[$key] = 0;
            $totalGrade = 0;
            foreach($foo as $row) {
                $totalGrade += $row->L_score;
            }
            $fooArr[$key] = $totalGrade;
        }

        foreach($this->data['tracks'] as $key => $value) {
            $this->data['tracks'][$key]->totalGrade = $fooArr[$key];
        }

		$this->data['content'] = $this->load->view('admin/components/track/trackList', $this->data, true);

		echo $this->data['head'];
		echo $this->data['content'];
		echo $this->data['footer'];
	}

    public function addTrackPage() {
        $this->data['colleges'] = $this->track_m->getAllColleges();
        $this->data['content'] = $this->load->view('admin/components/track/addTrack', $this->data, true);

        echo $this->data['head'];
        echo $this->data['content'];
        echo $this->data['footer'];
    }

    public function addTrack() {
        $data = $this->input->post();

        $semester = array("0" => array(), "1" => array(), "2" => array(), "3" => array(), "4" => array(), "5" => array(), "6" => array(), "7" => array(), "8" => array());
        foreach($data as $key => $value) {
            $exp_key = explode('-', $key);
            if($exp_key[0] == 'L'){
                 $semester[$value][count($semester[$value])] = $exp_key[1];
            }
        }

        $track = array(
            'T_name' => $data['trackName'],
            'college_id' => $data['college'],
            'T_L_list1' => join(',',$semester[1]),
            'T_L_list2' => join(',',$semester[2]),
            'T_L_list3' => join(',',$semester[3]),
            'T_L_list4' => join(',',$semester[4]),
            'T_L_list5' => join(',',$semester[5]),
            'T_L_list6' => join(',',$semester[6]),
            'T_L_list7' => join(',',$semester[7]),
            'T_L_list8' => join(',',$semester[8]),
            'created' => gmdate('Y-m-d h:i:s', time()),
            'modified' => gmdate('Y-m-d h:i:s', time()),
        );

        $this->track_m->insertTrack($track);

        redirect(site_url() . 'index.php/admin/track');
    }

    public function removeTrack($id) {
        $this->track_m->deleteTrack($id);
        redirect(site_url() . 'index.php/admin/track');
    }

    public function viewTrack($id) {
        $this->data['track'] = $this->track_m->getTrack($id)[0];

        $lectureIds = join(',', (array)($this->lecture_m->getTrackLectureList($id)[0]));
// echo var_dump($this->data['track']);
        $tmpArr = explode(',', $lectureIds);
        // echo var_dump($tmpArr);
        $this->data['lectures'] = $this->lecture_m->getTrackLectures($tmpArr);
        $totalGrade = 0;
        foreach($this->data['lectures'] as $row) {
            $totalGrade += $row->L_score;
        }

        $semester = array(
            1 => $this->lecture_m->getTrackLectures(explode(',', $this->data['track']->T_L_list1)),
            2 => $this->lecture_m->getTrackLectures(explode(',', $this->data['track']->T_L_list2)),
            3 => $this->lecture_m->getTrackLectures(explode(',', $this->data['track']->T_L_list3)),
            4 => $this->lecture_m->getTrackLectures(explode(',', $this->data['track']->T_L_list4)),
            5 => $this->lecture_m->getTrackLectures(explode(',', $this->data['track']->T_L_list5)),
            6 => $this->lecture_m->getTrackLectures(explode(',', $this->data['track']->T_L_list6)),
            7 => $this->lecture_m->getTrackLectures(explode(',', $this->data['track']->T_L_list7)),
            8 => $this->lecture_m->getTrackLectures(explode(',', $this->data['track']->T_L_list8)),
        );

        // echo var_dump($this->data['lectures']);
        // foreach($this->data['lectures'] as $row) {
        //     switch ($row->L_semester) {
        //         case 1:
        //             array_push($semester[1], $row);
        //             break;
        //         case 2:
        //             array_push($semester[2], $row);
        //             break;
        //         case 3:
        //             array_push($semester[3], $row);
        //             break;
        //         case 4:
        //             array_push($semester[4], $row);
        //             break;
        //         case 5:
        //             array_push($semester[5], $row);
        //             break;
        //         case 6:
        //             array_push($semester[6], $row);
        //             break;
        //         case 7:
        //             array_push($semester[7], $row);
        //             break;
        //         case 8:
        //             array_push($semester[8], $row);
        //             break;
        //     }
        // }
        
        $this->data['lectures'] = $semester;
        // echo var_dump($this->data['lectures']);

        $this->data['content'] = $this->load->view('/components/track/trackInfo', $this->data, true);

        echo $this->data['head'];
        echo $this->data['content'];
        echo $this->data['footer'];
    }
}

