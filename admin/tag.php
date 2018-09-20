<?php
require_once 'config/config.php';

$post = $data->read('post');
$tag = $paging->get_data('tag', 'paging_tag', 'title', input::get('s'));

if(input::get('search')){
	$s = input::get('s') ? '?s='.input::get('s'): null;
	header('Location: tag.php'.$s);
}

if(input::get('per_page')){
	$data->update('setting', array('value' => input::get('per_page')), $set->id('paging_tag'));
}

if(input::get('del')){
	$post_tag = $data->read('tag', 'id', input::get('del'));
	foreach ($post as $del_tag) {
		$del_tags = explode(',', $del_tag['tag']);
		$select_tag = array();
		foreach ($del_tags as $value_del_tags) {
			if($post_tag['name'] != $value_del_tags){
				$select_tag[] = $value_del_tags;
			}
		}
		$del_tags1 = implode(',', $select_tag);
		$data->update('post', array('tag' => $del_tags1), $del_tag['id']);
	}
	$data->delete('tag', 'id', input::get('del'));
}



require_once 'header.php';
?>
<div id="data" data-id="#tag"></div>
<title>Tags - Administrator</title>
<h3>All Tags</h3>
<form method="post" id="upload-file" class="search">
	<input type="hidden" name="search" value="1">
	<input type="text" class="form-control dib file" name="search" value="<?=input::get('s')?>" placeholder="Search">
</form>
<form method="post">
<a href="tag-new.php?type=tag" class="btn btn-default">Add New</a>
<button class="btn btn-danger" type="submit" name="del-all" value="1">Delete</button>
<p class="margin dib">
	&nbsp;Show
	<input type="number" class="form-control dib" name="per_page" value="<?=$set->val('paging_category')?>" style="width:70px">
	Items
</p>
<hr>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th class="tb-check"><input class="check check-true" type="checkbox"></th>
			<th>Name</th>
			<th class="tb-des">Description</th>
			<th class="tb-ctg">count</th>
			<th class="tb-act">Action</th>
		</tr>
	</thead>
	<tbody>
<?php
foreach ($tag as $value) {
	$c = array();
	foreach ($post as $posts) {
		$tag = explode(',', $posts['tag']);
		foreach ($tag as $tags) {
			if($tags == $value['name']){
				$c[] = $value['name'];
			}
		}	
	}
	$count = count($c);
	$count = !empty($count) ? $count: 0;

	if(input::get('del-all')){
		$post_tag1 = $data->read('tag', 'id', input::get($value['id']));
		foreach ($post as $del_tag1) {
			$del_tags1 = explode(',', $del_tag1['tag']);
			$select_tag1 = array();
			foreach ($del_tags1 as $value_del_tags1) {
				if($post_tag1['name'] != $value_del_tags1){
					$select_tag1[] = $value_del_tags1;
				}
			}
			$del_tags2 = implode(',', $select_tag1);
			$data->update('post', array('tag' => $del_tags2), $del_tag1['id']);
		}
		$data->delete('tag', 'id', input::get($value['id']));
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
					    	<dt>Name :</dt>
					      	<dd><?=$value['name']?></dd>
					      	<dt>Description :</dt>
					      	<dd><?=$value['description']?></dd>
					      	<dt>Count :</dt>
					      	<dd><?=$count?></dd>
					    </dl>
					</div>
				</div>
			</div>
		</div>
		<tr>
			<td>
				<input class="check" type="checkbox" name="<?=$value['id']?>" value="<?=$value['id']?>">
			</td>
			<td><a href="<?=$set->val('url').'tag/'.$value['slug']?>"><?=$value['name']?></a></td>
			<td class="tb-des"><?=$value['description']?></td>
			<td class="tb-ctg"><?=$count?></td>
			<td class="tb-act">
				<div class="btn-group btn-group-xs">
					<a href="tag-new.php?type=tag&edit=<?=$value['id'];?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil fa-fw"></i></a>
					<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target=".detail<?=$value['id']?>"><i class="fa fa-info fa-fw"></i></button>
					<button type="submit" class="btn btn-danger btn-xs" name="del" value="<?=$value['id']?>"><i class="fa fa-times fa-fw"></i></button>
				</div>
			</td>
		</tr>
<?php
}
$empty = empty($tag) ? '<tr><td></td><td>Empty</td><td></td><td></td><td></td></tr>': null;
echo $empty;
?>
	</tbody>
</table>
</form>
<ul class="paging pagination" style="float:right; margin:0;"><?=$paging->get_admin_paging()?></ul>
<?php require_once 'footer.php';