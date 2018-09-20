<?php
require_once 'config/config.php';

switch(input::get('type')){
	case 'category':
			$data_id = 'category';
			$title = 'Add New Category';
		break;
	case 'tag':
			$data_id = 'tag';
			$title = 'ad New Tag';
		break;
	default: header('Location: '.$set->val('url').'admin'); break;
}

$id = @$_GET['edit'] ? $data->read($data_id, 'id', $_GET['edit']): null;
$notf = '';

if(cookie::exists('notf')){
	$notf = '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.cookie::flash('notf').'</div>';
}

if(input::get('submit')){
	if(empty($id)){
		if(!$user->is_data($data_id, 'name', input::get('name'))){
			$slug = explode(' ', trim(input::get('name')));
			$slug = implode('-', $slug);
			$data->insert($data_id, array(
					'name' => input::get('name'),
					'description' => input::get('description'),
					'slug' => $slug
				));

			$id_tag = $data->read($data_id);
			foreach ($id_tag as $value) {
				$id = $value['id'];
			}
			cookie::flash('notf', $data_id.' berhasil dibuat.');
		}else{
			cookie::flash('notf', 'The registered name failed to create.');
			header('Location: tag-new.php?type='.$data_id);
		}
	}else{
		$slug = explode(' ', trim(input::get('name')));
		$slug = implode('-', $slug);
		$data->update($data_id, array(
				'name' => input::get('name'),
				'description' => input::get('description'),
				'slug' => $slug
			), $id);
		cookie::flash('notf', $data_id.' updateed successfully.');
	}
	header('Location: tag-new.php?type='.$data_id.'&edit='.$id);
}

require_once 'header.php';
?>
<div id="data" data-id="#<?=$data_id?>"></div>
<title><?=$title?> - Administrator</title>
<?=$notf?>
<h3><?=$title?></h3>
<a href="tag-new.php?type=<?=$data_id?>" class="btn btn-default">Add New</a>
<hr>
<form method="post" class="col-md-8">
	<div class="row">
		<div class="form-group">
			<label class="margin">Name</label>
			<input type="text" class="form-control input-lg" name="name" value="<?=$id['name']?>">
		</div>
		<div class="form-group">
			<label class="margin">Description</label>
			<textarea class="form-control" name="description" rows="8"><?=$id['description']?></textarea>
		</div>
		<button type="submit" class="btn btn-primary" name="submit" value="1">Submit</button>
	</div>
</form>
<?php require_once 'footer.php';