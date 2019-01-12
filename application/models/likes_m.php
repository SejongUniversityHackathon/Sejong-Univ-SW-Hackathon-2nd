<?php 
class Likes_m extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function insertLike($data) {
        // userid, type, target_id
        // type:
        //   1: track
        //   2: lecture
        $this->db->insert('likes', $data);
        if($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteLike($data) {
        $this->db->delete('likes', $data);
        if($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function isLiked($data) {
        $this->db->where($data);
        $query = $this->db->count_all_results('likes');
        return $query;
    }
}
?>