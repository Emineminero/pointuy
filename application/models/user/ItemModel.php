<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ItemModel extends CI_Model {

	function loadUserRole()
	{
		$query = "
			SELECT
				user_role.id,
				user_role.role
			FROM
				user_role
			WHERE
				user_role.deleted = 0
			ORDER BY
				user_role.role ASC";

		$query = $this->db->query($query);
		$result = $query->result_array();

		return $result;
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
		// return $this->db->last_query();
  }

  function executeQuery($query1)
  {
  		$result = array();
  		$query = $this->db->query($query1);
  		$result["insert_id"] = $this->db->insert_id();;
  		$result["affected_rows"] = $this->db->affected_rows();

  		return $result;
  }

  function getListData($id = 0)
  {
	  // if($this->session->userdata['isSuperAdmin'] == 1){
		$hotel_id = $this->session->userdata['hotel_id'];
	  // } else{
		  // $hotel_id = '';
	  // }
	  // echo"<pre>";
	  // print_r($hotel_id);
	  // exit;
  		$query = "
				SELECT
					users.id,
					users.full_name,
                    users.user_name,
                    users.sector,
                    users.site_login,
					users.hotel_id,
					hotels.hotel_name,
                    user_role.role
				FROM
					users
				LEFT JOIN user_role ON users.sector = user_role.id
				LEFT JOIN hotels ON hotels.hotel_id = users.hotel_id
				WHERE
				   users.deleted = 0
				   AND users.isSuperAdmin=0";
		if(!empty($hotel_id) && $hotel_id>0) $query .= " AND users.hotel_id = ".$hotel_id." ";
		if(!empty($id)) $query .= " AND users.id = ".$id." ";
		$query .="
				ORDER BY
					users.id ASC ";

		$query = $this->db->query($query);
		$response = $query->result_array();

		if(!empty($id)) $response = $response[0];

		return $response;
		// return $this->db->last_query();
  }

  function deleteUser($id = 0)
  {
  		if(empty($id)) return false;

  		return $this->db->delete('users', array('id' => $id));
  }

  function checkDupilcateUserName($userName)
  {
  		$query = "
			SELECT
				COUNT(id) AS count
			FROM
				users
			WHERE
				users.user_name = '".$userName."'
				AND users.deleted = 0";
		$query = $this->db->query($query);
		$row = $query->row_array();

		return $row['count'];
  }

}

?>
