<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once (dirname(__FILE__) . "/account_controller.php");

class Page_controller extends Account_controller{
    public function __construct() {
        parent::__construct();
		$this->load->helper('form');
    }

	public function signup() {
		$form_inputs = ['email', 'username', 'password']; // The inputs that are needed to sign up

		// Set the input / errors values 
		foreach($form_inputs as $input){
			if(isset($_POST[$input])) {
				$data[$input] = $_POST[$input]; // Input value
			}elseif(isset($_SESSION[$input])) {
				$data[$input] = $_SESSION[$input]; // Session value
			}

			if($_POST) {
				$data["{$input}_error"] = empty($data[$input]) ? "{$input} is required" : "";
			}else {
				// First time page loaded
				$data["{$input}_error"] = "";
				$data[$input] = "";
			}
		}

		// If the user signed up and used an email that was already used
		if(!empty($data['email']) && $_POST && $this->account_model->email_exists($data['email'])){
			$data['email_error'] = "The email is already in use";
		}

		// Check if there are no errors
		$errors = false;
		foreach ($data as $key => $value) {
			if(!in_array($key, $form_inputs) && !empty($value)) {
				$errors = true;
				break;
			}
		}

		// If the user signed up and there are no errors
		if($_POST && !$errors) {
			$form_data = array(
				'email' => $data['email'],
				'username' => $data['username'],
				'password' => $data['password']				
			);
			$this->account_model->create_account($form_data);
			redirect('login');
		}

		$this->load->view('template/header');
		$this->load->view('pages/signup', $data);
		$this->load->view('template/footer');
	}

	public function login(){
		$form_inputs = ['email', 'password']; // The inputs that are needed to login

		// Set the input / errors values 
		foreach($form_inputs as $input) {
			if(isset($_POST[$input])) {
				$data[$input] = $_POST[$input]; // Input value
			}elseif(isset($_SESSION[$input])) {
				$data[$input] = $_SESSION[$input]; // Session value
			}

			if($_POST) {
				$data["{$input}_error"] = empty($data[$input]) ? "{$input} is required" : "";
			}else {
				// First time page loaded
				$data["{$input}_error"] = "";
				$data[$input] = "";
			}
		}

		$form_data = array( 
			'email' => $data['email'],
			'password' => $data['password']
		);

		// If the user logged in and the account doesn't exist
		if($_POST && !$this->account_model->account_exists($form_data)) {
			if($this->account_model->email_exists($data['email'])){
				$data['password_error'] = "The password is incorrect";
			}else {
				$data['email_error'] = "The email is not registered";
				$data['password_error'] = "Check if the email or password is correct";
			}
		}

		// Check if there are no errors
		$errors = false;
		foreach ($data as $key => $value) {
			if(!in_array($key, $form_inputs) && !empty($value)) {
				$errors = true;
				break;
			}
		}

		// If the user logged in and there are no errors
		if($_POST && !$errors) {
			$this->set_session($form_data);
			redirect('homepage');
		}

		$this->load->view('template/header');
		$this->load->view('pages/login', $data);
		$this->load->view('template/footer');
	}

	public function homepage(){
		$this->load->view('template/header');
		$this->load->view('template/navigation');
		$this->load->view('pages/homepage');
		$this->load->view('template/footer');
	}

	public function settings(){
		$where = array(
			'email' => $_SESSION['email'],
			'password' => $_SESSION['password']
		);
		$data = $this->account_model->account_data($where);

		$this->load->view('template/header');
		$this->load->view('template/navigation');
		$this->load->view('template/setting_navigation', $data);
		$this->load->view('pages/settings/settings');
		$this->load->view('template/footer');
	}

	public function profile(){
		$where = array(
			'email' => $_SESSION['email'],
			'password' => $_SESSION['password']
		);
		$data = $this->account_model->account_data($where);

		$this->load->view('template/header');
		$this->load->view('template/navigation');
		$this->load->view('template/setting_navigation', $data);
		$this->load->view('pages/settings/profile');
		$this->load->view('template/footer');
	}

	public function delete_account(){
		if(isset($_POST['yes'])) {
			$where = array(
				'email' => $_SESSION['email'],
				'password' => $_SESSION['password']
			);

    		$this->account_model->delete_account($where);
			redirect('login');
		}elseif(isset($_POST['no'])) {
			redirect('settings');
		}

		# Ask if the user wants to delete the account
		$this->load->view('template/header');
		$this->load->view('template/navigation');
		$this->load->view('pages/settings/delete_account');
		$this->load->view('template/footer');
	}
}