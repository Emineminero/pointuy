<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CompanyModel extends CI_Model{


	public function getListData($hotel_id = null){
		if($hotel_id){
			$sql="SELECT * FROM `company` where hotel_id = $hotel_id order by id DESC";
		} else{
			$sql="SELECT * FROM `company` order by id DESC";
		}
		// echo"<pre>";
		// print_r($sql);
		// exit;
		// $sql="SELECT * FROM `company`";
		$sql_result=$this->db->query($sql);
		$result=$sql_result->result_array();

		return $result;
	}

	public function getItemData($id){
		$sql="SELECT * FROM `company` WHERE id=".$id;
		$excuteQuery=$this->db->query($sql);
		$queryResult=$excuteQuery->result_array();
		return $queryResult;
	}


    public function delete($id){
    	$sql="DELETE FROM `company` WHERE id=".$id;
    	$excuteQuery=$this->db->query($sql);
    	$queryResult=$this->db->affected_rows();
    	return $queryResult;
    }


}