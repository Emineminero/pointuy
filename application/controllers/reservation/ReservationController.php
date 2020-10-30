<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReservationController extends CI_Controller {

	var $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('reservation/ItemModel');
		$this->load->model('General_Model', 'gModel');
	}

	public function index()
	{
		$data['fields'] = $this->ItemModel->getListData();
		$this->load->view('header');
		$this->load->view('reservation/view_reservation', $data);
		$this->load->view('footer');
	}

	public function add_reservation($id = 0)
	{
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

	public function save()
	{
		$this->data = $_REQUEST;
		//echo '<pre>';
		//print_r($this->data);
		//echo '</pre>';exit;
		if(empty($this->data)) return false;

		$required=array(
			'reservation_name',
			'checkin_date',
			'no_of_days',
			'checkout_date',
			'sale_channel',
			'extras',
			'room_type',
			'charge_to',
			'bill_to',
			'extra_expense_to',
			'deadline_date',
			'time_of_arrival',
			'observation'
		);

		if(empty($this->data['id']))
		{
			$this->data['reservation_no'] = date("ymdhis");
			unset($this->data['id']);
		}

		foreach($required as $field)
		{
			if(empty($this->data[$field]))
			{
				$this->error="\n Required fields are missing!";
				$this->error_developer=" \n field '$field' missing!";
				return false;
			}
		}

		$id = (isset($this->data['id'])) ? $this->data['id'] : 0;

		$this->data['extras'] = implode(",", $this->data['extras']);

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

		$query = $this->gModel->buildQuery($this->data, 'reservation', $case, $where);
		$result = $this->gModel->executeQuery($query);

		if($result)
		{
			if(empty($id)) $this->data['reservation_id'] = $result['insert_id'];
			else $this->data['reservation_id'] = $id;

			$reservation_details = "";
			foreach($this->data['room_types'] as $key => $room_type)
			{
				$reservation_details .= $room_type.','.$this->data['no_of_persons'][$key].','.$this->data['no_of_bebe'][$key].','.
				$this->data['no_of_cuna'][$key].','.$this->data['room_nos'][$key];
				$reservation_details .= ($key == count($this->data['room_types']) - 1) ? '' : "@@";
			}
			$this->data['reservation_details'] = $reservation_details;
			$this->data['no_of_rooms'] = count($this->data['room_types']);
			$this->data['no_of_persons'] = count($this->data['no_of_persons']);

			$query = $this->gModel->buildQuery($this->data, 'reserved_room', $case, $where);
			$result = $this->gModel->executeQuery($query);

			if( !empty($this->data['charge_to']) && $this->data['charge_to'] > 2 )
			{
				$this->data['charge_to'] = $this->data['charge_to'].',';
				$this->data['charge_to'] .= !empty($this->data['charge_to_client']) ? $this->data['charge_to_client'] : '';
				$this->data['charge_to'] .= !empty($this->data['charge_to_company']) ? $this->data['charge_to_company'] : '';
			}
			if( !empty($this->data['bill_to']) && $this->data['bill_to'] > 2 )
			{
				$this->data['bill_to'] = $this->data['bill_to'].',';
				$this->data['bill_to'] .= !empty($this->data['bill_to_client']) ? $this->data['bill_to_client'] : '';
				$this->data['bill_to'] .= !empty($this->data['bill_to_company']) ? $this->data['charge_to_company'] : '';
			}
			if( !empty($this->data['extra_expense_to']) && $this->data['extra_expense_to'] > 2 )
			{
				$this->data['extra_expense_to'] = $this->data['extra_expense_to'].',';
				$this->data['extra_expense_to'] .= !empty($this->data['extra_expense_to_client']) ? $this->data['extra_expense_to_client'] : '';
				$this->data['extra_expense_to'] .= !empty($this->data['extra_expense_to_company']) ? $this->data['extra_expense_to_company'] : '';
			}

			$query = $this->gModel->buildQuery($this->data, 'reservation_bill', $case, $where);
			$result = $this->gModel->executeQuery($query);
		}
		else
		{
			$this->error="\n Required fields are missing!";
			$this->error_developer=" \n field '$field' missing!";
			return false;
            $this->data['_user_id'] = $id;
			$this->error_developer = $db->errorMsg();
			$this->error = 'User Updation Failed!';
			return false;
		}
		$this->index();
	}

	public function saveGroupPerms()
	{
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

	function delete_user($id = 0)
	{
		if(empty($id)) return false;

		if($this->ItemModel->deleteUser($id))
		{
			$this->index();
		}
	}

	function load_rooms_by_type()
	{
		if(empty($_REQUEST['room_type']) || empty($_REQUEST['room_no'])) return false;
		$result = $this->ItemModel->load_rooms_by_type($_REQUEST['room_type'], $_REQUEST['room_no']);

		$output = null;

		foreach ($result as $key => $value) {
			$output.="<li data_id="."'".$value['id']."'".">".$value['room_number']."<li>";
		}

		echo $output;
	}
}
?>
