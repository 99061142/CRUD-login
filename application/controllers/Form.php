<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require_once(dirname(__FILE__)."/page.php");

class Form extends Page{
    public function __construct(){
		parent::__construct();
		$this->load->model('login_model');
	}


	// If the user signed up
	public function form_signup(){
		$this->login_model->signup();
	}

	// If the user logged in
	public function form_login(){
		$login_id = $this->login_model->confirm_login($_POST['email'], $_POST['password']); // Check if the account is made

		// If the account was found
		if($login_id){
			$_SESSION['id'] = $login_id; // Save the accounts ID to the session
			
			$this->homepage(); // Go to the homepage
		}
		
		// If the account can't be found
		else{
			$this->form('login', 'can\'t find an account');	// Load the login form
		}
	}
}