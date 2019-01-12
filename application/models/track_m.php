<?php 
class Track_m extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    function getAllTracks() {
        // $this->db->join('colleges', 'colleges.id = Track.college_id');
        // $query = $this->db->get('Track');
        $this->db->join('Track', 'Track.college_id = colleges.id');
        $query = $this->db->get('colleges');
        return $query->result();
    }

    function getTrack($id) {
        $this->db->where('Track.id', $id);
        // $this->db->join('colleges', 'colleges.id = Track.college_id');
        // $query = $this->db->get('Track');
        $this->db->join('Track', 'Track.college_id = colleges.id');
        $query = $this->db->get('colleges');
        return $query->result();
    }

    function getAllColleges() {
        $query = $this->db->get('colleges');
        return $query->result();
    }

    function insertTrack($data) {
        $this->db->insert('Track', $data);
    }

    function deleteTrack($id) {
        $this->db->delete('Track', array('id' => $id));
    }
}
?>