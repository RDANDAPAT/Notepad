<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Note_Model extends CI_Model {

	//model to create
	public function note_add($data = array()) {
		$data['mnd_modify_date'] = date('Y-m-d H:i:s');

		$query = $this->db->insert('mst_note_data', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
    }
	//model to update active note
	public function note_update($userid, $title, $content) {
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

	//model to show all active Notes
	public function active_note_edit($noteid){
		$data=array('mnd_id'=>$noteid,'mnd_status'=>1);
		$queary=$this->db->select('*')->where($data)->get('mst_note_data');
		// $result=$this->db->get('mst_note_data')->result_array();
		return $queary->result();
	}

	//model to show all active Notes
	public function active_note_list($userid){
		$data=array('mnd_mu_id'=>$userid,'mnd_status'=>1);
		$queary=$this->db->select('*')->where($data)->order_by('mnd_modify_date', 'DESC')->get('mst_note_data');
		// $result=$this->db->get('mst_note_data')->result_array();
		return $queary->result_array();
	}

	//model to move Note to bin
	public function move_note_bin($noteid){
		$data=array('mnd_status'=>0);
		$queary=$this->db->update('mst_note_data', $data, array('mnd_id' => $noteid));
		// echo $this->db->last_query();
		if($queary){
			return true;
		}
	}

	//model to show number notes in bin in nav-bar
	public function bin_note_count($userid){
		$data=array('mnd_mu_id'=>$userid,'mnd_status'=>0);
		$queary=$this->db->select('*')->where($data)->order_by('mnd_modify_date', 'DESC')->get('mst_note_data');
		// $queary=$this->db->select('*')->where($data)->order_by('mnd_modify_date', 'DESC')->get('mst_note_data')->count_all_results();
		// $result=$this->db->get('mst_note_data')->result_array();
		return $queary->num_rows();
	}

	//model to show all notes in bin
	public function bin_note_list($userid){
		$data=array('mnd_mu_id'=>$userid,'mnd_status'=>0);
		$queary=$this->db->select('*')->where($data)->order_by('mnd_modify_date', 'DESC')->get('mst_note_data');
		// $result=$this->db->get('mst_note_data')->result_array();
		return $queary->result_array();
	}

	//model to move Note restore bin to home
	public function restore_note($noteid){
		$data=array('mnd_status'=>1);
		$queary=$this->db->update('mst_note_data', $data, array('mnd_id' => $noteid));
		// echo $this->db->last_query();
		if($queary){
			return true;
		}
	}
	
	//model to delete note for ever
	public function delete_permanently($noteid){
		$queary=$this->db->delete('mst_note_data', array('mnd_id' => $noteid ));
		if($queary){
			return true;
		}
	}

}