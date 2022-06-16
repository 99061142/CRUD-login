<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_controller extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
        $this->load->model('account_model');

        // If the sesssion says the user logged in
        if(isset($_SESSION['logged_in'])){
            // Check if an account exists with the session data
            $where = array(
                'email' => $_SESSION['email'],
                'password' => $_SESSION['password']
            );

            if($this->account_model->account_exists($where)){ 
                return; 
            }
        }

        // If the user tried to access the page (except signup/login page) without logging in
        if(!preg_match('(signup|login)', $this->uri->segment('1'))){ 
            redirect('login'); 
        }
    }
}