<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model{
    public function account_exists($where){
        $this->db->where($where);
        $query = $this->db->get('accounts');
        return $query->num_rows() > 0;
    }

    public function email_exists($email){
        $this->db->where('email', $email);
        $query = $this->db->get('accounts');
        return $query->num_rows() > 0;
    }


    public function account_data($where){
        $this->db->where($where);
        $this->db->select('email, password, username, bio');
        $this->db->from('accounts');
        $this->db->where($where);
        return $this->db->get()->row();
    }

    /*
    // Get specific data of the account to add in the session
    public function get_account_data($where){
        $this->db->select('email, password, username');
        $this->db->from('accounts');
        $this->db->where($where);
        $data = $this->db->get();

        return $data->row();
    }
    */


    // Add a new account
    public function create_account($data){
        $this->db->insert('accounts', $data);
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