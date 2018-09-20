<?php

class time{

	public static function get($data){
		$time = time() - $data;
		if($time <= 1){
				$time = 'Baru saja';
		}elseif($time < 60){
			$time = date('s', $time).' seconds ago';
		}elseif($time < 3600){
			$time = date('i', $time).' minutes ago';
		}elseif($time < 86400){
			$time = date('G', $time).' hours ago';
		}elseif($time < 604800){
			$time = date('d', $time).' days ago';
		}else{
			$time = date('d M Y', $data);
		}
		return $time;
	}
}