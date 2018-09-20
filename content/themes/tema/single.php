<?php include 'header.php';?>
<div class="container blog-main">
	<div class="row">
		<div class="col-sm-7">
			<h3><a href="<?=$single_post['slug']?>"><?=$single_post['title']?></a></h3>
			<div class="post-meta"><a href="?author=<?=$author['username']?>"><i class="fa fa-user"></i>&nbsp;<?=$author['username']?></a></div>
			<div class="post-meta"><i class="fa fa-comment"></i>&nbsp;<?=count_comment($single_post)?></div>
			<div class="post-meta"><i class="fa fa-clock-o"></i>&nbsp;<?=$times?></div>
			<img src="<?=$set->val('url')?>content/upload/<?=$single_post['img']?>" class="img">
			<br>
			<br>
			<div class="single-post-content"><?=$single_post['content']?></div>
			<br>
			<div class="post-tag">
			<?php foreach ($post_tag as $post_tags) {?>
				<a href="<?=$set->val('url').'tag/'.$post_tags?>" class="btn btn-default"><?=$post_tags?></a>
			<?php }?>
			</div>
			<hr>
			<nav>
				<ul class="pager"><?=$pager?></ul>
			</nav>
			<hr>
			<div class="comment">
				<div class="comment-content"><?=comment($single_post, $comment)?></div>
				<br>
				<h3>Leave a Comment</h3>
				<form method="post" id="comment-form">
					<input type="hidden" class="parent-comment" name="parent_comment">
					<div class="form-group">
						<textarea class="form-control" name="comment" rows="5" placeholder="Comment"></textarea>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="username" value="" required="required" placeholder="Username">
					</div>
					<div class="form-group">
						<input type="email" class="form-control" name="email" value="" required="required" placeholder="Email">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="site" value="" placeholder="Website">
					</div>
					<button type="submit" class="btn btn-style-default" name="submit-comment" value="1">Post Comment</button>
				</form>
			</div>
		</div>
		<div class="col-sm-4"><?php include 'sidebar.php';?></div>
		<div class="clear"></div>
	</div>
</div>
<br><br>
<?php include 'footer.php';?>