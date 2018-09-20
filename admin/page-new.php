<?php
require_once 'config/config.php';

$tinymce = 1;

$id = @$_GET['edit'] ? $id = $_GET['edit']: null;
$page = $data->read('page', 'id', $id);
$active_page = !empty($page['active']) ? $page['active']: 'Yes';
$imgs = $data->read('library');

if(input::get('submit')){
	$slug = explode(' ', trim(input::get('title')));
	$slug = implode('-', $slug);
	
	if(empty($id)){
		$t = ''.time();
		$data->insert('page', array(
				'img' => input::get('img'),
				'title' => input::get('title'),
				'content' => input::get('content'),
				'slug' => $slug,
				'time' => $t,
				'active' => input::get('status')
			));

		$id = $data->read('page');
		foreach ($id as $value) {
			$id = $value['id'];
		}

		cookie::flash('notf', $eng['page'].' successfully created.');
	}else{
		$data->update('page', array(
				'img' => input::get('img'),
				'title' => input::get('title'),
				'content' => input::get('content'),
				'slug' => $slug,
				'active' => input::get('status')
			), $id);
		cookie::flash('notf', $eng['page'].' updated successfully.');
	}
	header('Location: page-new.php?edit='.$id);
}

require_once 'header.php';
?>
<div id="data" data-id="#page">
<title>Page - Administrator</title>
<h3>All Page</h3>
<a href="page-new.php" class="btn btn-default">Add New</a>
<hr>
<form method="post">
	<div class="row">
		<div class="col-md-8">
			<label class="margin">Title</label>
			<input type="text" class="form-control input-lg" name="title" value="<?=$page['title']?>">
			<br>
			<label class="margin">Content</label>
			<textarea id="tinytextarea" class="form-control" rows="20" name="content"><?=$page['content']?></textarea>
			<br>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
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
			<?php if(!empty($id) && !empty($page['img'])){?>
				<img class="thumbnail img gambar" src="<?=$set->val('url')?>content/upload/medium/<?=$page['img']?>">
				<button type="button" class="btn btn-default remove-gambar">Delete Image</button>
				<button type="button" class="btn btn-default open-explore" data-toggle="modal" data-target=".image-explore" style="display:none">Choose Image</button>
			<?php }else{?>
				<img class="thumbnail img gambar" style="display: none">
				<button type="button" class="btn btn-default remove-gambar" style="display: none">Delete Image</button>
				<button type="button" class="btn btn-default open-explore" data-toggle="modal" data-target=".image-explore">Choose Image</button>
			<?php }?>
				<input class="input-img" type="hidden" name="img">
			</div>
			<br>
			<label class="margin" style="float:left">Active</label>
			<div class="post-act">
				<select id="status-post" class="form-control dib select-active" data-id="#status-post" data-class=".<?=$active_page?>" name="status" style="width:auto">
					<option class="Yes">Yes</option>
					<option class="No">No</option>
				</select>
			</div>
			<div class="clear"></div>
			<br><br>
		</div>
	</div>
	<button type="submit" class="btn btn-primary" name="submit" value="1">Submit</button>
</form>
<?php require_once 'footer.php';