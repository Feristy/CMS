<?php
require_once 'config/config.php';

$codemirror = 1;

$path = '../content/themes/'.$set->val('theme');
$path_theme = opendir($path);
$allowed_extensions = array('php','css','js','html');
$edit_file = input::get('edit') ? input::get('edit'): 'index.php';

if(input::get('submit')){
	header('Location: customize.php?edit='.input::get('theme'));
}

if(input::get('save')){
	file_put_contents($path.'/'.$edit_file, input::get('content'));
	header('Location: customize.php?edit='.$edit_file);
}

function select_file($path, $edit_file){
	$allowed_extensions = array('php', 'css', 'js', 'html', 'htm');
	while($file_theme = readdir($path)){
		$extension = pathinfo($file_theme, PATHINFO_EXTENSION);
		if(in_array($extension, $allowed_extensions)){
			echo '<option';
			if($edit_file == $file_theme){
				echo ' selected';
			}
			echo ' >'.$file_theme.'</option>';
		}
	}
}

require_once 'header.php';
?>
<div id="data" data-id="#tampilan"></div>
<title>Customize - Administrator</title>
<h3>Customize</h3>
<hr>
<form method="get">
<div class="form-group dib">
	<select class="form-control dib" name="theme" style="width:auto">
<?php
select_file($path_theme, $edit_file);
$edit_file = $path.'/'.$edit_file;
$edit_file = file_get_contents($edit_file);
?>
	</select>
	<button type="submit" class="btn btn-default" name="submit" value="1">Edit</button>
</div>
</form>
<form method="post">
<div class="form-group">
	<textarea id="code" name="content"><?=htmlspecialchars($edit_file)?></textarea>
</div>
<button type="submit" class="btn btn-primary" name="save" value="1">Save</button>
</form>
<?php require_once 'footer.php';