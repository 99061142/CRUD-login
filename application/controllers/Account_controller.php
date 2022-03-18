<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_controller extends MY_controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('account_model');
	}


	// When the user submits the signup form
	public function signup(){
		// If the user answered all the questions
		if($_POST['email'] && $_POST['password']){
			// Data that is being checked if it's already used for an account
			$where = array( 
				'email' => $_POST['email']
			);

			// If the data is never used for an account
			if(!$this->account_model->exists_account($where)){
				// Data for the new account
				$new_account_data = array(
					'salt' => ''
				);

				// Add the signup form data to the data that gets added to the new account
				foreach($_POST as $key => $value){
					$new_account_data[$key] = $value;
				}

				$this->account_model->add_account($new_account_data); // Create the account
				redirect('login'); // Go to the login form
			}
		}

		redirect('signup'); // Go to the signup form
	}


	// When the user submits the login form
	public function login(){
		// Data that is being checked if it's already used for an account
		$where = array( 
			'email' => $_POST['email'],
			'password' => $_POST['password']
		);

		// If the data is being used for an account
		if($this->account_model->exists_account($where)){
			$this->get_session_data(); // Get the session data
			redirect('homepage'); // Go to the homepage
		}

		redirect("login"); // Go to the login form
	}


	// If the acount data gets changed by the user
	public function update_account(){
		$change_data = []; // Array with the data that needs to be changed

		// Add the values that needs to be changed to the array
		foreach($_POST as $key => $value){
			// If the user changed the value
			if($value){
				$change_data[$key] = $value;
			}
		}

		// Data that the account needs to update the account
		$where = array(
			'email' => $_SESSION['email'],
			'password' => $_SESSION['password']
		);

		// If there are values that needs to be changed
		if($change_data){
			$this->account_model->change_account_data($where, $change_data); // Change the values that the user changed
			$this->get_session_data(); // Updates the session data
		}

		redirect('profile'); // Redirects the user to the profile page
	}


	// If the user deletes the account
	public function delete_account(){
		// If the user wants to delete the account
		if(isset($_POST['yes'])){
			// Delete the account with the specific information inside this array
			$where = array(
				'email' => $_POST['email'],
				'password' => $_POST['password']
			);

        	$this->account_model->delete_account_data($where); // Delete the account of the user

			session_destroy(); // Delete the session data
			redirect('signup'); // Redirects the user to the singup page
		}
		
		redirect('settings'); // Redirects the user to the settings page
	}


	// Get the data of the user, and add it into the session
	public function get_session_data(){
		// If the user already logged in, but need to update the session data
		if(isset($_SESSION['email'], $_SESSION['password'])){
			$email = $_SESSION['email'];
			$password = $_SESSION['password'];
		}
		
		// If the user has logged in, and needs the session data
		else{
			$email = $_POST['email'];
			$password = $_POST['password'];
		}

		// Data that is being checked if it's already used for an account
		$where = array(
			'email' => $email,
			'password' => $password
		);

		// Check if an account exists with the data inside the array
		if($this->account_model->exists_account($where)){
			$account_data = $this->account_model->get_account_data($where); // Get the data that the model returns

			// Add the account data into the session
			$this->session->userdata = array(
        		'email' => $account_data->email,
    	    	'password' => $account_data->password,
				'username' => $account_data->username,
    	    	'logged_in' => TRUE,
			);	
		}
	}
}