<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MY_controller{
	// Login form
	public function signin_form($form_type){
		$this->load->helper('form');

		$form_data = array(
			'form_title' => array(
				'login' => 'Login',
				'signup' => 'Sign up'
			),

			'form_href' => array(
				'login' => 'signup',
				'signup' => 'login'
			),

			'form_href_text' => array(
				'login' => 'Sign up for an account',
				'signup' => 'Already have an account? Log In'
			),

			'form_submit' => array(
				'login' => 'login',
				'signup' => 'signup'
			)
		);

		$email = null;
		$password = null;

		if(isset($_SESSION['email']) && isset($_SESSION['password'])){
			$this->load->model('login_model');
			$account_information = $this->login_model->account_information($_SESSION['email'], $_SESSION['password']);
		
			$email = $account_information->email;
			$password = $account_information->password;
		}

		// Login data
		$data['form_title'] = $form_data['form_title'][$form_type]; // Title above the form
		$data['form_href'] = $form_data['form_href'][$form_type]; // Route to the signup form
		$data['form_href_text'] = $form_data['form_href_text'][$form_type]; // Text inside the anchor to route to the signup form
		$data['form_submit'] = $form_data['form_submit'][$form_type]; // Route when the user submits the form

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