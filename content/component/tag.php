<div class="sidebar-tag">
    <h4>Tags</h4>
<?php
$url = $GLOBALS['set']->val('url');
$tag = $GLOBALS['data']->read('tag');
foreach ($tag as $tags) {
	$tag_count = array();
	$post = $GLOBALS['data']->filter('post', 'tag', $tags['name']);
	if(count($post) != 0){
		echo '<a href="'.$url.'tag/'.$tags['name'].'" class="btn btn-default btn-xs">'.$tags['name'].'</a>';
	}
}
?>
</div>