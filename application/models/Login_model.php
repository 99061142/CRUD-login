<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{
    // Check if the mail is already used, and return true if so
    public function mail_aready_used($email){
        $this->db->select('email');
        $this->db->from('accounts');
        $this->db->where('email', $email);
        $data = $this->db->get();

        return $data->row()->email == true;
    }


    // Add an new account with the signup information the user has given
    public function add_account($email, $password, $salt=''){
        $data = [
            'email' => $email,
            'password' => $password,
            'salt' => $salt,
        ];

        $this->db->insert('accounts', $data);
    }


    // Get the account data if the user logged in
    public function account_information($email, $password){    
        $this->db->select('email, password, username');
        $this->db->from('accounts');
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $data = $this->db->get();

        return $data->row();
    }
}