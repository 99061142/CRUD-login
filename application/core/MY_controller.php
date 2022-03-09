<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_controller extends CI_Controller{
    // Always loads
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');

		$first_url_parameter = $this->uri->segment('1');
        $acccount_found = false;

        // When the user redirects to an page without logging in
        if(isset($_SESSION['logged_in'])){
            if(isset($_SESSION['email'], $_SESSION['password'])){
                $this->load->model('login_model');
                $acccount_found = $this->login_model->account_information($_SESSION['email'], $_SESSION['password']);
            }
        }

        // If the user did not log in
        if($first_url_parameter != "form_submit" && !$acccount_found){            
            // If the landings page can't be entered without logging in
            if(!$first_url_parameter){
                redirect('login'); // Go to the login form
            }

            // If the user did go to another page without logging in
            else if(!in_array($first_url_parameter, ['signup', 'login'])){
                redirect('login'); // Go to the login form
            }
        }
    }
}