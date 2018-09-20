<?php
require_once 'config/config.php';

if(input::get('submit_upload')){
	$path = '../content/themes/';
	$files = $_FILES['upload'];
	$file_upload = $path.$files['name'];
	$file_ext = pathinfo($files['name'], PATHINFO_EXTENSION);
	if($file_ext == 'zip'){
		move_uploaded_file($files['tmp_name'], $file_upload);
	}
	$zip = new ZipArchive;
	$zip->open($path.$files['name']);
	$zip->extractTo($path);
    $zip->close();
    $file_name = substr($files['name'], 0, -4);
    $data->insert('theme', array('name' => $file_name));
    unlink($path.$files['name']);
}

if(input::get('active')){
	$data->update('setting', array('value' => input::get('active')), $set->id('theme'));
}

$path = '../content/themes/';
$active_theme = $path.$set->val('theme').'/screenshot.jpg';
$theme = $paging->get_data('theme', 'paging_theme', 'name', input::get('s'));

if(input::get('search')){
	$s = input::get('s') ? '?s='.input::get('s'): null;
	header('Location: theme.php'.$s);
}

if(input::get('del')){
	$del_theme = $data->read('theme', 'id', input::get('del'));
	$del_files = opendir($path.$del_theme['name'].'/');
	while($del_file = readdir($del_files)){
		if($del_file != '.' && $del_file != '..'){
			unlink($path.$del_theme['name'].'/'.$del_file);
		}
	}
	rmdir($path.$del_theme['name']);
	$data->delete('theme', 'id', input::get('del'));
}

if(input::get('per_page')){
	$data->update('setting', array('value' => input::get('per_page')), $set->id('paging_theme'));
}

if(input::get('del-all') || input::get('del') || input::get('per_page')){
	header('Location: theme.php');
}

require_once 'header.php';
?>
<div id="data" data-id="#tampilan"></div>
<title>Theme - Administrator</title>
<h3>All Themes</h3>
<form method="post" id="upload-file" class="search">
	<input type="hidden" name="search" value="1">
	<input type="text" class="form-control dib file" name="s" value="<?=input::get('s')?>" placeholder="Search">
</form>
<form class="upload" id="upload-file1" method="post" enctype="multipart/form-data">
	<div class="post-file">
		<div class="btn btn-default" href="#">Add New</div>
		<input type="hidden" name="submit_upload" value="1">
		<input id="input-1" type="file" class="file1" name="upload">
	</div>
</form>
<form method="post">
<p class="margin dib">
	&nbsp;Show
	<input type="number" class="form-control dib" name="per_page" value="<?=$set->val('paging_post')?>" style="width:70px">
	Items
</p>
<hr>
<div class="row">
<?php if(!empty($set->val('theme'))){?>
	<div class="col-md-3" style="position:relative;margin:15px 0">
		<img src="<?=$active_theme?>" class="img img-thumbnail">
		<div class="thm-detail">
			<div class="thm-name"><?=$set->val('theme')?></div>
			<a href="customize.php" class="btn btn-default btn-sm" style="float:right">Customize</a>
		</div>
	</div>
<?php
}
foreach ($theme as $themes) {
	if($set->val('theme') != $themes['name']){
		$op_theme = $path.$themes['name'].'/screenshot.jpg';
?>
	<div class="col-md-3" style="position:relative;margin:15px 0">
		<img src="<?=$op_theme?>" class="img img-thumbnail">
		<div class="thm-detail">
			<div class="thm-name"><?=$themes['name']?></div>
			<button type="submit" class="btn btn-default btn-sm" name="del" value="<?=$themes['id']?>">Delete</button>
			<button type="submit" class="btn btn-default btn-sm" name="active" value="<?=$themes['name']?>">Active</button>
		</div>
	</div>
<?php
	}
}
?>
</form>
</div>
<?php require_once 'footer.php';