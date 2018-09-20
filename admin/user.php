<?php
require_once 'config/config.php';

$user = $paging->get_data('user', 'paging_user', 'title', input::get('s'));

if(input::get('search')){
	$s = input::get('s') ? '?s='.input::get('s'): null;
	header('Location: user.php'.$s);
}

if(input::get('del')){
	$data->delete('user', 'id', input::get('del'));
}

if(input::get('per_page')){
	$data->update('setting', array('value' => input::get('per_page')), $set->id('paging_user'));
}

if(input::get('del-all') || input::get('del') || input::get('per_page')){
	header('Location: user.php');
}

require_once 'header.php';
?>
<div id="data" data-id="#user"></div>
<title>User - Administrator</title>
<h3>All User</h3>
<form method="post" id="upload-file" class="search">
	<input type="hidden" name="search" value="1">
	<input type="text" class="form-control dib file" name="s" value="<?=input::get('s')?>" placeholder="Search">
</form>
<form method="post">
<a href="" class="btn btn-default">Add New</a>
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
			<th>Username</th>
			<th class="tb-des">Fullname</th>
			<th class="tb-ctg">Lavel</th>
			<th class="tb-act">Action</th>
		</tr>
	</thead>
	<tbody>
<?php
foreach ($user as $value) {
	$lavel = $value['role'] == 1 ? 'disabled="disabled"': null;
	$lavel1 = $value['role'] == 1 ? 'Administrator': 'Member';
	if(input::get('del-all')){
	$data->delete('user', 'id', input::get($value['id']));
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
					    	<dt>Username :</dt>
					      	<dd><?=$value['username']?></dd>
					      	<dt>Fullname :</dt>
					      	<dd><?=$value['fullname']?></dd>
					      	<dt>email :</dt>
					      	<dd><?=$value['email']?></dd>
					      	<dt>Phone :</dt>
					      	<dd><?=$value['phone']?></dd>
					      	<dt>About :</dt>
					      	<dd><?=$value['about']?></dd>
					      	<dt>Role :</dt>
					      	<dd><?=$lavel1?></dd>
					    </dl>
					</div>
				</div>
			</div>
		</div>
		<tr>
			<td>
				<input class="check" type="checkbox" <?=$lavel?> name="<?=$value['id']?>" value="<?=$value['id']?>">
			</td>
			<td><?=$value['username']?></td>
			<td class="tb-des"><?=$value['fullname']?></td>
			<td class="tb-ctg"><?=$lavel1?></td>
			<td class="tb-act">
				<div class="btn-group btn-group-xs">
					<a href="user-new.php?edit=<?=$value['id'];?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil fa-fw"></i></a>
					<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target=".detail<?=$value['id']?>"><i class="fa fa-info fa-fw"></i></button>
					<button type="submit" class="btn btn-danger btn-xs" <?=$lavel?> name="submit" value="<?=$value['id'];?>">
						<i class="fa fa-times fa-fw"></i>
					</button>
				</div>
			</td>
		</tr>
<?php
}
$empty = empty($user) ? '<tr><td></td><td>Empty</td><td></td><td></td><td></td></tr>': null;
echo $empty;
?>
	</tbody>
</table>
</form>
<ul class="paging pagination" style="float:right; margin:0;"><?=$paging->get_admin_paging()?></ul>
<?php require_once 'footer.php';