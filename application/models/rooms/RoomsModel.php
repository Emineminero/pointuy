<?php if(  ! defined('BASEPATH')) exit('No direct script access allowed');

class RoomsModel extends CI_Model{

	public function getListData(){

		$sql="SELECT * FROM `rooms`";
		$sql_result=$this->db->query($sql);
		$result=$sql_result->result_array();

		return $result;
	}


	  public function delete($id){

    	$sql="DELETE FROM `rooms` WHERE id=".$id;
    	$excuteQuery=$this->db->query($sql);
    	$queryResult=$this->db->affected_rows();

    	return $queryResult;

    }


	public function getItemData($id){

		$sql="SELECT * FROM `rooms` WHERE id=".$id;
		$excuteQuery=$this->db->query($sql);
		$queryResult=$excuteQuery->result_array();

		return $queryResult;


	}
	
	function checkDupilcateRoomNo($room_no)
  	{
  		$query = "
			SELECT
				COUNT(id) AS count
			FROM
				`rooms`
			WHERE
				`room_number`="."'".$room_no."'";

		$query = $this->db->query($query);
		$row = $query->row_array();

		return $row['count'];
    }
	





}



?>