<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_controller extends MY_controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('account_model');
	}

	public function set_session($form_data){
		$account_data = $this->account_model->account_data($form_data);

		$this->session->userdata = array(
			'email' => $account_data->email,
			'username' => $account_data->username,
			'password' => $account_data->password,
		   	'logged_in' => TRUE
		);
	}

	public function update_account(){
		$where = array(
			'email' => $_SESSION['email'],
			'password' => $_SESSION['password']
		);
		$this->account_model->update_account($where, $_POST);
		redirect('profile');
	}
}