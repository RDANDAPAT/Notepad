<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Note_Model extends CI_Model {

	public function note_add($userid, $title, $content) {
		$data=array(
		 'mnd_mu_id'=>$userid,
		 'mnd_note_title'=> $title,
		 'mnd_note_details'=>$content,
		 'mnd_modify_date' => date('Y-m-d H:i:s'),
		 'mnd_status'=>1);
		$query = $this->db->insert('mst_note_data', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
    }

	public function active_note_list($userid){
		$data=array('mnd_mu_id'=>$userid,'mnd_status'=>1);
		$queary=$this->db->select('*')->where($data)->get('mst_note_data');
		// $result=$this->db->get('mst_note_data')->result_array();
		return $queary->result_array();
	}

	public function move_note_bin($noteid){
		$data=array('mnd_status'=>0);
		$queary=$this->db->update('mst_note_data', $data, array('mnd_id' => $noteid));
		// echo $this->db->last_query();
		if($queary){
			return true;
		}
	}

	public function bin_note_list($userid){
		$data=array('mnd_mu_id'=>$userid,'mnd_status'=>0);
		$queary=$this->db->select('*')->where($data)->get('mst_note_data');
		// $result=$this->db->get('mst_note_data')->result_array();
		return $queary->result_array();
	}

	public function delete_permanently($noteid){
		$queary=$this->db->delete('mst_note_data', array('mnd_id' => $noteid ));
		if($queary){
			return true;
		}
	}

}