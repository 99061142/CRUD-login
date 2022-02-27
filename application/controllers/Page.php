<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller{
	// Standard function
	public function index(){
		$this->login();
	}
	

	public function login($page = 'login'){
		$href_link = dirname($_SERVER['SCRIPT_NAME']) . '/'; // Link to switch from sign in / login form

		// If the user wants to sign in
		if($page != 'login'){
			$data['title'] = 'Make an account'; // Title above the form
			$data['href'] = $href_link . 'login'; // Add the parameter to the link to switch forms
			$data['href_text'] = 'Already have an account'; // Text inside the anchor
			$data['form_submit'] = $href_link . "form/signup"; // Action if the form is submitted
		}

		// If the user wants to log in
		else{
			$data['title'] = 'Login'; // Title above the form
			$data['href'] = $href_link . 'signup'; // Add the parameter to the link to switch forms
			$data['href_text'] = 'Sign Up'; // Text inside the anchor
			$data['form_submit'] = $href_link . "form/login"; // Action if the form is submitted
		}

		$this->load->view('template/header'); # Header
		$this->load->view('pages/index', $data); # Login / sign up page
		$this->load->view('template/footer'); # Footer
	}
}