<?php include 'header.php';?>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h4>All Post</h4>
			<br>
			<?php
			foreach ($post as $posts) {
				if($posts['active'] == 'Yes' || $posts['active'] == 'Ya'){
					$author = $data->read('user', 'id', $posts['author']);
					$times = time::get($posts['time']);
					$excerpt = !empty($max_text) ? $data->excerpt($posts['content'], $max_text): $posts['content'];
					$posts_img = !empty($posts['img']) ? '<img src="'.$path_img.$posts['img'].'" class="img">': null;
					$post_meta = 'by <a href="">Admin</a>, '.$times.', '.count_comment($posts).' Comment';
			?>
			<div class="post-content">
				<div class="row">
					<div class="col-sm-6">
						<a href="<?=$set->val('url').$posts['slug']?>"><?=$posts_img?></a>
					</div>
					<div class="col-sm-6">
						<h4 class="post-title"><a href="<?=$set->val('url').$posts['slug']?>"><?=$posts['title']?></a></h4>
						<div class="post-meta"><?=$post_meta?></div>
						<div class="post-text"><?=$excerpt?></div>
						<a href="<?=$set->val('url').$posts['slug']?>" class="read-more">Read More</a>
					</div>
				</div>
				<hr>
			</div>
			<?php
				}
			}

			echo $paging->get_paging();
			?>
		</div>
		<div class="col-md-4"><?php include 'sidebar.php';?></div>
		<div class="clear"></div>
	</div>
</div>
<?php include 'footer.php';?>