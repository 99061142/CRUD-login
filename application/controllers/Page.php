<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller{
	// Standard function
	public function index(){
		// If session is active
		if(isset($_SESSION)){
			// If there is an email and password in the session 
			if(($_SESSION['email']) && $_SESSION['password']){
				$this->load->model('login_model');
				$this->login_model->check_login();
			}
		}
		
		else{
			$this->form(); // Show the login form
		}
	}
	

	public function form($form_type = 'login'){
		$href_link = dirname($_SERVER['SCRIPT_NAME']) . '/'; // Link to switch from sign in / login form

		// If the user wants to sign in
		if($form_type != 'login'){
			$data['form_title'] = 'sign up'; // Title above the form
			$data['form_href'] = $href_link . 'login'; // Add the parameter to the link to switch forms
			$data['form_href_text'] = 'Already have an account? Log In'; // Text inside the anchor
			$data['form_submit'] = $href_link . "form/form_signup"; // Action if the form is submitted
		}

		// If the user wants to log in
		else{
			$data['form_title'] = 'login'; // Title above the form
			$data['form_href'] = $href_link . 'signup'; // Add the parameter to the link to switch forms
			$data['form_href_text'] = 'Sign up for an account'; // Text inside the anchor
			$data['form_submit'] = $href_link . "form/form_login"; // Action if the form is submitted
		}

		$this->load->view('template/header'); # Header
		$this->load->view('pages/index', $data); # Login / sign up page
		$this->load->view('template/footer'); # Footer
	}
}