<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MY_controller{
	// Singup form
	public function signup_form(){
		$this->load->helper('form');

		$email = null;
		$password = null;

		// If the session says the user logged in
		if(isset($_SESSION['logged_in'])){
			// If the email and password are stored in the session
			if(isset($_SESSION['email'], $_SESSION['password'])){
				// Get the account data with the session data
				$where = array(
					'email' => $_SESSION['email'],
					'password' => $_SESSION['password']
				);

				$this->load->model('account_model');
				$account_information = $this->account_model->get_account_data($where);
			
				// If the account could be found
				if(isset($account_information->email, $account_information->password)){
					$email = $account_information->email;
					$password = $account_information->password;
				}
			}
		}

		// Signup data
		$data['title'] = 'Sign up'; // Title above the form
		$data['href_route'] = 'login'; // Route to the login form
		$data['href_text'] = 'Already have an account? Log In'; // Text for the route to the login form
		$data['email'] = $email; // Email that was stored inside the session
		$data['password'] = $password; // Password that was stored inside the session

		// Signup form
		$this->load->view('template/header');
		$this->load->view('pages/signup', $data);
		$this->load->view('template/footer'); 
	}


	// Login form
	public function login_form(){
		$this->load->helper('form');

		$email = null;
		$password = null;

		// If the session says the user logged in
		if(isset($_SESSION['logged_in'])){
			// If the email and password are stored in the session
			if(isset($_SESSION['email'], $_SESSION['password'])){
				// Get the account data with the session data
				$where = array(
					'email' => $_SESSION['email'],
					'password' => $_SESSION['password']
				);

				$this->load->model('account_model');
				$account_information = $this->account_model->get_account_data($where);
			
				// If the account could be found
				if(isset($account_information->email, $account_information->password)){
					$email = $account_information->email;
					$password = $account_information->password;
				}
			}
		}

		// Login data
		$data['title'] = 'Login'; // Title above the form
		$data['href_route'] = 'signup'; // Route to the signup form
		$data['href_text'] = 'Sign up for an account'; // Text for the route to the signup form
		$data['email'] = $email; // Email that was stored inside the session
		$data['password'] = $password; // Password that was stored inside the session

		// Login form
		$this->load->view('template/header');
		$this->load->view('pages/login', $data);
		$this->load->view('template/footer'); 
	}


	// Homepage
	public function homepage(){
		// Homepage
		$this->load->view('template/header');
		$this->load->view('template/navigation');
		$this->load->view('pages/homepage');
		$this->load->view('template/footer');
	}


	public function account_settings($account_info){
		$data['username'] = $_SESSION['username'];

		if($account_info == "profile"){
			$this->load->helper('form');
		}

		$this->load->view('template/header');
		$this->load->view('template/navigation');
		$this->load->view('template/account-navigation', $data);
		$this->load->view("pages/{$account_info}");
		$this->load->view('template/footer');	
	}


	// Ask if the user wants to delete the account
	public function ask_account_deletion(){
		$this->load->helper('form');

		$this->load->view('template/header');
		$this->load->view('template/navigation');
		$this->load->view('pages/ask-account-deletion');
		$this->load->view('template/footer');
	}
}