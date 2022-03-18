<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model{
    // Check if an account exists
    public function exists_account($where){
        $this->db->select('id');
        $this->db->from('accounts');
        $this->db->where($where);
        $data = $this->db->get();

        return $data->row() == true;
    }


    // Get specific data of the account to add in the session
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

    
    // Change the data of the account
    public function change_account_data($where, $change_data){
        $this->db->where($where);
        $this->db->update('accounts', $change_data);
    }


    // Delete the account
    public function delete_account_data($where){
        $this->db->where($where);
        $this->db->delete('accounts');
    }
}