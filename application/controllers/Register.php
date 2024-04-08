<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Google\Client as GoogleClient;
	use Google\Service\Oauth2;
class Register extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Login_Model');
    }

    public function index(){
        // $this->load->view('registar_view');
        if($this->session->userdata('uid')== true){
                redirect('home');
            }
            if(isset($_GET['code'])){
                if($this->google->getAuthenticate()){
                    $gpInfo = $this->google->getUserInfo();
                    $userData['oauth_provider'] = 'google';
                    $userData['oauth_uid'] = $gpInfo['id'];
                    $userData['first_name'] = $gpInfo['given_name'];
                    $userData['last_name'] = $gpInfo['family_name'];
                    $userData['email'] = $gpInfo['email'];
                    $userData['gender'] = !empty($gpInfo['gender'])? $gpInfo['gender']: '';
                    $userData['locale'] = !empty($gpInfo['locale'])? $gpInfo['locale']: '';
                    $userData['link'] = !empty($gpInfo['link'])? $gpInfo['link']: '';
                    $userData['pictur'] = !empty($gpInfo['pictur'])? $gpInfo['pictur']: '';

                    $userID = $this->user->checkUser($userData);

                    $this->session->set_userdata('loggedIn',true);
                    $this->session->set_userdata('userData',$userData);

                    redirect('home');
                }
            }
            $data['loginURL'] = $this->google->loginURL();

    }

    public function Google_login(){
        $client = new GoogleClient();
			$client->setApplicationName('Web client 1');
			$client->setClientId('your clintid');
			$client->setClientSecret('your secrate key');
			$client->setRedirectUri('http://localhost/Notepad/index.php/home');
			$client->addScope(['https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/userinfo.profile']);
        
        if($code = $this->input->get('code')){
            $token = $client->fetchAccessTokenWithAuthCode($code);
            $client->setAccessToken($token);
            $oauth = new Outh2($token);
            $user_info = $oauth->userinfo->get();
            $data['mu_Fname'] = $user_info->name;
            $data['mu_Username'] = $user_info->email;
            $data['mu_image'] = $user_info->picture;
            $result = $this->Login_Model->Signup($data);
            // $user = $this->Login_Model->();
            if($result!=NULL){
                redirect('home');
            }else{
                redirect('login');
            }
        }else{
            $url = $client -> createAuthUrl();
            header('location:'.filter_var($url, FILTER_SANITIZE_URL));
        }

    }
}