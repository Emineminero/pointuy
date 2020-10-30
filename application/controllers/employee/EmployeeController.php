<?php

//

defined('BASEPATH') OR exit('No direct script access allowed');



class EmployeeController extends CI_Controller {



	public function __construct(){



		parent::__construct();

		$this->load->helper('form');

		$this->load->library('form_validation');

		$this->load->model('employee/EmployeeModel');





	}





	public function add_new(){



		$this->load->view('header');

		$this->load->view("employee/employe_profile");

		$this->load->view("footer");



	}



/*****************Employee Profile insert Start*****************/



	public function add(){



		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');



		$profile_pic=$this->do_uploads('profile_pic');

		$full_name=$this->input->post('full_name');

		$sex=$this->input->post('sex');

		$dob=$this->input->post('dob');

		$id_nos=$this->input->post('id_nos');

		$telephone_1=$this->input->post('telephone_1');

		$telephone_2=$this->input->post('telephone_2');

		$med_covrg=$this->input->post('med_covrg');

		$emp_email=$this->input->post('emp_email');

		$physical_address=$this->input->post('physical_address');

		$doc_type=$this->input->post('doc_type');

		$expire_date=$this->input->post('expire_date');

		$doc_pic=$this->do_uploads('doc_pic');

		$doc_type_2=$this->input->post('doc_type_2');

		$expire_date2=$this->input->post('expire_date2');

		$doc_pic2=$this->do_uploads('doc_pic2');

		$doc_type3=$this->input->post('doc_type_3');

		$expire_date3=$this->input->post('expire_date3');

		$doc_pic3=$this->do_uploads('doc_pic3');







		$document_type=array(

								'doc_type' =>$doc_type,

								'doc_type2'=>$doc_type_2,

								'doc_type3'=>$doc_type3



							);

		$doc_expiredate=array(

								'expire_date' =>$expire_date,

								'expire_date2'=>$expire_date2,

								'expire_date3'=>$expire_date3



							);

		$document_name=array(

								'doc_type' =>$doc_pic,

								'doc_type2'=>$doc_pic2,

								'doc_type3'=>$doc_pic3



							);

		$document_type=json_encode($document_type);

		$doc_expiredate=json_encode($doc_expiredate);

		$document_name=json_encode($document_name);



		/*print_r($document_name);

		exit();*/





		$insert_data=array(



			'profile_pic'=>$profile_pic,

			'full_name' =>$full_name,

			'sex'=>$sex,

			'dob'=>$dob,

			'id_no'=>$id_nos,

			'telephone_no'=>$telephone_1,

			'telephone_no2'=>$telephone_2,

			'medical_coverage'=>$med_covrg,

			'mail'=>$emp_email,

			'physical_address'=>$physical_address,

			'document_type'=>$document_type,

			'document_expiration'=>$doc_expiredate,

			'document_name'=>$document_name



		);



        $tbl_name='employee';



		$this->load->model('General_Model');

		$result=$this->General_Model->insert($tbl_name,$insert_data);



		if(!empty($result)){



			$this->session->set_flashdata('success', "Record Inserted Successfully !!"); 

			redirect("employee/EmployeeController/add_new");



		}

		else{



			$this->session->set_flashdata('error',"Sorry,Record Inserted failed.");

			redirect("employee/EmployeeController/add_new");

		}



	}



/*****************Employee Profile Insert End*****************/





/* End Get Employee List 	*/





public function showEmployeeList(){



	$this->load->model('employee/EmployeeModel');



	$data['fields']=$this->EmployeeModel->getListData();



	$this->load->view("header");

	$this->load->view("employee/employee_list",$data);

	$this->load->view("footer");





}





/*  End Get Employee List  */







/*Start Edit Employe   */





	public function editEmploye(){



		$id = $_REQUEST['id'];





		$data['fields']=$this->EmployeeModel->getItemData($id);

		$this->load->view("header");

		$this->load->view('employee/employe_edit',$data);

		$this->load->view("footer");





	}



/*End Edit Employe    */









/*Start Delete Employee*/



