<?php

class database{

	public static $instance;
	public $mysqli,
			$host = 'localhost',
			$user = 'root',
			$pass = '',
			$dbnm = 'db_blog';

	public function __construct(){
		$this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->dbnm);

		if(mysqli_connect_error()){
			die('error');
		}
	}

	public static function get_instance(){
		if(!isset(self::$instance)){
			self::$instance = new database();
		}
		return self::$instance;
	}

	public function run_query($query){

		if($this->mysqli->query($query))
			return true;
		else
			return false;
	}

	public function read_query($query){
		return $this->mysqli->query($query);
	}

	public function escape($name){
		return $this->mysqli->real_escape_string($name);
	}
}