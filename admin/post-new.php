<?php
require_once 'config/config.php';

$tinymce = 1;
$tag_it = 1;

$id = @$_GET['edit'] ? $id = $_GET['edit']: null;
$post = $data->read('post', 'id', $id);
$ctgs = $data->read('category');
$imgs = $data->read('library');
$post_ctg = !empty($post['category']) ? $post['category']: $set->val('default_category');
$active_post = !empty($post['active']) ? $post['active']: 'Yes';
$active_cmnt = !empty($post['comment']) ? $post['comment']: 'Yes';
$notf = '';

if(cookie::exists('notf')){
	$notf = '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.cookie::flash('notf').'</div>';
}

if(input::get('save')){
	$slug = explode(' ', trim(input::get('title')));
	$slug = implode('-', $slug);

	if(input::get('tag')){
		$tags = explode(',', input::get('tag'));
		foreach ($tags as $tag) {
			$tag1 = $data->read('tag', 'name', $tag);
			if($tag1['name'] != $tag){
				$data->insert('tag', array('name' => $tag));
			}
		}
	}

	if(empty($id)){		
		$t = ''.time();
		$slug = $set->slug().$slug;
		$data->insert('post', array(
			'author' => $useradmin['id'],
			'img' => input::get('img'),
			'title' => input::get('title'),
			'content' => input::get('content'),
			'time' => $t,
			'slug' => $slug,
			'category' => input::get('category'),
			'tag' => input::get('tag'),
			'active' => input::get('status'),
			'comment' => input::get('comment')
		));
		$id_post = $data->read('post');
		foreach ($id_post as $value) {
			$id = $value['id'];
		}
		cookie::flash('notf', 'Post successfully created.');
	}else{
		$slug = $set->slug($post['time']).$slug;
		$data->update('post', array(
			'img'  => input::get('img'),
			'title'  => input::get('title'),
			'content'  => input::get('content'),
			'slug' => $slug,
			'category' => input::get('category'),
			'tag' => input::get('tag'),
			'active' => input::get('status'),
			'comment' => input::get('comment')
		), $id);
		cookie::flash('notf', 'Post updated successfully.');
	}
	header('Location: post-new.php?edit='.$id);
}

require_once 'header.php';
?>
<div id="data" data-id="#post"></div>
<title>Add New Post - Administrator</title>
<?=$notf?>
<h3>Add New Post</h3>
<a href="post-new.php" class="btn btn-default">Add New</a>
<hr>
<form method="post">
<div class="row">
	<div class="col-md-8">
		<label class="margin">Title</label>
		<input type="text" class="form-control input-lg" name="title" value="<?=$post['title']?>">
		<br>
		<label class="margin">Content</label>
		<textarea id="tinytextarea" class="form-control" rows="20" name="content"><?=$post['content']?></textarea>
		<br>
	</div>
	<div class="col-md-4">
		<label class="margin">Categories</label>
		<select id="category" class="form-control input-lg select-active2" data-id="#category" data-class=".<?=$post_ctg?>" name="category">
			<?php foreach($ctgs as $ctg){echo '<option class="'.$ctg['name'].'">'.$ctg['name'].'</option>';}?>
		</select>
		<br>
		<label class="margin">Tags</label>
		<div id="wrapper">
		    <ul id="singleFieldTags"></ul>  
			<input type="hidden" name="tag" id="mySingleField" value="<?=$post['tag']?>">  
		</div>
		<br>
		<label>Cover</label>
		<div class="modal fade image-explore" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="margin">Image</h4>
					</div>
					<div class="modal-body">
					<?php foreach ($imgs as $img) {
						echo '<img src="'.$set->val('url').'content/upload/thumbs/'.$img['name'].'" class="thumbnail dib input-gambar pointer"  data-id="'.$set->val('url').'content/upload/medium/'.$img['name'].'" data-name="'.$img['name'].'" data-dismiss="modal" aria-label="Close" style="margin:5px" alt="image">';
					}?>
					</div>
				</div>
			</div>
		</div>
		<div class="view-gambar">
		<?php if(!empty($id) && !empty($post['img'])){?>
			<img class="thumbnail img gambar" src="<?=$set->val('url')?>content/upload/medium/<?=$post['img']?>">
			<button type="button" class="btn btn-default remove-gambar">Delete Image</button>
			<button type="button" class="btn btn-default open-explore" data-toggle="modal" data-target=".image-explore" style="display:none">Choose Image</button>
		<?php }else{?>
			<img class="thumbnail img gambar" style="display: none">
			<button type="button" class="btn btn-default remove-gambar" style="display: none">Delete Image</button>
			<button type="button" class="btn btn-default open-explore" data-toggle="modal" data-target=".image-explore">Choose Image</button>
		<?php }?>
			<input class="input-img" type="hidden" name="img" value="">
		</div>
		<hr><br>
		<label class="margin" style="float:left">Active</label>
		<div class="post-act">
			<select id="status-post" class="form-control dib select-active" data-id="#status-post" data-class=".<?=$active_post?>" name="status" style="width:auto">
				<option class="Yes">Yes</option>
				<option class="No">No</option>
			</select>
		</div>
		<div class="clear"></div>
		<br>
		<label class="margin" style="float:left">Comment</label>
		<div class="post-act">
			<select id="cmnt-post" class="form-control dib select-active1" data-id="#cmnt-post" data-class=".<?=$active_cmnt?>" name="comment" style="width:auto">
				<option class="Yes">Yes</option>
				<option class="No">No</option>
			</select>
		</div>
		<div class="clear"></div>
	</div>
</div>
<button type="submit" class="btn btn-primary" name="save" value="1">Submit</button>
</form>
<?php require_once 'footer.php';?>