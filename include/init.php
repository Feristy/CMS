<?php

session_start();

spl_autoload_register(function($class){
	require_once 'core/'.$class.'.php';
});

include 'core/timezone.php';
$timezone = json_decode($timezone);

$user 		= new user();
$file 		= new file();
$validation = new validation();
$data 		= new data();
$paging		= new paging();
$cookie 	= new cookie();
$set 		= new set();

date_default_timezone_set($set->val('timezone'));
