<?php defined('BASEPATH') OR exit('No direct script access allowed');

class RoomsController extends CI_Controller{


	public function __construct(){


		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('rooms/RoomsModel');

	}

	public function add_new(){

		$this->load->view("header");
		$this->load->view("rooms/add_room");
		$this->load->view("footer");

	}



	/*****************Rooms Insert Start*****************/



	public function add(){

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
        $room_number=$this->input->post('room_number');
		$room_type=$this->input->post('room_type');
		$single_size=$this->input->post('single_size');
		$double_size=$this->input->post('double_size');
		$king_size=$this->input->post('king_size');
		$queen_size=$this->input->post('queen_size');
		$room_condition=$this->input->post('room_condition');
		$room_status=$this->input->post('room_status');
		$hotel_id = $this->session->userdata['hotel_id'];
		$insert_data=array(
            'room_number'=>$room_number, 
			'room_type'=>$room_type,
			'single_size' =>$single_size,
			'double_size' =>$double_size,
			'king_size' =>$king_size,
			'queen_size' =>$queen_size,
			'room_condition' =>$room_condition,
			'room_status' =>$room_status,
			'hotel_id' =>$hotel_id
		);


		$tbl_name='rooms';

		$this->load->model('General_Model');
		$result=$this->General_Model->insert($tbl_name,$insert_data);

		if(!empty($result)){

			$this->session->set_flashdata('success', "Record Inserted Successfully !!"); 
			redirect("room/RoomsController/showRoomsList");

		}
		else{

			$this->session->set_flashdata('error',"Sorry,Record Inserted failed.");
			redirect("room/RoomsController/add_new");
		}

	}


	/*****************Rooms Insert End*****************/


	/*****************All Rooms List Start*****************/


	public function showRoomsList(){
		$hotel_id = $this->session->userdata['hotel_id'];
		$data['fields']=$this->RoomsModel->getListData($hotel_id);

		$this->load->view("header");
		$this->load->view("rooms/rooms_list",$data);
		$this->load->view("footer");

	}



	/*****************All Rooms List End*****************/


	/*****************Rooms Edit Start*****************/


	public function editRooms(){

		$id=$_REQUEST['id'];

		$data['fields']=$this->RoomsModel->getItemData($id);
		$this->load->view("header");
		$this->load->view('rooms/edit_room',$data);
		$this->load->view("footer");

	}



	/*****************Rooms Edit End*****************/


	/*****************Rooms Edit Start*****************/


	public function updateRooms(){

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		$updateID=$this->input->post("id");
		
        $room_number=$this->input->post('room_number');
		$room_type=$this->input->post('room_type');
		$single_size=$this->input->post('single_size');
		$double_size=$this->input->post('double_size');
		$king_size=$this->input->post('king_size');
		$queen_size=$this->input->post('queen_size');
		$room_condition=$this->input->post('room_condition');
		$room_status=$this->input->post('room_status');
		$hotel_id = $this->session->userdata['hotel_id'];
		$updateData=array(
            'room_number'=>$room_number, 
			'room_type'=>$room_type,
			'single_size' =>$single_size,
			'double_size' =>$double_size,
			'king_size' =>$king_size,
			'queen_size' =>$queen_size,
			'room_condition' =>$room_condition,
			'room_status' =>$room_status,
			'hotel_id' =>$hotel_id

		);


		$tbl_name='rooms';

        $this->load->Model('General_Model');
        $result=$this->General_Model->update($updateData,$updateID,$tbl_name);

		if(!empty($result)){

			$this->session->set_flashdata('success', "Record Update Successfully !!"); 
			redirect("room/RoomsController/showRoomsList");

		}
		else{

			$this->session->set_flashdata('error',"Sorry,Record Update failed.");
			redirect("room/RoomsController/showRoomsList");
		}

		

	}



	/*****************Rooms Edit End*****************/



	public function deleteRooms(){
	    
	    $deleteID=$_REQUEST['id'];

		$result=$this->RoomsModel->delete($deleteID);

		if(!empty($result)){

			$this->session->set_flashdata('success', "Record Delete Successfully !!"); 
			redirect('room/RoomsController/showRoomsList');

		}
		else{

			$this->session->set_flashdata('error',"Sorry,Record Delete failed.");
			redirect('room/RoomsController/showRoomsList');
		}
	    

	}
	
	
function check_dupilcate_room_no()
	{
		if(empty($_REQUEST['room_nmber'])) return false;
		$hotel_id = $this->session->userdata['hotel_id'];
		echo $this->RoomsModel->checkDupilcateRoomNo($_REQUEST['room_nmber'],$hotel_id);
		//echo $this->ItemModel->checkDupilcateRoomNo($_REQUEST['room_no']);
	}




}
