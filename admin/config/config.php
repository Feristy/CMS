<?php
require_once '../include/init.php';

if(!$user->is_login('user_admin')){
	header('Location: login.php');
}

$user_save_data = session::exists('user_admin') ? $_SESSION['user_admin']: null;
$user_admin = $data->read('user', 'id', $user_save_data);
$user_img = $set->val('url').'content/upload/thumbs/'.$user_admin['img'];