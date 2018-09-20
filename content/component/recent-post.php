<div class="sidebar-recent-post">
	<h4>Recent Post</h4>
<?php
$url = $GLOBALS['set']->val('url');
$recent_post = $GLOBALS['data']->rate('post', 'id', 10);
foreach ($recent_post as $recent_posts) {
	echo '<a href="'.$url.$recent_posts['slug'].'">'.$recent_posts['title'].'</a>';
}
?>
</div>
