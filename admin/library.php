<?php
require_once 'config/config.php';

$notf = '';

if(cookie::exists('notf')){
	$notf = '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.cookie::flash('notf').'</div>';
}

if(input::get('submit_upload')){
	$error = $file->up($_FILES['upload']);
	cookie::flash('notf', $error);
}

$library = $paging->get_data('library', 'paging_library', 'title', input::get('s'));

if(input::get('search')){
	$s = input::get('s') ? '?s='.input::get('s'): null;
	header('Location: library.php'.$s);
}

if(input::get('per_page')){
	$data->update('setting', array('value' => input::get('per_page')), $set->id('paging_library '));
}

if(input::get('del')){
	$file->delete(input::get('del'));
}

if(input::get('del-all') || input::get('del') || input::get('per_page')){
	header('Location: library.php');
}

require_once 'header.php';
?>
<div id="data" data-id="#library"></div>
<title>Library - Administrator</title>
<?=$notf?>
<h3>All Library</h3>
<form method="post" id="upload-file" class="search">
	<input type="hidden" name="search" value="1">
	<input type="text" class="form-control dib file" name="s" value="<?=input::get('s')?>" placeholder="Search">
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
			<th class="tb-ctg">Type</th>
			<th class="tb-ctg">Size</th>
			<th class="tb-act">Action</th>
		</tr>
	</thead>
	<tbody>
<?php
$dir = '../content/upload/';
foreach ($library as $value) {
	$files = $dir.$value['name'];
	$type = mime_content_type($files);
	$size = $file->size(filesize($files));
	$times = time::get(filemtime($files));

	if(input::get('del-all')){
		$file->delete(input::get($value['id']));
	}
?>
		<div class="modal fade detail<?=$value['id']?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
					    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					    <h4 class="m">Detail</h4>
					</div>
					<div class="modal-body">
					    <dl class="dl-horizontal">
					    	<dt>Name :</dt>
					      	<dd><a href="<?=$files?>" target="blank"><?=$value['name']?></a></dd>
					      	<dt>Type :</dt>
					      	<dd><?=$type?></dd>
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
			<td>
				<input class="check" type="checkbox" name="<?=$value['id']?>" value="<?=$value['id']?>">
			</td>
			<td><a href="<?=$files?>" target="blank"><?=$value['name']?></a></td>
			<td class="tb-ctg"><?=$type?></td>
			<td class="tb-ctg"><?=$size?></td>
			<td class="tb-act">
				<div class="btn-group btn-group-xs">
					<a href="admin.php?p=post&act=new&edit=<?=$posts['id'];?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil fa-fw"></i></a>
					<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target=".detail<?=$value['id']?>"><i class="fa fa-info fa-fw"></i></button>
					<button type="submit" class="btn btn-danger btn-xs" name="del"><i class="fa fa-times fa-fw"></i></button>
				</div>
			</td>
		</tr>
<?php }?>
	</tbody>
</table>
</form>
<ul class="paging pagination" style="float:right; margin:0;"><?=$paging->get_admin_paging()?></ul>
<?php require_once 'footer.php';