<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ItemModel extends CI_Model {

	function loadRoomTypes($hotel_id = NULL)
	{
		if($hotel_id){
			$query="SELECT DISTINCT(rooms.room_type) FROM rooms WHERE hotel_id = $hotel_id";
		} else{
			$query = "SELECT DISTINCT(rooms.room_type) FROM rooms";
		}
		// $query = "SELECT DISTINCT(rooms.room_type) FROM rooms";
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
  		$query = "
				SELECT
					`reservation`.`id`,
				    `reservation`.`reservation_no`,
				    `reservation`.`reservation_name`,
				    `reservation`.`checkin_date`,
				    `reservation`.`checkout_date`,
				    `reservation`.`no_of_days`,
				    `reservation`.`sale_channel`,
				    `reservation`.`extras`,
				    `reservation`.`deadline_date`,
				    `reservation`.`arrival_time`,
				    `reservation`.`observation`,

				    `reserved_room`.`id` AS reserved_room_id,
				    `reserved_room`.`reservation_id`,
				  	`reserved_room`.`no_of_rooms`,
				  	`reserved_room`.`no_of_persons`,
				  	`reserved_room`.`reservation_details`,

				  	`reservation_bill`.`id` AS reservation_bill_id,
				  	`reservation_bill`.`reservation_id`,
				  	`reservation_bill`.`charge_to`,
				  	`reservation_bill`.`bill_to`,
				  	`reservation_bill`.`extra_expense_to`
				FROM
					 reservation
					 LEFT JOIN `reserved_room` ON `reservation`.`id` = `reserved_room`.`reservation_id`
					 LEFT JOIN `reservation_bill` ON `reservation`.`id` = `reservation_bill`.`reservation_id`
					";
		if(!empty($id))
		{
			$query .= " WHERE `reservation`.`id` = ".$id." ";
		// } else{
			// $query .= " WHERE `reservation`.`id` = ".$id." ";
		}

		$query = $this->db->query($query);
		$response = $query->result_array();

		if(!empty($id)) $response = $response[0];

		return $response;
  }

  function userLogin($fields)
  {
  		$query = "
			SELECT
				users.id,
				users.full_name,
				users.user_name,
				users.sector,
				users.site_login
			FROM
				users
			WHERE
				users.user_name = '".$fields['user_name']."'
				AND users.password = '".$fields['password']."'
				AND users.site_login = 1
				AND users.deleted = 0";

		$query = $this->db->query($query);
		$row = $query->row_array();

		return $row;
  }

  function getUserPermissions($id = 0)
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
					permissions.perm_desc,
					permissions.title,
					permissions.icon,
					permissions.add_link,
					permissions.view_link
				FROM
					permissions
				ORDER BY
					permissions.perm_desc ASC";

		$query = $this->db->query($query);
		$result = $query->result_array();

    	return $result;
  }

  function load_rooms_by_type($room_type = 0, $room_no = 0)
  {
  		if(empty($room_type) && $room_no) return false;

  		$sql = "
  				SELECT
  					rooms.id,
  					rooms.room_number
  				FROM
  					rooms
  				WHERE
  					rooms.room_number LIKE '".$room_no."%' AND
  					rooms.room_type LIKE '".$room_type."%' AND rooms.room_condition = 1 AND rooms.room_status=2 ";

		$sql_result=$this->db->query($sql);
		$result=$sql_result->result_array();

		return $result;
  }

	 public function delete($id){
		   $this->db->delete('reservation', array('id' => $id)); 
		   $this->db->delete('reservation_bill', array('reservation_id' => $id));
		   $this->db->delete('reserved_room', array('reservation_id' => $id));
			// $sql="DELETE FROM reservation,reservation_bill,reserved_room WHERE reservation.id=".$id;
			// $excuteQuery=$this->db->query($sql);
			$queryResult=$this->db->affected_rows();
			return $queryResult;
		}

	function load_room($room_type){
		$query = "SELECT room_number FROM rooms WHERE rooms.room_type LIKE '".$room_type."%' AND room_condition = 1 AND room_status=2";
		$query = $this->db->query($query);
		$result = $query->result_array();
		return $result;
	}

}

?>
