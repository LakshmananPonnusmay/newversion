<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class talent_logout extends CI_Controller {

public function __construct()
	{
	
			parent::__construct();
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->helper('cookie');
			$this->load->library('form_validation');
			
	}
	public function index()
	{
		$myuser_id = $this->session->userdata('talent_id'); 
		$talent_id = $myuser_id;
		$this->session->unset_userdata($talent_id);
		$this->session->sess_destroy();
		delete_cookie('talent');
		$this->load->view('login');
	}
	
}
