<?php

class session{
	public static function exists($name){
		return (isset($_SESSION[$name])) ? true: false;
	}

	public static function set($name, $nilai){
		return $_SESSION[$name] = $nilai;
	}

	public static function get($name){
		if(!empty($name)){
			return $_SESSION[$name];
		}
	}

	public static function delete($name){
		if(self::exists($name)){
			unset($_SESSION[$name]);
		}
	}
}