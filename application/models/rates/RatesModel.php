<?php if(  ! defined('BASEPATH')) exit('No direct script access allowed');

class RatesModel extends CI_Model{


	public function getCompanyList($hotel_id = NULL){
		if($hotel_id){
			$sql="SELECT `company_name` FROM `company` WHERE hotel_id = $hotel_id order by id DESC";
		} else{
			$sql="SELECT `company_name` FROM `company` order by id DESC";
		}
		// $sql="SELECT `company_name` FROM `company`";
		$sql_result=$this->db->query($sql);
		$result=$sql_result->result_array();

		return $result;
	}

	public function getRoomList($hotel_id = NULL){
		if($hotel_id){
			$sql="SELECT `room_number`,`room_type` FROM `rooms` WHERE hotel_id = $hotel_id GROUP BY room_type ORDER BY id DESC ";
		} else{
			$sql="SELECT `room_number`,`room_type` FROM `rooms` GROUP BY room_type ORDER BY id DESC";
		}
		// $sql="SELECT `room_number` FROM `rooms`";
		$sql_result=$this->db->query($sql);
		$result=$sql_result->result_array();

		return $result;
	}

	public function getListData($hotel_id = NULL){
		if($hotel_id){
			$sql="SELECT * FROM `rates` WHERE hotel_id = $hotel_id order by id DESC";
		} else{
			$sql="SELECT * FROM `rates` order by id DESC";
		}
		// $sql="SELECT * FROM `rates`";
		$sql_result=$this->db->query($sql);
		$result=$sql_result->result_array();

		return $result;
	}


	  public function delete($id){

    	$sql="DELETE FROM `rates` WHERE id=".$id;
    	$excuteQuery=$this->db->query($sql);
    	$queryResult=$this->db->affected_rows();

    	return $queryResult;

    }


	public function getItemData($id){

		$sql="SELECT * FROM `rates` WHERE id=".$id;
		$excuteQuery=$this->db->query($sql);
		$queryResult=$excuteQuery->result_array();

		return $queryResult;


	}
	





}



?>