<?php
require_once '../include/init.php';

$error = null;

if($user->is_login('user_admin')){
	header('Location: index.php');
}

if(input::get('submit')){
	if($user->is_data('user', 'username', input::get('username'))){
		if($user->login(input::get('username'), input::get('password'))){
			$id = $data->read('user', 'username', input::get('username'));
			session::set('user_admin', $id['id']);
			cookie::flash('ok', 'berhasil');
			header('Location: '.$set->val('url').'admin/');
		}else{
			$error = 'Login failed';
		}
	}else{
		$error = 'Username not listed';
	}
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<link rel="stylesheet" href="../include/plugins/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="../include/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style_login.css">
	</head>
	<body>
		<form method="post" class="wrapper-login" style="max-width: 270px;">
			<?php if(!empty($error)){ ?>
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<?=$error?>
			</div>
			<?php } ?>
			<div class="login">
				<h4>Administrator Login</h4>
				<div class="form-group">
					<input class="form-control" type="text" name="username" required="required" placeholder="Username">
				</div>
				<div class="form-group">
					<input class="form-control" type="password" name="password" required="required" placeholder="password">
				</div>
				<button class="btn btn-default btn-block" type="submit" name="submit" value="1">Sign in</button>
			</div>
		</form>
		<script src="../include/plugins/jquery/jquery.js" type="text/javascript"></script>
		<script src="../include/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/admin.js" type="text/javascript"></script>
	</body>
</html>