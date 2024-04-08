<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model{

	public function index($username,$password)
	{
        $data=array('mu_Username'=>$username ,'mu_Password'=>$password);
        $queary=$this->db->where($data);
        $login=$this->db->get('mst_user');
        if($login!=NULL){
            return $login->row();
        }
    }
	// public function checkUser($data = array()){
	// 	$queary = $this->db->where($data);
	// 	$row = $this->db->get('mst_user');
	// 	$check = $row->num_row();
	// 	if($check >0){
	// 		$result = $row->row_array();
	// 		$data['modified'] = date('Y-m-d H:i:s');
	// 		$update = $this->db->update('mst_user', $data, array('id'=>$result['id']));

	// 		$userID = $result['id'];
	// 	}else{
	// 		$data['created'] = date('Y-m-d H:i:s');
	// 		$data['modified'] = date('Y-m-d H:i:s');
	// 		$insert = $this->db->insert('mst_user', $data);
	// 		$userID = $this->db->insert_id();
	// 	}
	// 	return $userID?$userID:false;
	// }
	public function Signup($data){
		$queary = $this->db->insert('mst_user', $data);
		if($this->db->affected_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	// public function User_info()
}
