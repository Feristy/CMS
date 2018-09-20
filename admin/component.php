<?php
require_once 'config/config.php';

if(input::get('submit_upload')){
	$files = $_FILES['upload'];
	foreach ($files['error'] as $key => $value) {
		if ($value == UPLOAD_ERR_OK) {
			$file_upload = '../content/component/'.$files['name'][$key];
			move_uploaded_file($files['tmp_name'][$key], $file_upload);
			$data->insert('component', array('name' => $files['name'][$key]));
		}
	}
}

$path = '../content/component/';
$component = $paging->get_data('component', 'paging_component', 'name', input::get('s'));

if(input::get('search')){
	$s = input::get('s') ? '?s='.input::get('s'): null;
	header('Location: component.php'.$s);
}

if(input::get('del')){
	$del = $data->read('component', 'id', input::get('del'));
	unlink($path.$del['name']);
	$data->delete('component', 'id', input::get('del'));
}

if(input::get('per_page')){
	$data->update('setting', array('value' => input::get('per_page')), $set->id('paging_component'));
}

if(input::get('del-all') || input::get('del') || input::get('per_page')){
	header('Location: component.php');
}

require_once 'header.php';
?>
<div id="data" data-id="#tampilan"></div>
<title>Component - Administrator</title>
<h3>Component</h3>
<form method="post" id="upload-file" class="search">
	<input type="hidden" name="search" value="1">
	<input type="text" class="form-control dib file" name="s" value="<?=input::get('s')?>" placeholder="Component">
</form>
<form class="upload" id="upload-file1" method="post" enctype="multipart/form-data">
	<div class="post-file">
		<div class="btn btn-default" href="#">Add New</div>
		<input type="hidden" name="submit_upload" value="1">
		<input id="input-1" type="file" class="file1" name="upload[]" multiple accept>
	</div>
</form>
<form method="post">
<button class="btn btn-danger" type="submit" name="del-all" value="1">Delete</button>
<p class="margin dib">
	&nbsp;Show
	<input type="number" class="form-control dib" name="per_page" value="<?=$set->val('paging_post')?>" style="width:70px">
	Items
</p>
<hr>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th class="tb-check"><input class="check check-true" type="checkbox"></th>
			<th>Name</th>
			<th class="tb-ctg">Size</th>
			<th class="tb-ctg">Data Modified</th>
			<th class="tb-act">Action</th>
		</tr>
	</thead>
	<tbody>
<?php
foreach ($component as $components) {
	$files = $path.$components['name'];
	$size = $file->size(filesize($files));
	$times = time::get(filemtime($files));

	if(input::get('del-all')){
		$del1 = $data->read('component', 'id', input::get($components['id']));
		unlink($path.$del1['name']);
		$data->delete('component', 'id', input::get($components['id']));
	}
?>
		<div class="modal fade detail<?=$components['id']?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
					    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					    <h4 class="m">Detail</h4>
					</div>
					<div class="modal-body">
					    <dl class="dl-horizontal">
					    	<dt>Name :</dt>
					      	<dd><?=$components['name']?></dd>
					      	<dt>Size :</dt>
					      	<dd><?=$size?></dd>
					      	<dt>Data Modified :</dt>
					      	<dd><?=$times?></dd>
					    </dl>
					</div>
				</div>
			</div>
		</div>
		<tr>
			<td><input class="check" type="checkbox" name="<?=$components['id']?>" value="<?=$components['id']?>"></td>
			<td><?=$components['name']?></td>
			<td class="tb-ctg"><?=$size?></td>
			<td class="tb-ctg"><?=$times?></td>
			<td class="tb-act">
				<div class="btn-group btn-group-xs">
					<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target=".detail<?=$components['id']?>"><i class="fa fa-info fa-fw"></i></button>
					<button type="submit" class="btn btn-danger btn-xs" name="submit" value="<?=$components['id']?>"><i class="fa fa-times fa-fw"></i></i></button>
				</div>
			</td>
		</tr>
<?php
}

$empty = empty($component) ? '<tr><td></td><td>Empty</td><td></td><td></td><td></td></tr>': null;
echo $empty;
?>
	</tbody>
</table>
</form>
<ul class="paging pagination" style="float:right; margin:0;"><?=$paging->get_admin_paging()?></ul>
<?php require_once 'footer.php';