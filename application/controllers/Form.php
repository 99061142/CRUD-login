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
		// If the user correctly logged in
		if($this->login_model->account_information($_POST['email'], $_POST['password'])){
			$this->get_session_data(); // Get the session data
			redirect('homepage'); // Go to the homepage
		}

		// If the account can't be found
		else{	
			redirect("login"); // Go to the login form
		}
	}


	public function get_session_data(){
		// If the user already logged in, but need to update the session data
		if(isset($_SESSION['email'], $_SESSION['password'])){
			$email = $_SESSION['email'];
			$password = $_SESSION['password'];
		}
		
		// If the user has logged in, and need the starting session data
		else{
			$email = $_POST['email'];
			$password = $_POST['password'];
		}

		$account_information = $this->login_model->account_information($email, $password); // Check if the account can be found

		// If the account was found
		if($account_information){
			// Add the account data into the session
			$this->session->userdata = array(
        		'email' => $account_information->email,
    	    	'password' => $account_information->password,
				'username' => $account_information->username,
    	    	'logged_in' => TRUE,
			);	
		}
	}


	// If the user changed his profile 
	public function profile(){
		$account_id = $this->login_model->get_account_id($_SESSION['email'], $_SESSION['password']); // Get the id of the account
	
		$data = []; // Array where the data gets stored that needs to be changed

		// Add the values that needs to be changed to the array
		foreach($_POST as $key => $value){
			// If the user changed the value
			if($value){
				$data[$key] = $value;
			}
		}

		$this->login_model->change_account_data($_SESSION['email'], $_SESSION['password'], $data); // Change the values that the user changed

		$this->get_session_data(); // Update the session data
		redirect('profile'); // Redirects the user back
	}


	public function delete_account(){
		// If the user wants to delete the account
		if(isset($_POST['yes'])){
        	$this->login_model->delete_account_data($_SESSION['email'], $_SESSION['password']); // Delete the account of the user

			session_destroy(); // Delete the session data
			redirect('signup'); // Redirects the user to the singup page
		}
		
		// If the user did not want to delete the account
		else{
			redirect('settings'); // Redirects the user to the settings page
		}
	}
}