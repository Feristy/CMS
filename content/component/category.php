<div class="sidebar-category">
    <h4>Categories</h4>
<?php
$url = $GLOBALS['set']->val('url');
$post = $GLOBALS['data']->read('post');
$ctg = $GLOBALS['data']->read('category');
$_ctg = '';
foreach ($ctg as $ctgs) {
	$ctg_count = array();
	foreach ($post as $posts) {
		if($ctgs['name'] == $posts['category']){
			$ctg_count[] = $ctgs['name'];
		}
	}
	$ctg_count = count($ctg_count);
	if(!empty($ctg_count)){
		echo '<a href="'.$url.'category/'.$ctgs['name'].'">'.$ctgs['name'].' ('.$ctg_count.')</a>';
	}
}
?>
       	
    </ol>
</div>