<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MY_controller{
	// Login form
	public function form_login(){
		$this->load->helper('form');

		$email = null;
		$password = null;

		if(isset($_SESSION['email']) && isset($_SESSION['password'])){
			$this->load->model('login_model');
			$account_information = $this->login_model->account_information($_SESSION['email'], $_SESSION['password']);
		
			$email = $account_information->email;
			$password = $account_information->password;
		}

		



		// Login data
		$data['form_title'] = 'Login'; // Title above the form
		$data['form_href'] = 'signup'; // Route to the signup form
		$data['form_href_text'] = 'Sign up for an account'; // Text inside the anchor to route to the signup form
		$data['form_submit'] = 'login'; // Route when the user submits the form

		$data['email'] = $email; // Email the user has logged in with
		$data['password'] = $password; // Password the user has logged in with

		// Signup / login form
		$this->load->view('template/header');
		$this->load->view('pages/index', $data);
		$this->load->view('template/footer'); 
	}


	// Sign up form
	public function form_signup(){
		$this->load->helper('form');

		$email = null;
		$password = null;

		if(isset($_SESSION['email']) && isset($_SESSION['password'])){
			$this->load->model('login_model');
			$account_information = $this->login_model->account_information($_SESSION['email'], $_SESSION['password']);
		
			$email = $account_information->email;
			$password = $account_information->password;
		}

		// Signup data
		$data['form_title'] = 'Sign up'; // Title above the form
		$data['form_href'] = 'login'; // Route to the signup form
		$data['form_href_text'] = 'Already have an account? Log In'; // Text inside the anchor to route to the signup form
		$data['form_submit'] = 'signup'; // Route when the user submits the form

		$data['email'] = $email; // Email the user has logged in with
		$data['password'] = $password; // Password the user has logged in with

		// Signup / login form
		$this->load->view('template/header');
		$this->load->view('pages/index', $data);
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
}