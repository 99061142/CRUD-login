<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{
    // Automatically load the database
    public function __construct(){
        $this->load->database();
    }


    // Check if the session id belongs to an account
    public function confirm_session_id($id){        
        $sql = "SELECT `id` FROM `accounts` WHERE `id` = ?";
        $data = $this->db->query($sql, $id);

        return $data->row()->id; // Returns the ID that belongs to the account of the user
    }


    // If the user signed up
    public function signup(){
        print("signup");
    }


    // If the user logged in
    public function confirm_login($email, $password){
        $sql = "SELECT `id` FROM `accounts` WHERE `email` = ? AND `password` = ?";
        $data = $this->db->query($sql, array($email, $password));

        // If the id can be found
        if($data->row()){
            return $data->row()->id; // Returns the ID that belongs to the account of the user
        }
    }
}