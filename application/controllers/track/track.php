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
        if($this->data['session']["logged_in"] == true) {

        } else {
			echo "<script>alert('로그인이 필요합니다.');</script>";
			header("Location: " . site_url() . 'index.php/users/login');
        }

        $this->data['head'] = $this->load->view('layouts/components/head', $this->data, true);
        $this->data['footer'] = $this->load->view('layouts/components/footer', $this->data, true);
    }

	public function index() {

        $this->load->model('likes_m');

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
            $tmpArr = array(
                'student_id' => $this->data['session']['id'],
                'type' => 1,
                'target_id' => $value->id
            );
            $this->data['tracks'][$key]->isLiked = false;
            if($this->likes_m->isLiked($tmpArr) > 0) {
                $this->data['tracks'][$key]->isLiked = true;
            }

        }

		$this->data['content'] = $this->load->view('components/track/trackList', $this->data, true);

		echo $this->data['head'];
		echo $this->data['content'];
		echo $this->data['footer'];
	}

    public function addTrackPage() {
        $this->data['colleges'] = $this->track_m->getAllColleges();
        $this->data['content'] = $this->load->view('components/track/addTrack', $this->data, true);

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

        redirect(site_url() . 'index.php/track/track');
    }

    public function removeTrack($id) {
        $this->track_m->deleteTrack($id);
        redirect(site_url() . 'index.php/track/track');
    }

    public function viewTrack($id) {
        $this->data['track'] = $this->track_m->getTrack($id)[0];

        $lectureIds = join(',', (array)($this->lecture_m->getTrackLectureList($id)[0]));

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

        $this->data['content'] = $this->load->view('/components/track/trackInfo', $this->data, true);

        echo $this->data['head'];
        echo $this->data['content'];
        echo $this->data['footer'];
    }

    public function trackLiked() {

        $this->load->model('likes_m');

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
            $tmpArr = array(
                'student_id' => $this->data['session']['id'],
                'type' => 1,
                'target_id' => $value->id
            );
            $this->data['tracks'][$key]->isLiked = false;
            if($this->likes_m->isLiked($tmpArr) > 0) {
                $this->data['tracks'][$key]->isLiked = true;
            }

        }

        $this->data['content'] = $this->load->view('components/track/trackLiked', $this->data, true);

        echo $this->data['head'];
        echo $this->data['content'];
        echo $this->data['footer'];
    }

    public function trackDone() {

        $this->load->model('lecture_m');
        $this->load->model('likes_m');

        $doneList = $this->lecture_m->doneList($this->data['session']['id']);
        $doneArr = array();
        $trackArr = array();
        foreach($doneList as $row) {
            array_push($doneArr, $row->lecuture_id);
        }

        $this->data['tracks'] = $this->track_m->getAllTracks();
        foreach($this->data['tracks'] as $row) {
            $lectureIds[$row->id] = join(',', (array)($this->lecture_m->getTrackLectureList($row->id)[0]));
        }

        foreach ($lectureIds as $key => $value) {
            $trackArr[$key] = (explode(',', $value));
        }

        $targetTrack = array();

        foreach($trackArr as $key => $value) {
            foreach ($value as $key2 => $value2) {
                foreach($doneArr as $key3 => $value3) {
                    if($value2 == $value3) {
                        $targetTrack[$key] = true;
                        continue;
                    }
                }
            }
        }

        $this->data['doneTracks'] = $targetTrack;

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
            $tmpArr = array(
                'student_id' => $this->data['session']['id'],
                'type' => 1,
                'target_id' => $value->id
            );
            $this->data['tracks'][$key]->isLiked = false;
            if($this->likes_m->isLiked($tmpArr) > 0) {
                $this->data['tracks'][$key]->isLiked = true;
            }

        }

        $this->data['content'] = $this->load->view('components/track/trackDone', $this->data, true);

        echo $this->data['head'];
        echo $this->data['content'];
        echo $this->data['footer'];
    }
}

