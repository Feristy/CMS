<?php
require_once 'config/config.php';

$page = $paging->get_data('page', 'paging_page', 'title', input::get('s'));

if(input::get('search')){
	$s = input::get('s') ? '?s='.input::get('s'): null;
	header('Location: page.php'.$s);
}

if(input::get('per_page')){
	$data->update('setting', array('value' => input::get('per_page')), $set->id('paging_page'));
}

if(input::get('del')){
	$data->delete('page', 'id', input::get('del'));
}

if(input::get('del-all') || input::get('del') || input::get('per_page')){
	header('Location: page.php');
}

require_once 'header.php';
?>
<div id="data" data-id="#page">
<title>Page - Administrator</title>
<h3>All Page</h3>
<form method="post" id="upload-file" class="search">
	<input type="hidden" name="search" value="1">
	<input type="text" class="form-control dib file" name="s" value="<?=input::get('s')?>" placeholder="Search">
</form>
<form method="post">
<a href="page-new.php" class="btn btn-default">Add New</a>
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
			<th>Title</th>
			<th class="tb-act">Action</th>
		</tr>
	</thead>
	<tbody>
<?php

foreach ($page as $value) {
	$times = time::get($value['time']);
	if(input::get('del-all')){
		$data->delete('post', 'id', input::get($value['id']));
	}
?>
		<div class="modal fade detail<?=$value['id']?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
					    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					    <h4 class="m">Detail</h4>
					</div>
					<div class="modal-body">
					    <dl class="dl-horizontal">
					    	<dt>Title :</dt>
					      	<dd><?=$value['title']?></dd>
					      	<dt>Slug :</dt>
					      	<dd><a href="<?=$set->val('url').$value['slug']?>"><i><?=$set->val('url').$value['slug']?></i></a></dd>
					      	<dt>Post Date :</dt>
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
			<td><a href="<?=$set->val('url').$value['slug']?>"><?=$value['title']?></a></td>
			<td class="tb-act">
				<div class="btn-group btn-group-xs">
					<a href="post-new.php?edit=<?=$value['id'];?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil fa-fw"></i></a>
					<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target=".detail<?=$value['id']?>"><i class="fa fa-info fa-fw"></i></button>
					<button type="submit" class="btn btn-danger btn-xs" name="del" value="<?=$value['id']?>"><i class="fa fa-times fa-fw"></i></button>
				</div>
			</td>
		</tr>
<?php
}
$empty = empty($page) ? '<tr><td></td><td>Empty</td><td></td></tr>': null;
echo $empty;
?>
	</tbody>
</table>
</form>
<ul class="paging pagination" style="float:right; margin:0;"><?=$paging->get_admin_paging()?></ul>
<?php require_once 'footer.php';