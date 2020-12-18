<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class General_Model extends CI_Model{

	public function insert($tbl_name,$data){

        $tbl_key=array_keys($data);
        $tbl_val=array_values($data);
        $sql="INSERT INTO $tbl_name (".implode(',', $tbl_key).")". "VALUES ('".implode("','", $tbl_val)."')";
        $query=$this->db->query($sql);
        $last_id=$this->db->insert_id($query);
        
        return $last_id;

	}


	public function update($data,$id,$tbl_name){

        $sql=null;

      
        foreach ($data as $key => $value) {
             $sql.=$key."="."'".$value."'".","; 
        }
         
        $sql_query=rtrim($sql,",");
        $query="UPDATE ".$tbl_name." SET ".$sql_query.' WHERE id='.$id;
        $query_run=$this->db->query($query);
        $result=$this->db->affected_rows();
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


}



?>
