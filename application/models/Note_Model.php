<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Note_Model extends CI_Model {

	public function note_add($userid, $title,$content,$status=0) {
		$data=array('mnd_mu_id'=>$userid, 'mnd_note_title'=> $title ,'mnd_note_details'=>$content ,'mnd_status'=>$status);
		$queary=$this->db->insart('mst_note_data', $data);
		if($queary){
			// return $this->session->set_flashdata('success','Note Added Successfully.');
		// }else{
		// 	return $this->session->set_flashdata('error','Note Added Successfully.');
		redirect('home');
		}
    }

	public function note_list($userid,$status){
		$data=array('mnd_mu_id'=>$userid,'mnd_status'=>$status);
		$queary=$this->db->where($data);
		$result=$this->db->get('mst_note_data')->result_array();;
		
		return $result;
		
	}
}