<?php
require_once 'config/config.php';

$chart = 1;

$atime = date('Y-m-d', time());
$live_time = $data->read('traffic', 'date', $atime);

if(empty($live_time)){

	$data->insert('traffic', array('vistor' => 0, 'date' => $atime));
}



$post_count = !empty($data->read('post')) ? count($data->read('post')): 0;
$category = !empty($data->read('category')) ? count($data->read('category')): 0;
$tag = !empty($data->read('tag')) ?count($data->read('tag')): 0;
$comment_count = !empty($data->read('comment')) ?count($data->read('comment')): 0;
$page = !empty($data->read('page')) ?count($data->read('page')): 0;
$component = !empty($data->read('component')) ?count($data->read('component')): 0;
$theme = !empty($data->read('theme')) ?count($data->read('theme')): 0;
$users = !empty($data->read('user')) ?count($data->read('user')): 0;

$comment = $data->rate('comment', 'id', 10);
$recent_post = $data->rate('post', 'id', 5);
$popular_post = $data->rate('post', 'rate', 5);

require_once 'header.php';
?>
<div id="data" data-id="#home"></div>
<title>Dashbord - Administrator</title>
<h3>Dashbord</h3>
<hr>
<div class="row">
	<div class="col-md-3 shortcut">
		<a href="post.php">
		<div class="panel panel-default">
		  	<div class="panel-body">
		    	<div class="img-circle dib">
		    		<i class="fa fa-thumb-tack fa-fw"></i>
		    	</div>
		    	<div class="search">
		    		<p>Post</p>
		    		<h3 class="margin search"><?=$post_count?></h3>
		    	</div>
		  	</div>
		</div>
		</a>
	</div>
	<div class="col-md-3 shortcut">
		<a href="comment.php">
		<div class="panel panel-default">
		  	<div class="panel-body">
		  		<div class="img-circle dib">
		    		<i class="fa fa-comment fa-fw"></i>
		    	</div>
		    	<div class="search">
		    		<p>Comment</p>
		    		<h3 class="margin search"><?=$comment_count?></h3>
		    	</div>
		  	</div>
		</div>
		</a>
	</div>
	<div class="col-md-3 shortcut">
		<a href="page.php">
		<div class="panel panel-default">
		  	<div class="panel-body">
		  		<div class="img-circle dib">
		    		<i class="fa fa-file fa-fw"></i>
		    	</div>
		    	<div class="search">
		    		<p>Page</p>
		    		<h3 class="margin search"><?=$page?></h3>
		    	</div>
		  	</div>
		</div>
		</a>
	</div>
	<div class="col-md-3 shortcut">
		<a href="user.php">
		<div class="panel panel-default">
		  	<div class="panel-body">
		  		<div class="img-circle dib">
		    		<i class="fa fa-user fa-fw"></i>
		    	</div>
		    	<div class="search">
		    		<p>User</p>
		    		<h3 class="margin search"><?=$users?></h3>
		    	</div>
		  	</div>
		</div>
		</a>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default dashbord">
			<div class="panel-heading">
		    	<h3 class="panel-title">Status Pengunjung</h3>
		  	</div>
		  	<div class="panel-body">
		    	<canvas id="myAreaChart" width="100%" height="30"></canvas>
		  	</div>
		</div>
		<div class="panel panel-default dashbord">
			<div class="panel-heading">
		    	<h3 class="panel-title">Recent Comments</h3>
		  	</div>
		  	<div class="panel-body">
		  		<?php
					foreach($comment as $comments){
						$post_title = $data->read('post', 'id', $comments['post_id']);
					?>
				<div class="recent-comment" style="padding:8px 0;border-bottom:1px solid #ccc">
			    	<div class="media-left">
				    	<img class="media-object" src="'.$user_img.'">
				  	</div>
				  	<div class="media-body">
				  		<p>From <a href="mailto:<?=$comments['email']?>"><?=$comments['username']?></a> On <a href="<?=$set->val('url').$post_title['title']?>"><?=$post_title['title']?></a></p>
				  		<p class="margin"><?=$comments['content']?></p>
				  	</div>
				 </div>
			  	<?php }?>
		  	</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default dashbord">
			<div class="panel-heading">
		    	<h3 class="panel-title">Post Activity</h3>
		  	</div>
		  	<div class="panel-body">
		  		<div class="popular-post">
		    		<h4>Popular Post</h4>
		    		<div class="row">
						<?php
						foreach($popular_post as $popular_posts){
							$times = time::get($popular_posts['time']);
						?>
						<div class="col-md-3"><?=$times?></div>
						<div class="col-md-9"><a href="<?=$set->val('url').$popular_posts['slug']?>"><?=$popular_posts['title']?></a></div>
						<?php }?>
					</div>
		    	</div>
		    	<hr>
		    	<div class="recent-post">
		    		<h4>Recent Post</h4>
		    		<div class="row">
						<?php
						foreach($recent_post as $recent_posts){
							$times = time::get($recent_posts['time']);
						?>
						<div class="col-md-3"><?=$times?></div>
						<div class="col-md-9"><a href="<?=$set->val('url').$recent_posts['slug']?>"><?=$recent_posts['title']?></a></div>
						<?php }?>
					</div>
		    	</div>
		  	</div>
		</div>
	</div>
</div>
<?php require_once 'footer.php';