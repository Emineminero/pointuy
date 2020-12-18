<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HotelsController extends CI_Controller {

	var $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		// $this->load->model('hotl/ItemModel');
	}

	public function index(){
		$this->load->view('header');
		$this->load->view('hotels/view_hotel');
		$this->load->view('footer');
	}

	public function add_hotel($id = 0){
		$data =array();
		if(!empty($id)){
			$this->db->select('*');
			$this->db->from('hotels');
			$this->db->where('hotel_id',$id);
			$data['fields']=$this->db->get()->result_array()[0];
		}

		$this->load->view('header');
		$this->load->view('hotels/add_hotel',$data);
		$this->load->view('footer');
	}
	public function save_hotel(){
		$id = $this->input->post('id');
		$this->form_validation->set_rules('hotel_name','Hotel Name','required');
		 if($this->form_validation->run() == FALSE){  
				$this->error="\n Required fields are missing!";
				$this->error.=" \n field Hotel Name is missing!";
				$this->session->set_flashdata('errors', $this->error);
				// $this->index();
			// $this->session->set_flashdata('error',"No Hotel Added.");
            redirect(base_url() . 'hotels/HotelsController/add_hotel');
			return false;
       } else{
		    $params = array(
				'hotel_name' => $this->input->post('hotel_name'));
			if($id>0){
				 $this->db->where('hotel_id',$id);
				$hotel_id=$this->db->update('hotels',$params);
			} else{
				$this->db->insert('hotels',$params);
				$hotel_id = $this->db->insert_id();
			}
			redirect(base_url() . 'hotels/HotelsController/index');
			// $this->load->view('header');
			// $this->load->view('hotels/view_hotel');
			// $this->load->view('footer');
	   }
	}
	
	function delete_hotel($id = 0){
		if(empty($id)) return false;
		if($this->db->delete('hotels',array('hotel_id'=>$id))){
			redirect(base_url() . 'hotels/HotelsController/index');
		}
	}

}
?>
