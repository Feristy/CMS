<?php

class user{

  public $db;
  
  public function __construct(){
    $this->db = new data();
  }

  public function login($username, $password){
    $data = $this->db->read('user', 'username', $username);
    if(password_verify($password, $data['password'])) return true; else return false;
  }

  public function is_login($data){
  	if(session::exists($data) || cookie::exists($data)) return true; else return false;
  }

  public function is_data($table, $key, $username){
    $data = $this->db->read($table, $key, $username);
    if(empty($data)) return false; else return true;
  }

  public function get_data($username){
		if($this->cekName($username)){
  		return $this->db->read('user', $username);
  	}else{
			return false;
  	}
	}
}