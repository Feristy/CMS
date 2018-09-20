<?php
require_once 'config/config.php';

$id = !empty($_GET['edit']) ? $id = $_GET['edit']: null;
$users = $data->read('user', 'id', $id);
$img = $data->read('library');
$required = empty($id) ? 'required="required"': null;

if(input::get('submit')){
	if(empty($id)){
		$validation->check(array(
			'username' => array(
							'required' => true,
							'min' => 3,
							'max' => 50,
							'match_user' => ''
						),
			'fullname' => array(
							'required' => true,
							'min' => 3,
							'max' => 50,
						),
			'password' => array(
							'required' => true,
							'min' => 3
						),
			'confirm' => array(
							'required' => true,
							'match' => 'password'
						)
		));

		if($validation->passed()){
			$data->insert('user', array(
					'username' => input::get('username'),
					'password' => password_hash(input::get('password'), PASSWORD_DEFAULT),
					'fullname' => input::get('fullname'),
					'email' => input::get('email'),
				));

			$id = $data->read('user');
			foreach ($id as $value_id) {
				$id = $value_id['id'];
			}

			$notf = array('Your account was created successfully');
			$notf = json_encode($notf);
			cookie::flash('notf', $notf);
			header('Location: user-new.php?edit='.$id);
		}else{
			$error = $validation->errors();
			$error = json_encode($error);
			cookie::flash('notf', $error);
			header('Location: user-new.php');
		}
	}else{
		if(!empty(input::get('last'))){
			if($user->login($users['username'], input::get('last'))){
				$validation->check(array(
						'password' => array(
								'required' => true,
								'min' => 3
							),
						'confirm' => array(
										'required' => true,
										'match' => 'password'
									)
					));
				if($validation->passed()){
					$data->update('user', array('password' => password_hash(input::get('password'), PASSWORD_DEFAULT)), $id);
					$notf = array('Your password was updated successfully.');
					$notf = json_encode($notf);
					cookie::flash('notf', $notf);
				}
			}else{
				$error = array('Your old password is wrong.');
				$error = json_encode($error);
				cookie::flash('notf', $error);
			}
		}

		$validation->check(array(
			'username' => array(
							'required' => true,
							'min' => 3,
							'max' => 50,
							'match_user'
						),
			'fullname' => array(
							'required' => true,
							'min' => 3,
							'max' => 50,
						)
		));

		if($validation->passed()){
			$data->update('user', array(
					'username' => input::get('username'),
					'fullname' => input::get('fullname'),
					'email' => input::get('email'),
					'phone' => input::get('phone'),
					'about' => input::get('about'),
				), $id);
			$notf1 = array('Your account was updated successfully.');
			$notf1 = json_encode($notf1);
			cookie::flash('notf1', $notf1);
		}

		if(!empty($validation->errors())){
			$error1 = $validation->errors();
			$error1 = json_encode($error1);
			cookie::flash('notf2', $error1);
		}

		$files = $file->single_ico($_FILES['upload']);
		if(!empty($files)){
			$notf1 = array($files);
			$notf1 = json_encode($notf1);
			cookie::flash('notf3', $notf1);
		}

		header('Location: user-new.php?edit='.$id);
	}
}

require_once 'header.php';
?>
<div id="data" data-id="#user"></div>
<title>User - Administrator</title>
<?php
if(!empty(cookie::view_notf('notf'))){
	foreach(cookie::view_notf('notf') as $value_notf){
		echo $value_notf;
	}
}
if(!empty(cookie::view_notf('notf1'))){
	foreach(cookie::view_notf('notf1') as $value_notf1){
		echo $value_notf1;
	}
}
if(!empty(cookie::view_notf('notf2'))){
	foreach(cookie::view_notf('notf2') as $value_notf2){
		echo $value_notf2;
	}
}
if(!empty(cookie::view_notf('notf3'))){
	foreach(cookie::view_notf('notf3') as $value_notf3){
		echo $value_notf3;
	}
}
?>
<h3>Add New User</h3>
<a href="user-new.php" class="btn btn-default">Add New</a>
<hr>
<form class="col-md-8" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="form-group">
			<div class="col-md-5">
				<div class="row">
					<label class="m" style="padding-top: 7px">Username</label>
				</div>
			</div>
			<div class="col-md-7">
				<div class="row">
					<input class="form-control content" type="text" name="username" value="<?=$users['username']?>" required="required">
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="form-group">
			<div class="col-md-5">
				<div class="row">
					<label class="m" style="padding-top: 7px">Fullname</label>
				</div>
			</div>
			<div class="col-md-7">
				<div class="row">
					<input class="form-control content" type="text" name="fullname" value="<?=$users['fullname']?>" required="required">
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="form-group">
			<div class="col-md-5">
				<div class="row">
					<label class="m" style="padding-top: 7px">Email</label>
				</div>
			</div>
			<div class="col-md-7">
				<div class="row">
					<input class="form-control content" type="email" name="email" value="<?=$users['email']?>" required="required">
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<?php if(!empty($id)){?>
		<div class="form-group">
			<div class="col-md-5">
				<div class="row">
					<label class="m" style="padding-top: 7px">Phone</label>
				</div>
			</div>
			<div class="col-md-7">
				<div class="row">
					<input class="form-control content" type="number" name="phone" value="<?=$users['phone']?>">
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="form-group">
			<div class="col-md-5">
				<div class="row">
					<label class="m" style="padding-top: 7px">About</label>
				</div>
			</div>
			<div class="col-md-7">
				<div class="row">
					<textarea class="form-control content" name="about" rows="3" style="resize:vertical;"><?=$users['about']?></textarea>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="form-group">
			<div class="col-md-5">
				<div class="row">
					<label class="m" style="padding-top: 7px">User Image</label>
				</div>
			</div>
			<div class="col-md-7">
				<div class="row">
					<div class="post-file">
						<div class="btn btn-default" href="#">Choose Image</div>
						<input id="input-1" type="file" name="upload">
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<br><br>
		<h4>Change Password</h4>
		<br>
		<div class="form-group">
			<div class="col-md-5">
				<div class="row">
					<label class="m" style="padding-top: 7px">Last Password</label>
				</div>
			</div>
			<div class="col-md-7">
				<div class="row">
					<input class="form-control content" type="password" name="last">
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<?php }?>
		<div class="form-group">
			<div class="col-md-5">
				<div class="row">
					<label class="m" style="padding-top: 7px">Password</label>
				</div>
			</div>
			<div class="col-md-7">
				<div class="row">
					<input class="form-control content" type="password" name="password" <?=$required?>>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="form-group">
			<div class="col-md-5">
				<div class="row">
					<label class="m" style="padding-top: 7px">Confirm Password</label>
				</div>
			</div>
			<div class="col-md-7">
				<div class="row">
					<input class="form-control content" type="password" name="confirm" <?=$required?>>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<br>
		<button class="btn btn-primary" type="submit" name="submit" value="1">Submit</button>
	</div>
</form>
<div class="clear"></div>
<?php require_once 'footer.php';