	public function deleteEmploye(){



		$deleteID=$_REQUEST['id'];



		$result=$this->EmployeeModel->delete($deleteID);



		if(!empty($result)){



			$this->session->set_flashdata('success', "Record Delete Successfully !!"); 

			redirect('employee/EmployeeController/showEmployeeList');



		}

		else{



			$this->session->set_flashdata('error',"Sorry,Record Delete failed.");

			redirect('employee/EmployeeController/showEmployeeList');

		}







	}





/*End Delete Employee*/



public function updateEmployee(){





		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');



		$updateID = $this->input->post('id');

		$oldfile = $this->input->post('old_profile');

    	$file = $_FILES['profile_pic']['name'];





    	if($file!="") {

      		$profile_pic=$this->do_uploads('profile_pic');

    		} 

    	else {

    			$profile_pic = $oldfile;

    		}



		

		$full_name=$this->input->post('full_name');

		$sex=$this->input->post('sex');

		$dob=$this->input->post('dob');

		$id_nos=$this->input->post('id_nos');

		$telephone_1=$this->input->post('telephone_1');

		$telephone_2=$this->input->post('telephone_2');

		$med_covrg=$this->input->post('med_covrg');

		$emp_email=$this->input->post('emp_email');

		$physical_address=$this->input->post('physical_address');

		$doc_type=$this->input->post('doc_type');

		$expire_date=$this->input->post('expire_date');



		$old_doc1=$this->input->post('old_doc1');

		$file1 = $_FILES['doc_pic']['name'];





    	if($file1!=""){

      		$doc_pic=$this->do_uploads('doc_pic');

    		} 

    	else {

    			$doc_pic = $old_doc1;

    		}



		$doc_type_2=$this->input->post('doc_type_2');

		$expire_date2=$this->input->post('expire_date2');



		$old_doc2=$this->input->post('old_doc2');

		$file2 = $_FILES['doc_pic2']['name'];





    	if($file2!="") {

      		$doc_pic2=$this->do_uploads('doc_pic2');

    		} 

    	else {

    			$doc_pic2 = $old_doc2;

    		}







		$doc_type3=$this->input->post('doc_type_3');

		$expire_date3=$this->input->post('expire_date3');



			$old_doc3=$this->input->post('old_doc2');

		$file3 = $_FILES['doc_pic3']['name'];





    	if($file3!="") {

      		$doc_pic3=$this->do_uploads('doc_pic3');

    		} 

    	else {

    			$doc_pic3 = $old_doc3;

    		}







		$document_type=array(

								'doc_type' =>$doc_type,

								'doc_type2'=>$doc_type_2,

								'doc_type3'=>$doc_type3



							);

		$doc_expiredate=array(

								'expire_date' =>$expire_date,

								'expire_date2'=>$expire_date2,

								'expire_date3'=>$expire_date3



							);

		$document_name=array(

								'doc_type' =>$doc_pic,

								'doc_type2'=>$doc_pic2,

								'doc_type3'=>$doc_pic3



							);

		$document_type=json_encode($document_type);

		$doc_expiredate=json_encode($doc_expiredate);

		$document_name=json_encode($document_name);

		



	/*	print_r($document_name);

		exit();*/





		$updateData=array(



			'profile_pic'=>$profile_pic,

			'full_name' =>$full_name,

			'sex'=>$sex,

			'dob'=>$dob,

			'id_no'=>$id_nos,

			'telephone_no'=>$telephone_1,

			'telephone_no2'=>$telephone_2,

			'medical_coverage'=>$med_covrg,

			'mail'=>$emp_email,

			'physical_address'=>$physical_address,

			'document_type'=>$document_type,

			'document_expiration'=>$doc_expiredate,

			'document_name'=>$document_name



		);



        $tbl_name='employee';

        $this->load->Model('General_Model');

        $result=$this->General_Model->update($updateData,$updateID,$tbl_name);



		if(!empty($result)){



			$this->session->set_flashdata('success', "Record Update Successfully !!"); 

			redirect('employee/EmployeeController/showEmployeeList');



		}

		else{



			$this->session->set_flashdata('error',"Sorry,Record Update failed.");

			redirect('employee/EmployeeController/showEmployeeList');

		}

}



















/*****************Upload Function Start****************/



public function do_uploads($filename){



		$config['upload_path']="./uploads/";

		$config['allowed_types']='jpg|png|jpeg|csv|txt|xls|xlsx|doc|docx|pdf';

		$this->load->library('upload',$config);

	

		if(!$this->upload->do_upload($filename)){



			return $this->upload->display_errors();

		}

		else{



			$data=$this->upload->data();

			return $data['file_name'];

		}





}





/***************Upload Function End**********************/

// view reports for employee documents
/***************View Reports Start**********************/
public function view_reports(){
	$this->load->model('employee/EmployeeModel');
	$data['employees']=$this->EmployeeModel->getListData();
	$this->load->view('header');
	$this->load->view("footer");
	$this->load->view("employee/view_reports",$data);
}
/***************View Reports End**********************/



}

