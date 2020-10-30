<?php if(  ! defined('BASEPATH')) exit('No direct script access allowed');

class RatesModel extends CI_Model{


	public function getCompanyList(){

		$sql="SELECT `company_name` FROM `company`";
		$sql_result=$this->db->query($sql);
		$result=$sql_result->result_array();

		return $result;
	}

	public function getRoomList(){

		$sql="SELECT `room_number` FROM `rooms`";
		$sql_result=$this->db->query($sql);
		$result=$sql_result->result_array();

		return $result;
	}

	public function getListData(){

		$sql="SELECT * FROM `rates`";
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