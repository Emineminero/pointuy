<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

	var $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user/ItemModel');
	}

	public function index(){
		$data = array();
		// $hotel_id = $this->session->userdata['hotel_id'];
		$data['fields'] = $this->ItemModel->getListData();	  
	  // echo"<pre>";
	  // print_r($data);
	  // exit;
		// $this->load->view('header');
		$this->load->view('user/view_users', $data);
		// $this->load->view('footer');
	}

	public function add_user($id = 0)
	{
		$data = array();

		$data['userRole'] = $this->ItemModel->loadUserRole();
		if(!empty($id)) $data['fields'] = $this->ItemModel->getListData($id);

		$this->load->view('header');
		$this->load->view('user/add_user', $data);
		$this->load->view('footer');
	}

	public function save()
	{
		$this->data = $_REQUEST;
		// echo"<pre>";
	   // print_r($this->session->userdata['hotel_id']);
	   // exit;
		if(empty($this->data))
		{
			$this->error = "Invalid Request";
			$this->session->set_flashdata('errors', $this->error);
			$this->index();
			return false;
		}

		$required = array(
			'full_name',
			'user_name',
			'password',
			'sector'
		);

		foreach($required as $field)
		{
			if(empty($this->data[$field]))
			{
				$this->error="\n Required fields are missing!";
				$this->error.=" \n field '$field' missing!";
				$this->session->set_flashdata('errors', $this->error);
				$this->index();
				return false;
			}
		}

		$id = isset($this->data['id']) ? $this->data['id'] : 0;
		if($this->session->userdata['isSuperAdmin'] == 1){
			$hotel_id = $this->data['hotel_id'];
		} else{			
			$hotel_id = $this->session->userdata['hotel_id'];
		}
		$this->data['hotel_id'] = $hotel_id;
		if($id > 0)
		{
			$case = 'UPDATE';
			$where = 'id = '.$id;
		}
		else
		{
			$case = 'INSERT';
			$where = '';
		}

		$query = $this->ItemModel->buildQuery($this->data, 'users', $case, $where);
		$result = $this->ItemModel->executeQuery($query);

		if($result)
		{
			if(empty($id)) $this->data['_user_id'] = $result['insert_id'];
			else $this->data['_user_id'] = $id;
		}
		else
		{
            $this->data['_user_id'] = $id;
			$this->error_developer = $db->errorMsg();
			$this->error = 'User Updation Failed!';
			return false;
		}
		$this->index();
		// $this->load->view('user/view_users');
		 redirect(base_url() . index_page().'user/UserController');
	}

	function delete_user($id = 0)
	{
		if(empty($id)) return false;

		if($this->ItemModel->deleteUser($id))
		{
			$this->index();
		}
	}

	function check_dupilcate_user_name()
	{
		if(empty($_REQUEST['userName'])) return false;
		echo $this->ItemModel->checkDupilcateUserName($_REQUEST['userName']);
	}
}
?>
