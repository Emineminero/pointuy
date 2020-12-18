<?php if(  ! defined('BASEPATH')) exit('No direct script access allowed');

class ExtrasModel extends CI_Model{

	public function getListData($hotel_id = NULL){
		if($hotel_id){
			$sql="SELECT * FROM `extras` WHERE hotel_id = $hotel_id order by id DESC";
		} else{
			$sql="SELECT * FROM `extras` order by id DESC";
		}
		// $sql="SELECT * FROM `extras`";
		$sql_result=$this->db->query($sql);
		$result=$sql_result->result_array();

		return $result;
	}


	  public function delete($id){

    	$sql="DELETE FROM `extras` WHERE id=".$id;
    	$excuteQuery=$this->db->query($sql);
    	$queryResult=$this->db->affected_rows();

    	return $queryResult;

    }


	public function getItemData($id){

		$sql="SELECT * FROM `extras` WHERE id=".$id;
		$excuteQuery=$this->db->query($sql);
		$queryResult=$excuteQuery->result_array();

		return $queryResult;


	}
	





}



?>