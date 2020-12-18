<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}
	
	public function index()
	{
		//$this->load->view('welcome_message');
		$this->load->view('my_page');
	}

	public function employe_profile(){

		$this->load->view('employe_profile');

	}


	public function company_profile(){

		$this->load->view('company_profile');

	}


	public function guest_profile(){

		$this->load->view('guest_profile');

	}


	public function extras(){

		$this->load->view('extras');

	}
}
