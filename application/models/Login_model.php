<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{
    // If the user signed up
    public function add_account(){

    }


    // If the user logged in
    public function account_information($email, $password){    
        $this->db->select('id, email, password');
        $this->db->from('accounts');
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $data = $this->db->get();

        return $data->result_array()[0];
    }
}