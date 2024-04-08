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
	public function create_note() {
		if($this->input->post('creatnote')) {
			if(!empty($_FILES['note_icon']['name'])) {
				$config['upload_path']   = './Uploads/'; 
				$config['allowed_types'] = 'gif|jpg|png';
				$config['file_name']     = $_FILES['note_icon']['name'];
				$config['max_size']      = 2048; 
				$config['max_width']     = 1024; 
				$config['max_height']    = 768;
	
				$this->load->library('upload');
				$this->upload->initialize($config);
				if($this->upload->do_upload('note_icon')) {
					$picture = $this->upload->data('file_name');
				} else {
					$picture = NULL;
				}
			} else {
				$picture = NULL;
			}
			$notedata = array(
				'mnd_mu_id'        => $this->session->userdata('uid'),
				'mnd_note_title'   => $this->input->post('title'),
				'mnd_note_details' => $this->input->post('note'),
				'mnd_noteimg'      => $picture,
				'mnd_status'       => 1
			);
			$addnote = $this->Note_Model->note_add($notedata);
			if ($addnote) {
				$this->session->set_flashdata('success', 'Note Added Successfully.');
				redirect('home');
			} else {
				$this->session->set_flashdata('error', 'Error adding the note.');
				redirect('home');
			}
		} else {
			$this->session->set_flashdata('error', 'Error adding the note.');
			redirect('home');
		}
	}
	
	//function To edit note
	public function update_note()
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

	//function To Edit note
	public function edit_note($noteid)
	{
        $result = $this->Note_Model->active_note_edit($noteid);
        if ($result) {
            $this->load->view('home',['row'=>$result]);
        }
	}

	//function To update note

	//function To show number of notes in bin
	public function note_bin(){
		$userid = $this->session->userdata('uid');
		$data = $this->Note_Model->bin_note_count($userid);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}




}
