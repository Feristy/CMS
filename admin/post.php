<?php
require_once 'config/config.php';

$comment = $data->read('comment');
$post = $paging->get_data('post', 'paging_post', 'title', input::get('s'));

if(input::get('search')){
	$s = input::get('s') ? '?s='.input::get('s'): null;
	header('Location: post.php'.$s);
}

if(input::get('del')){
	$data->delete('post', 'id', input::get('del'));
}

if(input::get('per_page')){
	$data->update('setting', array('value' => input::get('per_page')), $set->id('paging_post'));
}

if(input::get('del-all') || input::get('del') || input::get('per_page')){
	header('Location: post.php');
}

require_once 'header.php';
?>
<div id="data" data-id="#post"></div>
<title>Post - Administrator</title>
<h3>All Post</h3>
<form method="post" id="upload-file" class="search">
	<input type="hidden" name="search" value="1">
	<input type="text" class="form-control dib file" name="s" value="<?=input::get('s')?>" placeholder="Search">
</form>
<form method="post">
<a href="post-new.php" class="btn btn-default">Add New</a>
<button class="btn btn-danger" type="submit" name="del-all" value="1">Delete</button>
<p class="margin dib set-page">
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
			<th class="tb-ctg">Author</th>
			<th class="tb-ctg">Categories</th>
			<th class="tb-act">Action</th>
		</tr>
	</thead>
	<tbody>
<?php

foreach ($post as $value) {
	$tag = implode(', ', explode(',', $value['tag']));
	$author = $data->read('user', 'id', $value['author']);
	$times = time::get($value['time']);
	$cmnt_count = array();
	foreach ($comment as $comments) {
		if($value['id'] == $comments['post_id']){
			$cmnt_count[] = $comments['id'];
		}
	}
	$cmnt_count = !empty($cmnt_count) ? count($cmnt_count): 0;
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
					      	<dt>Author :</dt>
					      	<dd><?=$author['username']?></dd>
					      	<dt>Categories :</dt>
					      	<dd><?=$value['category']?></dd>
					      	<dt>Tags :</dt>
					      	<dd><?=$tag?></dd>
					      	<dt>Comment :</dt>
					      	<dd><?=$cmnt_count?></dd>
					      	<dt>Post Date :</dt>
					      	<dd><?=$times?></dd>
					    </dl>
					</div>
				</div>
			</div>
		</div>
		<tr>
			<td><input class="check" type="checkbox" name="<?=$value['id']?>" value="<?=$value['id']?>"></td>
			<td>
				<a href="<?=$set->val('url').$value['slug']?>"><?=$value['title']?></a>
				<div class="tb-act1 btn-group btn-group-xs">
					<a href="post-new.php?edit=<?=$value['id'];?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil fa-fw"></i></a>
					<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target=".detail<?=$value['id']?>"><i class="fa fa-info fa-fw"></i></button>
					<button type="submit" class="btn btn-danger btn-xs" name="del" value="<?=$value['id']?>"><i class="fa fa-times fa-fw"></i></button>
				</div>
			</td>
			<td class="tb-ctg"><?=$author['username']?></td>
			<td class="tb-ctg"><?=$value['category']?></td>
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
$empty = empty($post) ? '<tr><td></td><td>Empty</td><td></td><td></td><td></td><td></td><td></td></tr>': null;
echo $empty;
?>
	</tbody>
</table>
</form>
<ul class="paging pagination" style="float:right; margin:0;"><?=$paging->get_admin_paging()?></ul>
<?php require_once 'footer.php';