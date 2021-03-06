<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class talent_invited_view extends CI_Controller {

public function __construct()
	{
	
			parent::__construct();
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->helper('cookie');
			$this->load->library('form_validation');
			$this->load->library('form_validation', 'session');
			$this->load->model('get_my_invited_event_model');
			$this->form_validation->set_error_delimiters('', ''); 
			
	
	}
	public function index()
	{
		
		$myuser_id = $this->session->userdata('talent_id'); 
		if($myuser_id == ''){
			$myuser_id = $this->input->cookie('talent',true);
		}
		if($myuser_id!="") {
			$invited_event_list['get_total_rows'] =$this->gettotalrows($myuser_id);
			$invited_event_list['items_per_group']='5';	
			$invited_event_list['myuser_id']=$myuser_id;	
			$this->load->view('talent_invited_view',$invited_event_list);
		}
		else {
			redirect('login');
		}
	}
	
	function gettotalrows($myuser_id){
		
		    $this->db->select('*');
			$this->db->where('talent_id',$myuser_id);
			$this->db->where('status','0');
			$this->db->from('invite_talent_to_event');	
			$query = $this->db->get(); 
			return $query->num_rows() ;
	}
	
	function getblogdata()
	{   
		 if($_POST) 
			{ 
			    $items_per_group='5';	
				//$group_number = $_POST["group_no"];
			     $group_number = filter_var($_POST["group_no"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
				
				//throw HTTP error if group number is not valid
				//if(!is_numeric($group_number)){
				//	header('HTTP/1.1 500 Invalid number!');
				//	exit();
				//}
				
				//get current starting point of records
				$position = ($group_number * $items_per_group);
				
				$myuser_id = $this->session->userdata('talent_id');
				if($myuser_id == ''){
					$myuser_id = $this->input->cookie('talent',true);
				}
				$this->db->select('*');	
				$this->db->where('talent_id',$myuser_id);
				$this->db->where('status','0');
				$this->db->from('invite_talent_to_event');	
				$query = $this->db->get();			
				$result = $query->result_array();  
				
				$query=$this->db->query("SELECT * from invite_talent_to_event WHERE status = 0 AND talent_id = ".$myuser_id." ORDER BY invite_id DESC LIMIT $position, $items_per_group");			
				$data['invited_events'] = $result = $query->result_array();
				$data['invited_events'] = $this->event_model->event_details($result);
				//$data['invited_events'] = $this->client_model->client_details($result);
				//print"<pre>";
				//print_r($data['invited_events']);
				$this->load->view('invited_event_list_view',$data);
				
			}
	}
	
}
