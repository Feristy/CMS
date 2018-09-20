<?php
require_once 'config/config.php';

$posts = $data->read('post');

if(input::get('submit')){
	$data->update('setting', array('value' => input::get('title')), $set->id('title'));
	$data->update('setting', array('value' => input::get('tagline')), $set->id('tagline'));
	$data->update('setting', array('value' => input::get('url')), $set->id('url'));
	$data->update('setting', array('value' => input::get('logo')), $set->id('logo'));
	$data->update('setting', array('value' => input::get('timezone')), $set->id('timezone'));
	$data->update('setting', array('value' => input::get('default_permalink')), $set->id('default_permalink'));
	$set->change_slug(input::get('permalink'));
	$data->update('setting', array('value' => input::get('category')), $set->id('default_category'));
	$data->update('setting', array('value' => input::get('max_post')), $set->id('max_post'));
	$data->update('setting', array('value' => input::get('max_text')), $set->id('max_text'));
	$error = $file->icon($_FILES['icon']);
	$error1 = $file->logo($_FILES['logo_img']);
	$errors = array($error, $error1);
	$errors = json_encode($errors);
	cookie::flash('notf', $errors);
	$data->update('setting', array('value' => input::get('medium')), $set->id('medium_size'));
	header('Location: setting.php');
}

require_once 'header.php';
?>
<div id="data" data-id="#setting"></div>
<title>Setting - Administrator</title>
<?php
if(!empty(cookie::view_notf('notf'))){
	foreach(cookie::view_notf('notf') as $value_notf){
		echo $value_notf;
	}
}
?>
<h3>Setting General</h3>
<hr>
<form class="col-sm-9 col-md-8" method="post" enctype="multipart/form-data">
	<div class="row">
		<h4>General</h4>
		<div class="form-group">
			<div class="col-sm-5">
				<div class="row">
					<label class="m" style="padding-top: 7px">Title</label>
				</div>
			</div>
			<div class="col-sm-7">
				<div class="row">
					<input class="form-control" type="text" name="title" value="<?=$set->val('title')?>">
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="form-group">
			<div class="col-sm-5">
				<div class="row">
					<label class="m" style="padding-top: 7px">Tagline</label>
				</div>
			</div>
			<div class="col-sm-7">
				<div class="row">
					<input class="form-control" type="text" name="tagline" value="<?=$set->val('tagline')?>">
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="form-group">
			<div class="col-sm-5">
				<div class="row">
					<label class="m" style="padding-top: 7px">Url Title</label>
				</div>
			</div>
			<div class="col-sm-7">
				<div class="row">
					<input class="form-control" type="text" name="url" value="<?=$set->val('url')?>">
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="form-group">
			<div class="col-sm-5">
				<div class="row">
					<label class="m" style="padding-top: 7px">Text Logo</label>
				</div>
			</div>
			<div class="col-sm-7">
				<div class="row">
					<input class="form-control" type="text" name="logo" value="<?=$set->val('logo')?>">
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="form-group">
			<div class="col-sm-5">
				<div class="row">
					<label class="m" style="padding-top: 7px">Timezone</label>
				</div>
			</div>
			<div class="col-sm-7">
				<div class="row">
					<select class="form-control" name="timezone" style="width:auto">
					<?php
						foreach ($timezone as $timezones) {
							echo '<option value="'.$timezones->value.'"';
							if($timezones->value == $set->val('timezone')){echo 'selected="selected"';}
							echo '>'.$timezones->text.'</option>';
						}
					?>
					</select>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<br>
		<h4>Content</h4>
		<div class="form-group">
			<div class="col-sm-5">
				<div class="row">
					<label class="m" style="padding-top: 7px">Default Slug Permalink</label>
				</div>
			</div>
			<div class="col-sm-7">
				<div class="row">
					<input type="text" class="form-control" name="default_permalink" value="<?=$set->val('default_permalink')?>">
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="form-group">
			<div class="col-sm-5">
				<div class="row">
					<label class="m" style="padding-top: 7px">Permalink</label>
				</div>
			</div>
			<div class="col-sm-7">
				<div class="row">
					<select id="permalink" class="form-control select-active" data-id="#permalink" data-class=".<?=$set->view_slug()?>" style="width:auto" name="permalink">
						<option class="slug1">slug/post-title</option>
						<option class="slug2">yyyy/mm/dd/post-title</option>
						<option class="slug3">yyyy/mm/post-title</option>
						<option class="slug4">archives/post-title</option>
						<option class="slug5">post-title</option>
					</select>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="form-group">
			<div class="col-sm-5">
				<div class="row">
					<label class="m" style="padding-top: 7px">Default Category</label>
				</div>
			</div>
			<div class="col-sm-7">
				<div class="row">
					<select id="select-ctg" class="form-control select-active1" data-id="#select-ctg" data-class=".<?=$set->val('default_category')?>" name="category" style="width:auto">
					<?php
						$ctgs = $data->read('category');
						foreach($ctgs as $ctg){echo '<option class="'.$ctg['name'].'">'.$ctg['name'].'</option>';}?>
					</select>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="form-group">
			<div class="col-sm-5">
				<div class="row">
					<label class="m" style="padding-top: 7px">Max Page</label>
				</div>
			</div>
			<div class="col-sm-7">
				<div class="row">
					<input type="number" min="1" class="form-control dib" style="width:70px" name="max_post" value="<?=$set->val('max_post')?>"> Post
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="form-group">
			<div class="col-sm-5">
				<div class="row">
					<label class="m" style="padding-top: 7px">Text Feed</label>
				</div>
			</div>
			<div class="col-sm-7">
				<div class="row">
					<select id="umpan" class="form-control dib select-active2" data-id="#umpan" data-class=".<?=$set->val('max_text')?>" style="width:auto" name="max_text">
						<option class="Text Full">Text Full</option>
						<option class="Summary">Summary</option>
					</select>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<br>
		<h4>Image</h4>
		<div class="form-group">
			<div class="col-sm-5">
				<div class="row">
					<label class="m" style="padding-top: 7px">Icon Website</label>
				</div>
			</div>
			<div class="col-sm-7">
				<div class="row">
					<div class="post-file">
						<div class="btn btn-default" href="#">Choose</div>
						<input type="file" class="file" name="icon">
					</div>
					&nbsp;<?=$set->val('icon')?>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="form-group">
			<div class="col-sm-5">
				<div class="row">
					<label class="m" style="padding-top:7px">Logo Website</label>
				</div>
			</div>
			<div class="col-sm-7">
				<div class="row">
					<div class="post-file">
						<div class="btn btn-default" href="#">Choose</div>
						<input type="file" class="file" name="logo_img">
					</div>
					&nbsp;<?=$set->val('logo_img')?>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="form-group">
			<div class="col-sm-5">
				<div class="row">
					<label class="m" style="padding-top:7px">Size Image</label>
				</div>
			</div>
			<div class="col-sm-7">
				<div class="row">
					<input type="number" class="form-control dib" name="medium" value="<?=$set->val('medium_size')?>" style="width:70px"> px
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