<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class agent_dashboard extends CI_Controller {

public function __construct()
	{
	
			parent::__construct();
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->helper('cookie');
			$this->load->library('form_validation');
			$this->load->model('agent_model');
	
	}
	public function index()
	{
		$agentid = $this->uri->segment(2); 
		$userdata = array(
            'agent_id'  => $agentid,
        );
		$this->session->set_userdata($userdata);
		$myuser_id = $this->session->userdata('agent_id');
		
		$cookie= array(
			'name'   => 'agent',
			'value'  => $myuser_id,
			'expire' => '86500'
		);
		$this->input->set_cookie($cookie);
		
		$data['event_details'] = $this->agent_model->checkin_details($myuser_id); 
		$data['profit'] = $this->agent_model->profit_details($myuser_id); 
		$data['revenue'] = $this->agent_model->revenue_details($myuser_id); 
		$this->load->view('agent_dashboard',$data);
	}
	
}
