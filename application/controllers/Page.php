<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MY_controller{
	// Signup / login form
	public function signin_form($form_type){
		$this->load->helper('form');

		$form_data = array(
			'title' => array(
				'login' => 'Login',
				'signup' => 'Sign up'
			),

			'href_route' => array(
				'login' => 'signup',
				'signup' => 'login'
			),

			'href_text' => array(
				'login' => 'Sign up for an account',
				'signup' => 'Already have an account? Log In'
			),

			'submit_route' => array(
				'login' => 'login',
				'signup' => 'signup'
			),

			'email' => null,
			'password' => null
		);

		if(isset($_SESSION['email']) && isset($_SESSION['password'])){
			$this->load->model('login_model');
			$account_information = $this->login_model->account_information($_SESSION['email'], $_SESSION['password']);
		
			$form_data['email'] = $account_information->email;
			$form_data['password'] = $account_information->password;
		}

		// Login data
		$data['title'] = $form_data['title'][$form_type]; // Title above the form
		$data['href_route'] = $form_data['href_route'][$form_type]; // Route to the signup form
		$data['href_text'] = $form_data['href_text'][$form_type]; // Text inside the anchor to route to the signup form
		$data['submit_route'] = $form_data['submit_route'][$form_type]; // Route when the user submits the form
		$data['email'] = $form_data['email']; // Email the user has logged in with
		$data['password'] = $form_data['password']; // Password the user has logged in with

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