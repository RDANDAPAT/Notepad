<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct(){
        parent::__construct();
        // $this->load->library('google');
        $this->load->model('Login_Model');
    }

	public function index()
	{

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if($this->form_validation->run()){
            $username=$this->input->post('username');
            $password=$this->input->post('password');
            // $this->load->model('Login_Model');
            $valid=$this->Login_Model->index($username,$password);
            if($valid){
                $this->session->set_userdata('uid',$valid->mu_id);
                $this->session->set_userdata('fname',$valid->mu_Fname);
                $this->session->set_userdata('lname',$valid->mu_Lname);
                redirect('home');
            }else{
                redirect('login');
                
            }
        }else{
            $this->load->view('login');
	    }
    }
}