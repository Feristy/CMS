<?php
require_once 'config/config.php';

$comment = $paging->get_data('comment', 'paging_comment', 'title', input::get('s'));

if(input::get('search')){
	$s = input::get('s') ? '?s='.input::get('s'): null;
	header('Location: page.php'.$s);
}

if(input::get('per_page')){
	$data->update('setting', array('value' => input::get('per_page')), $set->id('paging_comment'));
}

if(input::get('del')){
	$data->delete('comment', 'id', input::get('del'));
}

if(input::get('del-all') || input::get('del') || input::get('per_page')){
	header('Location: comment.php');
}

require_once 'header.php';
?>
<div id="data" data-id="#comment"></div>
<title>Comment - Administrator</title>
<h3>All Comments</h3>
<form method="post" id="upload-file" class="search">
	<input type="hidden" name="search" value="1">
	<input type="text" class="form-control dib file" name="s" value="<?=input::get('s')?>" placeholder="Search">
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
			<th>Author</th>
			<th class="tb-des">Comment</th>
			<th class="tb-act-cmnt">Action</th>
		</tr>
	</thead>
	<tbody>
<?php
foreach ($comment as $value) {
	$post = $data->read('post', 'id', $value['post_id']);
	$grav_url = 'https://www.gravatar.com/avatar/';
	$user_img = $grav_url.md5( strtolower( trim($value['email']) ).'.jpg' );
	if(input::get('del-all')){
		$data->delete('comment', 'id', input::get($value['id']));
	}
?>
		<tr>
			<td><input class="check" type="checkbox" name="<?=$value['id']?>" value="<?=$value['id']?>"></td>
			<td>
				<div class="media">
				  <div class="media-left"><img class="media-object" src="<?=$user_img?>"></div>
				  <div class="media-body">
				    <p><?=$value['username']?></p>
				    <div class="comment-address">
				    	<a href="mailto:<?=$value['email']?>"><?=$value['email']?></a>
				    	<?php if(!empty($value['website'])){echo '&nbsp;-&nbsp;';}?>
					    <a href="<?=$value['website']?>"><?=$value['website']?></a>
					</div>
					<div class="post-respons">
						Post : <a href="<?=$set->val('url').$value['slug']?>"><?=$post['title']?></a>
					</div>
					<div class="content-comment">
						Comment : <?=$value['content']?>
					</div>
				  </div>
				</div>
			<td class="tb-des"><?=$value['content']?></td>
			<td class="tb-act-cmnt">
				<button type="submit" class="btn btn-danger btn-xs" name="del" value="<?=$value['id']?>"><i class="fa fa-times fa-fw"></i></button>
			</td>
		</tr>
<?php }?>
	</tbody>
</table>
</form>
<?php require_once 'footer.php';