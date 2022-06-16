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
        $this->db->select('*');
        $this->db->from('accounts');
        $this->db->where($where);
        return $this->db->get()->row();
    }

    public function create_account($data){
        $this->db->insert('accounts', $data);
    }

    public function update_account($previous_data, $new_data){
        $this->db->where($previous_data);
        $this->db->update('accounts', $new_data);
    }

    public function delete_account($where){
        $this->db->where($where);
        $this->db->delete('accounts');
    }
}