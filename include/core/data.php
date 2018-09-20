<?php

class data{

	public $db;

    public function __construct(){
      $this->db = database::get_instance();
    }

	public function insert($table, $fields = array()){

		$column = implode(",", array_keys($fields));
		$valuearray = array();
		$i=0;
		foreach($fields as $key => $value){
			if(!is_int($value)){
				$valuearray[$i] = "'". $this->db->escape($value) . "'";
			}
			$i++;
		}
		$values = implode(",", $valuearray);
		$query  = "INSERT INTO $table ($column) VALUES ($values)";
		return $this->db->run_query($query);
	}

	public function read($table, $column= '', $value= ''){

		$show = [];
		if(!is_int($value)) $value = "'" . $value . "'";
		if($column != ''){
			$query = "SELECT * FROM $table WHERE $column = $value";
			$result = $this->db->read_query($query);

			while($row = $result->fetch_assoc()){
				return $row;
			}
		}else{
			$query = "SELECT * FROM $table";
			$result = $this->db->read_query($query);

			while($row = $result->fetch_assoc()){
				$show[] = $row;
			}
			return $show;
		}
	}

	public function update($table, $fields = array(), $id){

		$valueArray = array();
    	foreach($fields as $key => $value){
        	$valueArray[] =$key ."='". $this->db->escape($value) ."'";
   		}
		$values = implode(",", $valueArray);
		$query = "UPDATE $table SET $values WHERE id=$id";
		return $this->db->run_query($query);
	}
	
	public function delete($table, $key, $value){

		$query = "DELETE FROM $table WHERE $key=$value";
		return $this->db->run_query($query);
	}

	public function filter($table, $keyfil, $valuefil){

		$show = array();
		$query = "SELECT * FROM $table WHERE $keyfil LIKE '%$valuefil%'";
		$result = $this->db->read_query($query);
		while($row = $result->fetch_assoc()){
			$show[] = $row;
		}
		return $show;
	}

	public function excerpt($data, $upto){

		$data = substr($data, 0, $upto);
		return $data;
	}

	public function ubah($table, $id){
		$query = "SELECT * FROM $table ORDER BY $id";
		$show = array();
		$result = $this->db->read_query($query);
		while($row = $result->fetch_assoc()){
			$show[] = $row;
		}
		return $show;

	}

	public function balik($table, $id){
		$query = "SELECT * FROM $table ORDER BY $id DESC";
		$show = array();
		$result = $this->db->read_query($query);
		while($row = $result->fetch_assoc()){
			$show[] = $row;
		}
		return $show;
	}

	public function rate($table, $id, $pos){
		$query = "SELECT * FROM $table ORDER BY $id DESC LIMIT 0,$pos";
		$show = array();
		$result = $this->db->read_query($query);
		while($row = $result->fetch_assoc()){
			$show[] = $row;
		}
		return $show;

	}
}