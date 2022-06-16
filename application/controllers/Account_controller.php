<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_controller extends MY_controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('account_model');
	}


	// When the user submits the signup form
	public function signup(){
		// If the user answered all the questions
		if($_POST['email'] && $_POST['password'] && $_POST['username']){
			// If the data is never used before
			$where = array( 
				'email' => $_POST['email'],
				'username' => $_POST['username']
			);

			if(!$this->account_model->account_exists($where)){
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
		// check if the data is alreay in use for an account
		$where = array(
			'email' => $_POST['email'],
			'password' => $_POST['password']
		);

		

		// If the data is used for an account
		if($this->account_model->account_exists($where)){
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
	public function delete_account_data(){
		$where = array(
			'email' => $_SESSION['email'],
			'password' => $_SESSION['password']
		);
		$this->account_model->delete_account_data($where);
		session_destroy();
		redirect('signup');
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
		if($this->account_model->account_exists($where)){
			$account_data = $this->account_model->account_data($where);

			// Add the account data into the session
			$this->session->userdata = array(
        		'email' => $account_data->email,
    	    	'password' => $account_data->password,
				'username' => $account_data->username,
    	    	'logged_in' => TRUE,
			);	
		}
	}


	public function set_session($data){
		$this->session->userdata = array(
			'email' => $data['email'],
		   	'password' => $data['password'],
		   	'logged_in' => TRUE,
		);
	}
}