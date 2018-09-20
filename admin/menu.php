<?php
require_once 'config/config.php';

$sortable = 1;

//CRUD menu group
$notf = '';
$menu_group = $data->read('menu_group');
$edit_group = $data->balik('menu_group', 'id');
foreach ($edit_group as $edit_groups) {
	$edit_group = $edit_groups;
}

$edit_group = input::get('edit') ? $data->read('menu_group', 'id', input::get('edit')): $edit_group;

if(cookie::exists('notf')){
	$notf = '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.cookie::flash('notf').'</div>';
}

if(input::get('group')){
	header('Location: menu.php?edit='.input::get('group'));
}

if(input::get('new-group')){
	if(!$user->is_data('menu_group', 'name', input::get('name'))){
		$data->insert('menu_group', array('name' => input::get('name')));
		cookie::flash('notf', 'Group menu Successfully created.');
		$new_menu_group = $data->read('menu_group', 'name', input::get('name'));
		header('Location: menu.php?edit='.$new_menu_group['id']);
	}else{
		cookie::flash('notf', 'The group menu already exists.');
		header('Location: menu.php');
	}
}

if(input::get('edit-group')){
	if(!$user->is_data('menu_group', 'name', input::get('edit-name'))){
		$data->update('menu_group', array('name' => input::get('edit-name')), $edit_group['id']);
		cookie::flash('notf', 'Group menu Successfully updated.');
		header('Location: menu.php?edit='.$edit_group['id']);
	}elseif(input::get('edit-name') == $edit_group['name']){
		header('Location: menu.php?edit='.$edit_group['id']);
	}else{
		cookie::flash('notf', 'The group menu already exists.');
		header('Location: menu.php?edit='.$edit_group['id']);
	}
}

if(input::get('del-group')){
	$data->delete('menu_group', 'id', input::get('del-group'));
	cookie::flash('notf', 'The group menu was deleted successfully.');
	header('Location: menu.php');
}

//CRUD menu
if(input::get('new')){
	$position = $data->ubah('menu', 'position');
	foreach ($position as $positions) {
		if($edit_group['id'] == $positions['group_id']){
			$position = $positions['position'];
		}else{
			$position = 0;
		}
	}
	$position = !empty($position) ? $position++: 1;
	$position = $position.'';
	$data->insert('menu', array(
			'name' => input::get('new-menu'),
			'url'	=> input::get('new-url'),
			'position' => $position,
			'group_id' => $edit_group['id']
		));
}

if(input::get('up')){
	$menu_position = explode(',', input::get('position'));
	$li1 = 0;
	for ($li=1; $li <= count($menu_position); $li++) { 
		$data->update('menu', array('position' => $li), $menu_position[$li1]);
		$li1++;
	}
}

if(input::get('save')){
	$data->update('menu', array(
			'name' => input::get('edit-menu'),
			'url'	=> input::get('url')
		), input::get('save'));
}

if(input::get('del')){
	$data->delete('menu', 'id', input::get('del'));
}

if(input::get('new') || input::get('up') || input::get('save') || input::get('del')){
	header('Location: menu.php?edit='.$edit_group['id']);
}



require_once 'header.php';
?>
<div id="data" data-id="#tampilan"></div>
<title>Menu - Administrator</title>
<?=$notf?>
<h3>Menu</h3>
<hr>
<div class="modal fade new-group" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="mySmallModalLabel">New Menu Group</h4>
			</div>
			<div class="modal-body">
			<form method="post">
				<div class="form-group">
					<input class="form-control" type="text" name="name" required="required" placeholder="Name">
				</div>
				<button class="btn btn-primary" type="submit" name="new-group" value="1">Create</button>
			</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade edit-group" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="mySmallModalLabel">Edit Menu Group</h4>
			</div>
			<div class="modal-body">
			<form method="post">
				<div class="form-group">
					<input class="form-control" type="text" name="edit-name" value="<?=$edit_group['name']?>" required="required" placeholder="Name Menu Group">
				</div>
				<button class="btn btn-primary" type="submit" name="edit-group" value="1">Save</button>
			</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade edit-menu" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog modal-sm">
	    <div class="modal-content">
	    	<div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="mySmallModalLabel">Edit Menu</h4>
			</div>
			<div class="modal-body">
				<form method="post">
					<div class="form-group">
						<input class="edit-menu-title form-control" type="text" name="edit-menu" placeholder="Title">
					</div>
					<div class="form-group">
						<input class="edit-menu-url form-control" type="text" name="url" placeholder="Url">
					</div>
					<button class="btn btn-primary edit-menu-id" type="submit" name="save">Save</button>
				</form>
			</div>
	    </div>
	</div>
</div>
<div class="row">
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading">Structure</div>
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
						<ul class="menu_drop_targets p menu-list list-unstyled">
<?php
$menu = $data->ubah('menu', 'position');
foreach ($menu as $menus) {
	if($edit_group['id'] == $menus['group_id']){
?>		
							<li class="btn btn-default btn-lg btn-block" data-id="<?=$menus['id']?>">
								<span><?=$menus['name']?></span>
								<div class="set-position btn-group btn-group-xs">
									<button type="button" class="btn btn-default btn-xs btn-edit" data-toggle="modal" data-target=".edit-menu" data-id="<?=$menus['id']?>" data-title="<?=$menus['name']?>" data-url="<?=$menus['url']?>"><i class="fa fa-pencil"></i></button>
									<button type="submit" class="btn btn-default btn-xs" name="del" value="<?=$menus['id']?>"><i class="fa fa-times"></i></button>
								</div>
							</li>
<?php }}?>
							<input type="hidden" id="input_position" name="position">
						</ul>
					</div>
					<button class="btn btn-primary" name="up" value="up">Update Menu</button>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">Menu Group</div>
			<div class="panel-body">
				<form id="select-grup" method="post">
				<div class="form-group">
					<select id="submit-grup" class="form-control select-active" data-id="#submit-grup" data-class=".<?=$edit_group['id']?>" name="group">
						<?php foreach ($menu_group as $menu_groups) {?>
						<option class="<?=$menu_groups['id']?>" value="<?=$menu_groups['id']?>"><?=$menu_groups['name']?></option>
							<?php }?>
					</select>
				</div>
				<button type="button" class="btn btn-warning" data-toggle="modal" data-target=".new-group">New</button>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".edit-group">Edit</button>
				<button type="submit" class="btn btn-danger" name="del-group" value="<?=$edit_group['id']?>">Delete</button>
				</form>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">Add New Menu</div>
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
						<input class="form-control" type="text" name="new-menu" placeholder="Title">
					</div>
					<div class="form-group">
						<input class="form-control" type="text" name="new-url" placeholder="Url">
					</div>
					<button type="submit" class="btn btn-primary" name="new" value="1">Add Menu</button>
				</form>
			</div>
		</div>
	</div>
</div>
<?php require_once 'footer.php';