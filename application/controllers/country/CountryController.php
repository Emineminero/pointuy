<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CountryController extends CI_Controller {


	public function __construct(){

		parent::__construct();
		$this->load->model('country/CountryModel');

		}
	public function select_country(){

		//$search_value=$this->input->post('search');
		$search_value=$_REQUEST['search'];
		$result=$this->CountryModel->fetch_country($search_value);
		$output=null;

		foreach ($result as $key => $value) {
			$output.="<li data_id="."'".$value['countryName']."'".">".$value['countryName']."<li>";
		}

		echo $output;


		//echo json_encode($result);

		
		}


	}
?>
