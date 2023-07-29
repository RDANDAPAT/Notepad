<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	// call diffult constructor
	function __construct()
	{
		// call parent class constructor
		parent::__construct();
		if (!$this->session->userdata('uid'))
			redirect('login');
		$this->load->model('Note_Model');
	}
	
	// Difult function
	public function index()
	{
		$userid = $this->session->userdata('uid');
		$result = $this->Note_Model->active_note_list($userid);
		// $this->load->view('home', ['result'=>$results]);
		$data['result'] = $result; // Store the result in an array
		$this->load->view('home', $data);
	}

	//function To create new note
	public function create_note()
	{
		// print_r($_POST);
		// $this->form_validation->rules('title', 'Title', 'required|max_length[25]');
		// $this->form_validation->rules('note', 'Note', 'required');
		// if ($this->form_validation->run()) {
				$userid = $this->session->userdata('uid');
				$title = $this->input->post('title');
				$content = $this->input->post('note');
				$addnote = $this->Note_Model->note_add($userid, $title, $content);
				if ($addnote) {
					// Redirect to the home page after successful addition of the note
					$this->session->set_flashdata('success', 'Note Added Successfully.');
					redirect('home');
				} else {
					// If there was an error adding the note, you can handle it accordingly
					// For example, set a flash message and redirect back to the form
					$this->session->set_flashdata('error', 'Error adding the note.');
					redirect('home');
		// 		} else {
		// 		// If form validation fails, set a flash message and redirect back to the form
		// 		$this->session->set_flashdata('error', 'Please fill in both the title and note fields.');
		// 		redirect('home');
		// 	// print_r($_POST);
		}
	}

	

}
