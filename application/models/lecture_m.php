<?php 
class Lecture_m extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    function getAllLectures() {
        $query = $this->db->get('Lecture');
        return $query->result();
    }

    function getCollegeMajors($id) {
        $this->db->where('college', $id);
        $query = $this->db->get('majors');
        return $query->result();
    }

    function getMajorLectures($id) {
        $this->db->where('major', $id);
        $query = $this->db->get('Lecture');
        return $query->result();
    }

    function getTrackLectureList($id) {
        $this->db->select('T_L_list1, T_L_list2, T_L_list3, T_L_list4, T_L_list5, T_L_list6, T_L_list7, T_L_list8');
        $this->db->where('id', $id);
        $query = $this->db->get('Track');
        return $query->result();
    }

    function getTrackLectures($data) {
        $this->db->where_in('lecuture_id', $data);
        $query = $this->db->get('Lecture');
        return $query->result();
    }

    function done($data) {
        // student_id, lecuture_id
        // type:
        //   1: track
        //   2: lecuture
        $this->db->insert('Lecture_done', $data);
        if($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function undone($data) {
        $this->db->delete('Lecture_done', $data);
        if($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function isDone($data) {
        $this->db->where($data);
        $query = $this->db->get('Lecture_done');
        return $query->result();
    }

    function doneList($id) {
        $this->db->where('student_id', $id);
        $query = $this->db->get('Lecture_done');
        return $query->result();
    }


}
?>