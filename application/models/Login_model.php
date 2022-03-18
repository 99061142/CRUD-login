<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{
    // Check if an account was made with the specific data inside the array
    public function check_account($where){
        $this->db->select('id');
        $this->db->from('accounts');
        $this->db->where($where);
        $data = $this->db->get();

        return $data->row() == true;
    }


    // Get the account data of the user to add in in the session
    public function get_account_data($where){
        $this->db->select('email, password, username');
        $this->db->from('accounts');
        $this->db->where($where);
        $data = $this->db->get();

        return $data->row();
    }


    // Add a new account
    public function add_account($new_account_data){
        $this->db->insert('accounts', $new_account_data);
    }

    
    // Change the account data of the user
    public function change_account_data($where, $change_data){
        $this->db->where($where);
        $this->db->update('accounts', $change_data);
    }


    // Delete the account of the user
    public function delete_account_data($where){
        $this->db->where($where);
        $this->db->delete('accounts');
    }
}