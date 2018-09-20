<?php

class cookie{

	public static function exists($name){
		return (isset($_COOKIE[$name])) ? true: false;
	}

	public static function set($name, $nilai){
		return setcookie($name, $nilai, time()+2592000);
	}

	public static function flash($name, $pesan = ''){
		if(self::exists($name)){
			$cookie = self::get($name);
			return $cookie;
		}else{
			setcookie($name, $pesan, time()+1);
		}
	}

	public static function get($name){
		return $_COOKIE[$name];
	}

	public static function delete($name, $nilai){
		return setcookie($name, $nilai, time()-2592000);
	}

	public static function view_notf($notf){
		if(self::exists($notf)){
			$notf = json_decode(self::flash($notf));
			$show = array();
			foreach ($notf as $value_notf) {
				if(!empty($value_notf)){
					$show[] = '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$value_notf.'</div>';
				}
			}
			return $show;
		}
	}
}