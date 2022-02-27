<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller{
	// Standard function
	public function index(){
		
	}

	
	public function login($page = 'login'){
		$href_link = dirname($_SERVER['SCRIPT_NAME']) . '/'; // Link to switch from sign in / login form

		// If the user wants to sign in
		if($page != 'login'){
			$data['title'] = 'Make an account'; // Title above the form
			$data['href'] = $href_link . 'login'; // Add the parameter to the link to switch forms
			$data['href_text'] = 'Already have an account'; // Text inside the anchor
		}

		// If the user wants to log in
		else{
			$data['title'] = 'Login'; // Title above the form
			$data['href'] = $href_link . 'signup'; // Add the parameter to the link to switch forms
			$data['href_text'] = 'Sign Up'; // Text inside the anchor
		}

		$this->load->view('template/header'); # Header
		$this->load->view('pages/index', $data); # Login / sign up page
		$this->load->view('template/footer'); # Footer
	}
}
