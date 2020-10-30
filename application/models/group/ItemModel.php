<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ItemModel extends CI_Model {

	function getItemData($id = 0)
	{
		if(empty($id)) return false;

		$query = "
			SELECT
				user_role.id,
				user_role.role,
				GROUP_CONCAT(group_permission.perm_id SEPARATOR ',') AS group_perms
			FROM
				user_role
			LEFT JOIN group_permission ON group_permission.group_id = user_role.id
			WHERE
				user_role.id = ".(int)$id."
			GROUP BY
				user_role.id";

		$query = $this->db->query($query);
		$row = $query->row_array();

		return $row;
	}

	function loadPermissions() {
		$query = "
				SELECT
					permissions.id,
					permissions.perm_desc
				FROM
					permissions
				ORDER BY
					permissions.perm_desc ASC";

		$query = $this->db->query($query);
		$result = $query->result_array();

    	return $result;
  	}

  function loadSubPermissions() {
		$query = "
				SELECT
					permission_subpermission.perm_id,
					permission_subpermission.sub_perm_id,
					subpermissions.sub_perm_label
				FROM
					subpermissions
					INNER JOIN permission_subpermission ON permission_subpermission.sub_perm_id = subpermissions.id
				ORDER BY
					permission_subpermission.perm_id, permission_subpermission.sub_perm_id ASC";

		$query = $this->db->query($query);
		$result = $query->result_array();
		$subpermissions = array();
		if(!empty($result))
		{
			foreach($result as $res)
			{
				$subpermissions[$res['perm_id']][] = $res;
			}
		}
		/*echo '<pre>';
		print_r($subpermissions);
		echo '</pre>';
		exit;*/

    	return $subpermissions;
  }

  function loadBlocklist() {
		$query = "
				SELECT
					group_sub_blocklist.group_id,
					group_sub_blocklist.perm_id,
					group_sub_blocklist.sub_perm_id
				FROM
					group_sub_blocklist";
		if(!empty($_REQUEST['id'])) $query .= " WHERE group_sub_blocklist.group_id = ".(int)$_REQUEST['id'];
		$query .= " ORDER BY group_sub_blocklist.group_id,perm_id ASC";

		$query = $this->db->query($query);
		$response = $query->result_array();
		$result = array();
		if(!empty($response))
		{
			foreach($response as $r=>$res)
			{
				$result[$res['group_id']][$res['perm_id']][$res['sub_perm_id']] = $res['sub_perm_id'];
			}
		}

    	return $result;
  }

  function getListData()
  {
  		$query = "
				SELECT
					user_role.id,
					user_role.role,
					COUNT(user_role.id) AS perms,
					GROUP_CONCAT( permissions.perm_desc ORDER BY permissions.perm_desc DESC SEPARATOR ', ') AS group_perms
				FROM
					user_role
				LEFT JOIN group_permission ON group_permission.group_id = user_role.id
				LEFT JOIN permissions ON group_permission.perm_id = permissions.id
				WHERE
				   user_role.deleted = 0
				GROUP BY
					user_role.id
				ORDER BY
					perms DESC ";

		$query = $this->db->query($query);
		$response = $query->result_array();

		return $response;
  }

  function buildQuery($fields, $table, $case = 'INSERT', $where = '')
  {
		$query = "SHOW COLUMNS FROM $table";
		$query = $this->db->query($query);
		$response = $query->result_array();

		$column = array();

		foreach( $response as $row )
		{
			$column[] = $row['Field'];
    	}

		$query = $case;

		if($case == 'INSERT')
		{
			$query .= " INTO";
		}

		$query .= " `".$table."` SET ";

		foreach ($fields as $k => $v)
		{
			if(in_array($k, $column))
			{
				if($v != '')
				{
					$query .= '`'.$k.'` = ';
					$query .= "".$this->db->escape($v).",";
				} else {

					$query .= '`'.$k.'` = ';

					if( is_null($v) )
						$query .= " NULL ,";
					else
						$query .= "'',";
				}
			}
		}

		$query .= ')';

		$query = str_replace(',)','',$query);

		if($where != '') $query .= ' WHERE '.$where;

		return $query;
  }

  function executeQuery($query1)
  {
  		$result = array();
  		$query = $this->db->query($query1);
  		$result["insert_id"] = $this->db->insert_id();;
  		$result["affected_rows"] = $this->db->affected_rows();

  		return $result;
  }

  function deleteUser($id = 0)
  {
  		if(empty($id)) return false;
  		return $this->db->delete('users', array('id' => $id));
  }

}

?>
