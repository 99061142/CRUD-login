<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller{
	// Form sign up / login page
	public function form($form_type = 'login', $error_message=null){
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

		$data['error_message'] = $error_message; // Error message if the an error occured with submitting

		// load the sign up / login page
		$this->load->view('template/header');
		$this->load->view('pages/index', $data);
		$this->load->view('template/footer'); 
	}


	// Homepage to choose the board the user owns
	public function homepage(){
		// Load the homepage
		$this->load->view('template/header');
		$this->load->view('template/navigation');
		$this->load->view('pages/homepage');
		$this->load->view('template/footer');
	}


	// Controls if the user saved the login (Landings function)
	public function check_saved_login(){
		// If the user did save the login information
		if(isset($_SESSION['id'])){
			// Controls if the session id is valid
			$this->load->model('login_model');
			$session_id = $this->login_model->confirm_session_id($_SESSION['id']);

			// If id can be found of the user
			if($session_id){
				$this->homepage();
			}
			
			// If id can't be found of the user
			else{
				$this->form(); // Load the login form
			}
		}
		
		// If the user didn't save the login information
		else{
			$this->form(); // Load the login form
		}
	}
}