<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once (dirname(__FILE__) . "/account_controller.php");

class Page_controller extends Account_controller{
    public function __construct() {
        parent::__construct();
		$this->load->helper('form');
		$this->load->model('account_model');
    }

	public function signup(){
		$form_inputs = ['email', 'username', 'password'];

		foreach($form_inputs as $input){
			if(isset($_SESSION[$input])){
				$data[$input] = $_SESSION[$input];
			}else{
				$data[$input] = (isset($_POST[$input])) ? $_POST[$input] : "";
			}
		}

		$where = ['email' => $data['email']];
		if($this->account_model->account_exists($where)){
			$data['email_error'] = "Email is already in use";
			$data['email'] = "";
		}else{
			$data['email_error'] = (empty($data['email'])) ? "Email is required" : "";
		}

		$data['username_error'] = (empty($data['username'])) ? "* username is required" : "";
		$data['password_error'] = (empty($data['password'])) ? "* password is required" : "";


		$errors = false;
		foreach ($data as $key => $value) {
			if(!empty($value) && !in_array($key, $form_inputs)){
				$errors = true;
				break;
			}
		}

		if(!$errors){
			$data = array(
				'email' => $data['email'],
				'username' => $data['username'],
				'password' => $data['password']				
			);
			$this->account_model->create_account($data);
			redirect('login');
		}

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
		$where = array(
			'email' => $_SESSION['email'],
			'password' => $_SESSION['password']
		);

		$this->load->model('account_model');
		$data['bio'] = $this->account_model->account_data($where)->bio;
		$data['username'] = $_SESSION['username'];
		$data['email'] = $_SESSION['email'];

		if($account_info == "profile"){
			$this->load->helper('form');
		}

		$this->load->view('template/header');
		$this->load->view('template/navigation');
		$this->load->view('template/account-navigation', $data);
		$this->load->view("pages/settings/{$account_info}");
		$this->load->view('template/footer');	
	}


	// Ask if the user wants to delete the account
	public function delete_account(){
		if(isset($_POST['yes'])) {
    		$this->delete_account_data();
		}elseif(isset($_POST['no'])) {
			$this->account_settings("settings");
		}else {
			# Ask if the user wants to delete the account
			$this->load->view('template/header');
			$this->load->view('template/navigation');
			$this->load->view('pages/settings/ask_account_deletion');
			$this->load->view('template/footer');
		}
	}


}