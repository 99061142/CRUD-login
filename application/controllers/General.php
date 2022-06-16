<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends MY_controller{
    public function logout(){
        session_destroy(); // Delete everything inside the session
        redirect('login'); // Go to the login form
    }
}