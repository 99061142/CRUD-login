<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_controller extends CI_Controller{
    // Always loads
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');

		$first_url_parameter = $this->uri->segment('1'); // URL route
        $acccount_found = false; // If the account could be found

        // If the session says the user logged in
        if(isset($_SESSION['logged_in'])){
            // If the email and password are stored in the session
            if(isset($_SESSION['email'], $_SESSION['password'])){
                // Check if the account can be found
                $this->load->model('login_model');
                $acccount_found = $this->login_model->account_information($_SESSION['email'], $_SESSION['password']);
            }
        }

        // If the user did not log in
        if(!$acccount_found){  
            // If the user did go to another page without logging in except the login / signup page
            if(!strstr($first_url_parameter, "login") && !strstr($first_url_parameter, "signup")){
                redirect('login'); // Go to the login form
            }
        }
    }
}