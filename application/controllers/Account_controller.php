<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_controller extends MY_controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('account_model');
	}

	public function set_session($form_data){
		$account_data = $this->account_model->account_data($form_data);

		$this->session->userdata = array(
			'email' => $account_data->email,
			'username' => $account_data->username,
			'password' => $account_data->password,
		   	'logged_in' => TRUE
		);
	}

	public function update_account(){
		$where = array(
			'email' => $_SESSION['email'],
			'password' => $_SESSION['password']
		);
		$this->account_model->update_account($where, $_POST);
		redirect('profile');
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
    	    	'username' => $account_data->username,
				'password' => $account_data->password,
    	    	'logged_in' => TRUE
			);	
		}
	}
}