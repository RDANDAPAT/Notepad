<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Delete_Note extends CI_Controller
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
        $result = $this->Note_Model->bin_note_list($userid);
        // $this->load->view('home', ['result'=>$results]);
        $data['result'] = $result; // Store the result in an array
        $this->load->view('delete_note', $data);
    }

    //functin for move note to recycle bin
    public function delete_note($noteid)
    {
        $result = $this->Note_Model->move_note_bin($noteid);
        if ($result) {
            redirect('Delete_Note');
        }
    }

    //function to Delete Note Parmanently
    public function delete_permanently($noteid)
    {
        $result = $this->Note_Model->delete_permanently($noteid);
        if ($result) {
            redirect('Delete_Note');
        }
    }
}
