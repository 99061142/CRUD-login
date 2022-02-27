<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller{
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function view($page = 'index'){
		if(!file_exists(APPPATH.'views/pages/' .$page . '.php')){
			show_404(); # 404 Page
		}

		$this->load->helper('url'); # Let the navigation bar use the URL inbuild functions

		$this->load->view('template/header'); # Header
		$this->load->view('pages/' . $page); # Page
		$this->load->view('template/footer'); # Footer
	}
}
