<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends MY_controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('login_model');
	}


	// When the user submits the singup form
	public function signup(){
		// If the user answered all the questions
		if($_POST['email'] && $_POST['password']){
			// If the user used an new email
			if(!$this->login_model->mail_aready_used($_POST['email'])){
				$this->login_model->add_account($_POST['email'], $_POST['password']);
				redirect('login'); // Go to the login form
			}
		}

		redirect('signup'); // Go to the signup form
	}


	// When the user submits the login form
	public function login(){
		$account_information = $this->login_model->account_information($_POST['email'], $_POST['password']); // Check if the account can be found

		// If the account was found
		if($account_information){
			$this->session->userdata = array(
        		'email' => $account_information->email,
    	    	'password' => $account_information->password,
				'username' => $account_information->username,
    	    	'logged_in' => TRUE,
			);

			redirect('homepage'); // Go to the homepage
		}

		// If the account can't be found
		else{	
			redirect("login"); // Go to the login form
		}
	}
}