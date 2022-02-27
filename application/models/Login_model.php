<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }


    public function check_login(){
        print("check login");
    }


    // If the user tried to sign up
    public function signup(){
        print("signup");
    }

    // If the user tried to log in
    public function login(){
        $this->check_login();
    }
}