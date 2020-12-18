<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MaintenanceController extends CI_Controller {

	var $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('rooms/RoomsModel');
		// $this->load->model('hotl/ItemModel');
	}

	public function index(){
		$this->load->view('header');
		$this->load->view('maintenance/view_task');
		$this->load->view('footer');
	}
	public function view_task(){
		// $this->load->view('header');
		$this->load->view('maintenance/view_task');
		// $this->load->view('footer');
	}
	public function save_task(){
		$id = $this->input->post('id');
		$hotel_id = $this->session->userdata['hotel_id'];
		$this->form_validation->set_rules('task_to_do','Task  To Do ','required');
		 if($this->form_validation->run() == FALSE){  
				$this->error="\n Required fields are missing!";
				$this->error.=" \n field Task to Do is missing!";
				$this->session->set_flashdata('errors', $this->error);
            redirect(base_url() . 'maintenance/MaintenanceController/add_task');
			return false;
       } else{
		   $room_id = $this->input->post('room');
		   $room_status = $this->input->post('status');
		    $params = array(
				'room_no' => $room_id,
				'status' => $this->input->post('status'),
				'hotel_id' => $hotel_id,
				'task' => $this->input->post('task_to_do'));
				
			if($id>0){
				 $this->db->where('id',$id);
				$record=$this->db->update('maintenance',$params);
			} else{
				$this->db->insert('maintenance',$params);
				$record = $this->db->insert_id();
			}
			if($room_status == 0){
				$params = array(
					'room_condition' => 4
				);
			} else{
				$params = array(
				'room_condition' => 1
				);
			}
			
			$this->db->where('id',$room_id);
			$record2 =$this->db->update('rooms',$params);
			redirect(base_url() . 'maintenance/MaintenanceController/view_task');
			// $this->load->view('header');
			// $this->load->view('hotels/view_hotel');
			// $this->load->view('footer');
	   }
	}
	
	public function add_task($id = 0){
		if(isset($_REQUEST['id'])){
			$id = $_REQUEST['id'];
		} 
		// echo"<pre>";
		// print_r($id);
		// exit;
		$data =array();
		if(!empty($id)){
			$this->db->select('*');
			$this->db->from('maintenance');
			$this->db->where('id',$id);
			$data['fields']=$this->db->get()->result_array()[0];
		}
		$hotel_id = $this->session->userdata['hotel_id'];
		$data['rooms']=$this->RoomsModel->getListDatatwo($hotel_id);
		// echo"<pre>";
		// print_r($data['fields']);
		// exit;
		$this->load->view('header');
		$this->load->view('maintenance/add_task',$data);
		$this->load->view('footer');
	}
	public function delete(){
		// echo"<pre>";
		// print_r($_REQUEST['room_id']);
		// exit;
		if(isset($_REQUEST['id'])){
			$id = $_REQUEST['id'];
		}
		if(isset($_REQUEST['room_id'])){
			$room_id = $_REQUEST['room_id'];
		} 
		if(empty($id)) return false;
		if($this->db->delete('maintenance',array('id'=>$id))){
			if(!empty($room_id)){
				$params = array(
					'room_condition' => 1
				);
				$this->db->where('id',$room_id);
				$record2 =$this->db->update('rooms',$params);
			}
			redirect(base_url() . '/maintenance/MaintenanceController/view_task');
		}
	}
}
?>
