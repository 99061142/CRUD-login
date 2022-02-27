<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller{
	public function form_signup(){
		$this->load->model('login_model');
		$this->login_model->signup();
	}

	public function form_login(){
		$this->load->model('login_model');
		$this->login_model->login();
	}
}