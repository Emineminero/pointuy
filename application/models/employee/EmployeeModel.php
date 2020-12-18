<?php if(  ! defined('BASEPATH')) exit('No direct script access allowed');

class EmployeeModel extends CI_Model{

	public function getListData($hotel_id = NULL){
		if($hotel_id){
			$sql="SELECT * FROM `employee` WHERE hotel_id = $hotel_id order by id DESC";
		} else{
			$sql="SELECT * FROM `employee` order by id DESC";
		}
		// $sql="SELECT * FROM `employee`";
		$sql_result=$this->db->query($sql);
		$result=$sql_result->result_array();

		return $result;
	}


	  public function delete($id){

    	$sql="DELETE FROM `employee` WHERE id=".$id;
    	$excuteQuery=$this->db->query($sql);
    	$queryResult=$this->db->affected_rows();

    	return $queryResult;


    }


	public function getItemData($id){

		$sql="SELECT * FROM `employee` WHERE id=".$id;
		$excuteQuery=$this->db->query($sql);
		$queryResult=$excuteQuery->result_array();

		return $queryResult;


	}





}



?>