<?php 
//
defined('BASEPATH') OR exit('No direct script access allowed');

class ExtrasController extends CI_Controller{


	public function __construct(){


		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('extras/ExtrasModel');

	}

	public function add_new(){

		$this->load->view("header");
		$this->load->view("extras/extras_add");
		$this->load->view("footer");

	}



	/*****************Extras Insert Start*****************/



	public function add(){

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
        $extras_category=$this->input->post('extras_category');
		$extra_name=$this->input->post('extra_name');
		$currency_mode=$this->input->post('currency_mode');
		$unit_price=$this->input->post('unit_price');

		$insert_data=array(
            'extra_category'=>$extras_category, 
			'extra_name'=>$extra_name,
			'currency' =>$currency_mode,
			'unit_price' =>$unit_price

		);


		$tbl_name='extras';

		$this->load->model('General_Model');
		$result=$this->General_Model->insert($tbl_name,$insert_data);

		if(!empty($result)){

			$this->session->set_flashdata('success', "Record Inserted Successfully !!"); 
			redirect("extras/ExtrasController/add_new");

		}
		else{

			$this->session->set_flashdata('error',"Sorry,Record Inserted failed.");
			redirect("extras/ExtrasController/add_new");
		}

	}


	/*****************Extras Insert End*****************/


	/*****************All Extras List Start*****************/


	public function showExtrasList(){

		$data['fields']=$this->ExtrasModel->getListData();

		$this->load->view("header");
		$this->load->view("extras/extras_list",$data);
		$this->load->view("footer");

	}



	/*****************All Extras List End*****************/


	/*****************Extras Edit Start*****************/


	public function editExtras(){

		$id=$_REQUEST['id'];

		$data['fields']=$this->ExtrasModel->getItemData($id);
		$this->load->view("header");
		$this->load->view('extras/extras_edit',$data);
		$this->load->view("footer");

	}



	/*****************Extra Edit End*****************/


	/*****************Extras Edit Start*****************/


	public function updateExtras(){

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		$updateID=$this->input->post("id");
		
        $extras_category=$this->input->post('extras_category');
		$extra_name=$this->input->post('extra_name');
		$currency_mode=$this->input->post('currency_mode');
		$unit_price=$this->input->post('unit_price');

		$updateData=array(
            'extra_category'=>$extras_category,    
			'extra_name'=>$extra_name,
			'currency' =>$currency_mode,
			'unit_price' =>$unit_price

		);


		$tbl_name='extras';

        $this->load->Model('General_Model');
        $result=$this->General_Model->update($updateData,$updateID,$tbl_name);

		if(!empty($result)){

			$this->session->set_flashdata('success', "Record Update Successfully !!"); 
			redirect("extras/ExtrasController/showExtrasList");

		}
		else{

			$this->session->set_flashdata('error',"Sorry,Record Update failed.");
			redirect("extras/ExtrasController/showExtrasList");
		}

		

	}



	/*****************Extra Edit End*****************/



	public function deleteExtras(){
	    
	    $deleteID=$_REQUEST['id'];

		$result=$this->ExtrasModel->delete($deleteID);

		if(!empty($result)){

			$this->session->set_flashdata('success', "Record Delete Successfully !!"); 
			redirect('extras/ExtrasController/showExtrasList');

		}
		else{

			$this->session->set_flashdata('error',"Sorry,Record Delete failed.");
			redirect('extras/ExtrasController/showExtrasList');
		}
	    

	}




}