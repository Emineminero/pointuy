<?php defined('BASEPATH') OR exit('No direct script access allowed');

class RatesController extends CI_Controller{


	public function __construct(){


		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('rates/RatesModel');

	}


	public function add_new(){
		$hotel_id = $this->session->userdata['hotel_id'];
		$data['company']=$this->RatesModel->getCompanyList($hotel_id);
		$data['rooms']=$this->RatesModel->getRoomList($hotel_id);
		  // echo"<pre>";
		  // print_r($data);
		  // exit;
		$this->load->view("header");
		$this->load->view("rates/add_rate",$data);
		$this->load->view("footer");

	}



	/*****************Rates Insert Start*****************/



	public function add(){

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
        $companies=$this->input->post('companies');
		$rooms=$this->input->post('rooms');
		$currency_mode=$this->input->post('currency_mode');
		$room_price=$this->input->post('room_price');
		$hotel_id = $this->session->userdata['hotel_id'];

		$insert_data=array(
            'companies'=>$companies, 
			'rooms'=>$rooms,
			'currency_mode' =>$currency_mode,
			'room_price' =>$room_price,
			'hotel_id' =>$hotel_id
		);


		$tbl_name='rates';

		$this->load->model('General_Model');
		$result=$this->General_Model->insert($tbl_name,$insert_data);

		if(!empty($result)){

			$this->session->set_flashdata('success', "Record Inserted Successfully !!"); 
			redirect("rate/RatesController/showRatesList");

		}
		else{

			$this->session->set_flashdata('error',"Sorry,Record Inserted failed.");
			redirect("rate/RatesController/showRatesList");
		}

	}


	/*****************Rates Insert End*****************/


	/*****************All Rates List Start*****************/


	public function showRatesList(){
		$hotel_id = $this->session->userdata['hotel_id'];
		$data['fields']=$this->RatesModel->getListData($hotel_id);

		$this->load->view("header");
		$this->load->view("rates/rates_list",$data);
		$this->load->view("footer");

	}



	/*****************All Rates List End*****************/


	/*****************Rates Edit Start*****************/


	public function editRates(){

		$id=$_REQUEST['id'];
		$hotel_id = $this->session->userdata['hotel_id'];
		$data['company']=$this->RatesModel->getCompanyList($hotel_id);
		$data['rooms']=$this->RatesModel->getRoomList($hotel_id);
		
		$data['fields']=$this->RatesModel->getItemData($id);
		$this->load->view("header");
		$this->load->view('rates/edit_rate',$data);
		$this->load->view("footer");

	}



	/*****************Rates Edit End*****************/


	/*****************Rates Edit Start*****************/


	public function updateRates(){

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		$updateID=$this->input->post("id");
		
       	$companies=$this->input->post('companies');
		$rooms=$this->input->post('rooms');
		$currency_mode=$this->input->post('currency_mode');
		$room_price=$this->input->post('room_price');
		$hotel_id = $this->session->userdata['hotel_id'];

		$updateData=array(
            'companies'=>$companies, 
			'rooms'=>$rooms,
			'currency_mode' =>$currency_mode,
			'room_price' =>$room_price,
			'hotel_id' =>$hotel_id
		);


		$tbl_name='rates';

        $this->load->Model('General_Model');
        $result=$this->General_Model->update($updateData,$updateID,$tbl_name);

		if(!empty($result))
		{
			$this->session->set_flashdata('success', "Record Update Successfully !!"); 
			redirect("rate/RatesController/showRatesList");
		}
		else
		{
			$this->session->set_flashdata('error',"Sorry,Record Update failed.");
			redirect("rate/RatesController/showRatesList");
		}

		

	}



	/*****************Rates Edit End*****************/



	public function deleteRates(){
	    
	    $deleteID=$_REQUEST['id'];

		$result=$this->RatesModel->delete($deleteID);

		if(!empty($result)){

			$this->session->set_flashdata('success', "Record Delete Successfully !!"); 
			redirect("rate/RatesController/showRatesList");

		}
		else{

			$this->session->set_flashdata('error',"Sorry,Record Delete failed.");
			redirect("rate/RatesController/showRatesList");
		}
	    
	    





	}




}
