<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('uid'))
		redirect('login');
	}

	public function index()
	{	$userid=$this->session->userdata('uid');
		$this->load->model('Note_Model');
		$result=$this->Note_Model->note_list($userid,$status=1);
		$data['result'] = $result; // Store the result in an array
    	$this->load->view('home', $data);
    }
	public function create_note(){
		$this->form_validation->rules('title' , 'Title' , 'required');
		if($this->form_validation->run()){
			$userid=$this->session->userdata('uid');
			$title=$this->input->post('title');
			$content=$this->input->post('note');
			$this->load->model('Note_Model');
			$addnote=$this->Note_Model->note_add($userid, $title,$content,$status=0);
			if($addnote){

			}
		}else{
			return $this->session->set_flashdata('error','Please Add Note Title.');
		}
	}
}
