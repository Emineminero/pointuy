<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class MainController extends CI_Controller {



	var $data;

	var $error;



	public function __construct(){

		parent::__construct();

		$this->load->model('main/ItemModel');

	}



	public function index(){

		$this->load->view('main/login');

	}



	public function login(){

		$this->data = $_REQUEST;

		if(empty($this->data)) return false;



		$required = array(

										'user_name',

										'password'

									);



		foreach($required as $field){

			if(empty($this->data[$field])){

				$this->error = "Login Failed username or password couldn't be empty";

				$this->session->set_flashdata('errors', $this->error);

				$this->load->view('main/login');

				return false;

			}

		}



		$result = $this->ItemModel->userLogin($this->data);



		if(empty($result)){

			$this->error = "Login Failed contact administration";

			$this->session->set_flashdata('errors', $this->error);

			$this->load->view('main/login');

			return false;

		}



		

		if($result['isSuperAdmin'] == 1){

			$this->load->view('header');

			$this->load->view('hotels/view_hotel');

			$this->load->view('footer');

			$this->session->set_userdata($result);

		} else{

			$result['permissions'] = $this->ItemModel->loadPermissions();

			// echo"<pre>";

// print_r($result);

// exit;

			$user_permissions = array();

			if(!empty($result['sector'])){

				$user_permissions = $this->ItemModel->getUserPermissions($result['sector']);

				$result['group_perms'] = !empty($user_permissions['group_perms']) ? $user_permissions['group_perms'] : '';

			}

			// $this->load->view('user/add_user');

			// $this->load->view('user/view_users');

			$this->session->set_userdata($result);

			redirect(base_url() . index_page().'/user/UserController');

		}

		

// echo"<pre>";

// print_r($result);

// exit;

		// $this->load->view('user/add_user');

		// $this->load->view('footer');

	}



	public function logout(){

		$result = array('user_name', 'id', 'full_name', 'sector', 'site_login');

		$this->session->unset_userdata($result);

		$this->index();

		// redirect(base_url() . 'index.php/MainController');

	}

}

?>

