<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReservationController extends CI_Controller {

	var $data;

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('reservation/ItemModel');
		$this->load->model('General_Model', 'gModel');
	}

	public function index(){
		$hotel_id = $this->session->userdata['hotel_id'];
		$data['fields'] = $this->ItemModel->getListData();
		$this->load->view('header');
		$this->load->view('reservation/view_reservation', $data);
		$this->load->view('footer');
	}

	public function add_reservation($id = 0){
		$data = array();

		/*$fields = !empty($id) ? $this->ItemModel->getItemData($id) : array();
		$permissions = $this->ItemModel->loadPermissions();
		$subpermissions = $this->ItemModel->loadSubPermissions();
		$blocklist = $this->ItemModel->loadBlocklist();

		$data['fields'] = $fields;
		$data['permissions'] = $permissions;
		$data['subpermissions'] = $subpermissions;
		$data['blocklist'] = $blocklist;*/
		$data['fields'] = $this->ItemModel->getListData($id);
		$data["room_types"] = $this->ItemModel->loadRoomTypes();

		$this->load->view('header');
		$this->load->view('reservation/add_reservation', $data);
		$this->load->view('footer');
	}

	public function save(){
		// $this->form_validation->set_rules('reservation_name','Reservation Name','required');
        // $this->form_validation->set_rules('checkin_date','Checkin Date','required');
        // $this->form_validation->set_rules('checkout_date','Checkout Date','required');
        // $this->form_validation->set_rules('sale_channel','Sale Channel','required');
        // $this->form_validation->set_rules('room_type','Room Type','required');
        // $this->form_validation->set_rules('cant','Cant','required');
        // $this->form_validation->set_rules('pax','Pax','required');
        // $this->form_validation->set_rules('no_of_persons','No of Persons','required');
        // $this->form_validation->set_rules('no_of_bebe','No of Bebe','required');
        // $this->form_validation->set_rules('no_of_cuna','No of Cuna','required');
        // $this->form_validation->set_rules('room_nos','Room Nos','required');
        // $this->form_validation->set_rules('charge_to','Charge To','required');
        // $this->form_validation->set_rules('bill_to','Bill To','required');
        // $this->form_validation->set_rules('charge_to_client','Charge to Client','required');
        // $this->form_validation->set_rules('charge_to_company','Charge to Company','required');
        // $this->form_validation->set_rules('bill_to_client','Bill to Client','required');
        // $this->form_validation->set_rules('bill_to_company','Bill to Company','required');
        // $this->form_validation->set_rules('extra_expense_to','Extra Expense to','required');
        // $this->form_validation->set_rules('deadline_date','Deadline Date','required');
        // $this->form_validation->set_rules('extra_expense_to_client','Extra Expense to Client','required');
        // $this->form_validation->set_rules('extra_expense_to_company','Extra Expense to Company','required');
        // $this->form_validation->set_rules('arrival_time','Arrival Time','required');
        // $this->form_validation->set_rules('observation','observation','required');
		
		// $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		// $full_name=$this->input->post('full_name');
		// $reservation_name= $_REQUEST['reservation_name'];
		// $checkin_date= $_REQUEST['checkin_date'];
		// $no_of_days= $_REQUEST['no_of_days'];
		// $checkout_date= $_REQUEST['checkout_date'];
		// $sale_channel= $_REQUEST['sale_channel'];
		// $charge_to= $_REQUEST['charge_to'];
		// $bill_to= $_REQUEST['bill_to'];
		// $extras= $_REQUEST['extras'];
		// $extra_expense_to= $_REQUEST['extra_expense_to'];
		// $deadline_date= $_REQUEST['deadline_date'];
		// $arrival_time= $_REQUEST['arrival_time'];
		// $observation= $_REQUEST['observation'];
		
		// $res_id= $_REQUEST['id'];
		// echo '<pre>';
		// print_r($reservation_name);
		// echo '------------------------- end-----------------------------------------------------';
		// print_r($_REQUEST);
		// echo '------------------------------------------------------------------------------';exit;
		$this->data = $_REQUEST;
		$room_nos =$this->data['room_nos'];
		// echo '<pre>';
		// print_r($room_nos);
		// exit;
		if(empty($_REQUEST)) return false;
		if(in_array(-1,$room_nos )){
			$this->error="\n select room!";
			$this->error_developer=" \n field room_nos missing!";
			redirect(base_url() . 'reservation/ReservationController/');
			// return false;
		} 

		$required=array(
			'reservation_name',
			'checkin_date',
			'no_of_days',
			'checkout_date',
			'sale_channel',
			'room_type',
			'charge_to',
			'bill_to',
			'extras',
			'extra_expense_to',
			'deadline_date',
			// 'time_of_arrival',
			'arrival_time',
			'observation',
		);

		if(empty($this->data['id'])){
			$this->data['reservation_no'] = date("ymdhis");
			// unset($this->data['id']);
		}
// echo"<pre>";
		// print_r($this->data);
		// echo"------------------    2nd -------room_nos---------------------------------";
		// print_r($required);
		// exit;
		foreach($required as $field){
			if(empty($this->data[$field])){
				$this->error="\n Required fields are missing!";
				$this->error_developer=" \n field '$field' missing!";
				return false;
			}
		}

		$Cid = (isset($this->data['id'])) ? $this->data['id'] : 0;
		$hotel_id = $this->session->userdata['hotel_id'];
		$this->data['hotel_id'] = $hotel_id;
		if(!empty($this->data['extras'])){
			$this->data['extras'] = implode(",", $this->data['extras']);
		}
		// echo"<pre>";
		// print_r($Cid);
		// echo"------------------    2nd ----------------------------------------";
		// exit;
		if($Cid > 0){
			$case = 'UPDATE';
			$where = 'id = '.$Cid.' AND hotel_id ='.$hotel_id;
		}
		else{
			$case = 'INSERT';
			$where = '';
		}
		$query = $this->ItemModel->buildQuery($this->data, 'reservation', $case, $where);
		
		$result = $this->ItemModel->executeQuery($query);

		if($result){
			if(empty($Cid)) $this->data['reservation_id'] = $result['insert_id'];
			else $this->data['reservation_id'] = $Cid;

			$reservation_details = "";
			// echo"<pre>";
			// print_r($this->data);
			// exit;
			$myparams = array(
					'room_status' => 1
				);
			foreach($this->data['room_nos'] as $room_no){
				// $this->db->where("room_number LIKE %".$room_no."%");
				if($room_no != -1){					
					$this->db->where("`room_number` LIKE '%$room_no%'");
					$record2 =$this->db->update('rooms',$myparams);
				}
			}
			foreach($this->data['room_type'] as $key => $room_type){
				$reservation_details .= $room_type.','.$this->data['no_of_persons'][$key].','.$this->data['no_of_bebe'][$key].','.
				$this->data['no_of_cuna'][$key].','.$this->data['room_nos'][$key];
				$reservation_details .= ($key == count($this->data['room_type']) - 1) ? '' : "@@";
			}
			$this->data['reservation_details'] = $reservation_details;
			$this->data['no_of_rooms'] = count($this->data['room_type']);
			$this->data['no_of_persons'] = count($this->data['no_of_persons']);
			
			$query = $this->ItemModel->buildQuery($this->data, 'reserved_room', $case, $where);
			$result = $this->ItemModel->executeQuery($query);

			if( !empty($this->data['charge_to']) && $this->data['charge_to'] > 2 ){
				$this->data['charge_to'] = $this->data['charge_to'].',';
				$this->data['charge_to'] .= !empty($this->data['charge_to_client']) ? $this->data['charge_to_client'] : '';
				$this->data['charge_to'] .= !empty($this->data['charge_to_company']) ? $this->data['charge_to_company'] : '';
			}
			if( !empty($this->data['bill_to']) && $this->data['bill_to'] > 2 ){
				$this->data['bill_to'] = $this->data['bill_to'].',';
				$this->data['bill_to'] .= !empty($this->data['bill_to_client']) ? $this->data['bill_to_client'] : '';
				$this->data['bill_to'] .= !empty($this->data['bill_to_company']) ? $this->data['charge_to_company'] : '';
			}
			if( !empty($this->data['extra_expense_to']) && $this->data['extra_expense_to'] > 2 ){
				$this->data['extra_expense_to'] = $this->data['extra_expense_to'].',';
				$this->data['extra_expense_to'] .= !empty($this->data['extra_expense_to_client']) ? $this->data['extra_expense_to_client'] : '';
				$this->data['extra_expense_to'] .= !empty($this->data['extra_expense_to_company']) ? $this->data['extra_expense_to_company'] : '';
			}

			$query = $this->ItemModel->buildQuery($this->data, 'reservation_bill', $case, $where);
			$result = $this->ItemModel->executeQuery($query);
		}
		else{
			$this->error="\n Required fields are missing!";
			$this->error_developer=" \n field '$field' missing!";
			return false;
            $this->data['_user_id'] = $Cid;
			$this->error_developer = $db->errorMsg();
			$this->error = 'User Updation Failed!';
			return false;
		}
		// $this->index();
		redirect(base_url() . 'reservation/ReservationController/');
	}

	public function saveGroupPerms(){
		$data = $this->data;

		//delete previous data if any
		$delete = "
				DELETE
				group_permission,
				group_sub_blocklist
				FROM
					group_permission
				LEFT JOIN group_sub_blocklist ON group_sub_blocklist.group_id = group_permission.group_id
				WHERE
					group_permission.group_id = ".$data["_group_id"];

		//$deleted = $db->query($delete);
		$deleted = $this->ItemModel->executeQuery($delete);

		$values = '';
		$permissionIds = array();
		if( !empty($data["_group_id"]) && !empty($data["groupPerms"]) )
		{
			foreach($data["groupPerms"] as $permission_id)
			{
				$values .= " (".$data["_group_id"]." , ".$permission_id." ) ,";
				$permissionIds[] = $permission_id;
			}
		}

		$Values = rtrim($values,',');

		if(!empty($Values))
		{
			$query = "INSERT INTO group_permission(`group_id`, `perm_id`) VALUES $Values";

			if(!$this->ItemModel->executeQuery($query))
			{
				$this->error_developer=$db->errorMsg();
				$this->error='group_permission updation failed!';
				return false;
			}

			$values='';
			if(!empty($data['subPermss']))
			{
				foreach($data['subPermss'] as $k => $v)
				{
					if(in_array($k, $permissionIds))
					{
						foreach($v as $a => $b)
						{
							if(!empty($b) && $b == "unchecked")
							{
								$values.= " ( ".$data["_group_id"].", ".$k.", ".$a." ) ,";
							}
						}
					}
				}

				$Values = rtrim($values,',');
				if(!empty($Values))
				{
					$query = "INSERT INTO group_sub_blocklist(`group_id`, `perm_id`, `sub_perm_id`) VALUES $Values";
					//echo $query;exit;

					if (!$this->ItemModel->executeQuery($query))
					{
						$this->error_developer = $db->errorMsg();
						$this->error = 'group_sub_blocklist updation failed!';
						return false;
					}
				}
			}
		}
		else
		{
			$this->error='groupPerms Data missing!';
			return false;
		}
		return true;
	}

	function delete_user($id = 0){
		if(empty($id)) return false;
		
		if($this->ItemModel->deleteUser($id))
		{
			$this->index();
		}
	}

	function load_rooms_by_type(){
		if(empty($_REQUEST['room_type']) || empty($_REQUEST['room_no'])) return false;
		$result = $this->ItemModel->load_rooms_by_type($_REQUEST['room_type'], $_REQUEST['room_no']);

		$output = null;

		foreach ($result as $key => $value) {
			$output.="<li data_id="."'".$value['id']."'".">".$value['room_number']."<li>";
		}

		echo $output;
	}
	function loadRoom(){
		$room_type= $_REQUEST['room_type'];
		if(empty($room_type)) return false;
		$rooms = $this->ItemModel->load_room($room_type);
		echo json_encode($rooms);
	}
	
	/*Start Delete Reservation*/
	public function delete_reservation($reservation_id = 0){
		$result=$this->ItemModel->delete($reservation_id);
		if(!empty($result)){
			$this->session->set_flashdata('success', "Record Delete Successfully !!"); 
			redirect('reservation/ReservationController');
		} else{
			$this->session->set_flashdata('error',"Sorry,Record Delete failed.");
			redirect('reservation/ReservationController');
		}
	}

	
}
?>
