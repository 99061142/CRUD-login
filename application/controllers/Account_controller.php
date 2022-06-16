<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_controller extends MY_controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('account_model');
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