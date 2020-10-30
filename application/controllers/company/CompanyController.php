<?php
//
defined('BASEPATH') OR exit('No direct script access allowed');

class CompanyController extends CI_Controller {


public function __construct(){

	parent::__construct();
	$this->load->helper('form');
	$this->load->library('form_validation');
	$this->load->model('company/CompanyModel');


}


public function add_new(){


	$this->load->view("header");
	$this->load->view("company/company_profile");
	$this->load->view("footer");


}

/* Add Company Profile Start */

public function add(){

		$name=$this->input->post('name');
		$company_name=$this->input->post('company_name');
		$rut=$this->input->post('rut');
		$country=$this->input->post('country');
		$town=$this->input->post('town');
		$postal_code=$this->input->post('postal_code');
		$telephone=$this->input->post('telephone');
		$contact_in_company=$this->input->post('contact_in_company');

		$contact_name=$this->input->post('contact_name');
		$contact_rank=$this->input->post('contact_rank');
		$contact_email=$this->input->post('contact_email');

		$contact_telephone=$this->input->post('contact_telephone');
		$c_name=null;$c_rank=null;$c_email=null;$c_telephone=null;



		for($i=0;$i<count($contact_name);$i++) {
			$c_name.=$contact_name[$i].",";
			$c_rank.=$contact_rank[$i].",";
			$c_email.=$contact_email[$i].",";
			$c_telephone.=$contact_telephone[$i].",";
			# code...
		}

		$c_name=rtrim($c_name,",");
		$c_rank=rtrim($c_rank,",");
		$c_email=rtrim($c_email,",");
		$c_telephone=rtrim($c_telephone,",");

		$c_name=explode(",",$c_name);
		$c_rank=explode(",",$c_rank);
		$c_email=explode(",",$c_email);
		$c_telephone=explode(",",$c_telephone);

		$c_name=json_encode($c_name);
		$c_rank=json_encode($c_rank);
		$c_email=json_encode($c_email);
		$c_telephone=json_encode($c_telephone);


		$contact_telephone=$this->input->post('contact_telephone');

		$insert_data=array(

			'name'=>$name,
			'company_name' =>$company_name,
			'rut'=>$rut,
			'country'=>$country,
			'town'=>$town,
			'postal_code'=>$postal_code,
			'telephone'=>$telephone,
			'contact_in_company'=>$contact_in_company,
			'contact_name'=>$c_name,
			'Rank'=>$c_rank,
			'email'=>$c_email,
			'contact_telephone'=>$c_telephone

		);


        $tbl_name='company';

		$this->load->model('General_Model');
		$result=$this->General_Model->insert($tbl_name,$insert_data);

		if(!empty($result)){

			$this->session->set_flashdata('success', "Record Inserted Successfully !!");
			redirect("company/CompanyController/add_new");

		}
		else{

			$this->session->set_flashdata('error',"Sorry,Record Inserted failed.");
			redirect("company/CompanyController/add_new");
		}

	}

/* Add Company Profile End  */



/* Edit Company Profile   */


	public function editCompany(){

		$id=$_REQUEST['id'];

		$data['fields']=$this->CompanyModel->getItemData($id);

        $this->load->view("header");
		$this->load->view('company/company_edit',$data);
		$this->load->view("footer");


	}

/*End Company List*/



/* End Get Company List 	*/
public function showCompanyList(){

	$data['fields']=$this->CompanyModel->getListData();

	$this->load->view("header");
	$this->load->view("company/company_list",$data);
	$this->load->view("footer");


}

/*  End Get Company List  */


/*Start Update Company */

	public function updateCompany(){

		$updateID=$this->input->post('id');

		$name=$this->input->post('name');
		$company_name=$this->input->post('company_name');
		$rut=$this->input->post('rut');
		$country=$this->input->post('country');
		$town=$this->input->post('town');
		$postal_code=$this->input->post('postal_code');
		$telephone=$this->input->post('telephone');
		$contact_in_company=$this->input->post('contact_in_company');
		$contact_name=$this->input->post('contact_name');
		$contact_rank=$this->input->post('contact_rank');
		$contact_email=$this->input->post('contact_email');

		$contact_telephone=$this->input->post('contact_telephone');
		$c_name=null;$c_rank=null;$c_email=null;$c_telephone=null;


	for($i=0;$i<count($contact_name);$i++) {
			$c_name.=$contact_name[$i].",";
			$c_rank.=$contact_rank[$i].",";
			$c_email.=$contact_email[$i].",";
			$c_telephone.=$contact_telephone[$i].",";
			# code...
		}

		$c_name=rtrim($c_name,",");
		$c_rank=rtrim($c_rank,",");
		$c_email=rtrim($c_email,",");
		$c_telephone=rtrim($c_telephone,",");

		$c_name=explode(",",$c_name);
		$c_rank=explode(",",$c_rank);
		$c_email=explode(",",$c_email);
		$c_telephone=explode(",",$c_telephone);

		$c_name=json_encode($c_name);
		$c_rank=json_encode($c_rank);
		$c_email=json_encode($c_email);
		$c_telephone=json_encode($c_telephone);






		$contact_telephone=$this->input->post('contact_telephone');

		$updateData=array(
			'name'=>$name,
			'company_name' =>$company_name,
			'rut'=>$rut,
			'country'=>$country,
			'town'=>$town,
			'postal_code'=>$postal_code,
			'telephone'=>$telephone,
			'contact_in_company'=>$contact_in_company,
			'contact_name'=>$c_name,
			'Rank'=>$c_rank,
			'email'=>$c_email,
			'contact_telephone'=>$c_telephone

		);


        $tbl_name='company';

		$this->load->model('General_Model');
		$result=$this->General_Model->update($updateData,$updateID,$tbl_name);

		if(!empty($result)){

			$this->session->set_flashdata('success', "Record Update Successfully !!");
			redirect('company/CompanyController/showCompanyList');

		}
		else{

			$this->session->set_flashdata('error',"Sorry,Record Update failed.");
			redirect('company/CompanyController/editCompany');
		}



	}

/*End Update Company  */


/*Start Delete Company*/

	public function deleteCompany(){

		$deleteID=$_REQUEST['id'];

		$result=$this->CompanyModel->delete($deleteID);

		if(!empty($result)){

			$this->session->set_flashdata('success', "Record Delete Successfully !!");
			redirect('company/CompanyController/showCompanyList');

		}
		else{

			$this->session->set_flashdata('error',"Sorry,Record Delete failed.");
			redirect('company/CompanyController/showCompanyList');
		}



	}


/*End Delete Company*/




}
