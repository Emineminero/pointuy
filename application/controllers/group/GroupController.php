<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GroupController extends CI_Controller {

	var $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('group/ItemModel');
	}

	public function index()
	{
		$data['fields'] = $this->ItemModel->getListData();
		$this->load->view('header');
		$this->load->view('group/view_groups', $data);
		$this->load->view('footer');
	}

	public function add_group($id = 0)
	{
		$data = array();

		$fields = !empty($id) ? $this->ItemModel->getItemData($id) : array();
		$permissions = $this->ItemModel->loadPermissions();
		$subpermissions = $this->ItemModel->loadSubPermissions();
		$blocklist = $this->ItemModel->loadBlocklist();

		$data['fields'] = $fields;
		$data['permissions'] = $permissions;
		$data['subpermissions'] = $subpermissions;
		$data['blocklist'] = $blocklist;

		$this->load->view('header');
		$this->load->view('group/add_group', $data);
		$this->load->view('footer');
	}

	public function save()
	{
		$this->data = $_REQUEST;
		if(empty($this->data)) return false;

		$required=array(
			'role',
			'groupPerms'
		);

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

		$query = $this->ItemModel->buildQuery($this->data, 'user_role', $case, $where);

		$result = $this->ItemModel->executeQuery($query);

		if($result)
		{
			if(empty($id )) $this->data['_group_id'] = $result['insert_id'];
			else $this->data['_group_id'] = $id;
		}
		else
		{
            $this->data['_group_id'] = $id;
			$this->error_developer = $db->errorMsg();
			$this->error = 'User Role Updation Failed!';
			return false;
		}
		if($this->saveGroupPerms())
		{
			$this->index();
		}
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
}
?>
