<?php

function get_component($files){
	include 'content/component/'.$files.'.php';
}

function get_menu($active_menu){
	$group = $GLOBALS['data']->read('menu_group', 'name', $active_menu);
	$menu = $GLOBALS['data']->read('menu');
	$_menu = '';
	foreach ($menu as $menus) {
		if($group['id'] == $menus['group_id']){
            $_menu .= '<li><a href="'.$menus['url'].'">'.$menus['name'].'</a></li>';
        }
	}
	return $_menu;
}

function comment($post_id, $comment){
	$comments = '';
	$grav_url = 'https://www.gravatar.com/avatar/';
	$count_comment = array();
	foreach ($comment as $value_count_comment) {
		if($value_count_comment['post_id'] == $post_id['id']){
			$count_comment[] = $value_count_comment;
		}
	}

	$count_comment = count($count_comment);
	if(!empty($count_comment)){
		$comments .= '<h3>'.$count_comment.' Comments</h3>';
	}
	
	foreach ($comment as $post_comments) {
		$user_img = $grav_url.md5( strtolower( trim($post_comments['email']) ).'.jpg' );
		if($post_comments['post_id'] == $post_id['id'] && $post_comments['parent_id'] == 0){
			$comments .= '<div id="comment'.$post_comments['id'].'" class="media">
		  			<div class="media-left">
		    			<a href="#">
		     	 			<img class="media-object" src="'.$user_img.'">
		   	 			</a>
		  			</div>
		  			<div class="media-body">
		    			<h4 class="media-heading">'.$post_comments['username'].'</h4>
		   		 		<p>'.$post_comments['content'].'</p>
		   		 		<a href="#comment-form" class="reply" data-id="'.$post_comments['id'].'"><strong><i class="fa fa-reply fa-fw"></i> Reply</strong></a>';

			   		 	foreach ($comment as $parent_post_comments) {
			   		 		$user_img1 = $grav_url.md5( strtolower( trim($parent_post_comments['email']) ).'.jpg' );
			   		 		if($parent_post_comments['post_id'] == $post_id['id'] && $parent_post_comments['parent_id'] == $post_comments['id']){
			   		 			$comments .= '<div id="comment'.$parent_post_comments['id'].'" class="media">
							  			<div class="media-left">
							    			<a href="#">
							     	 			<img class="media-object" src="'.$user_img1.'">
							   	 			</a>
							  			</div>
							  			<div class="media-body">
							    			<h4 class="media-heading">'.$parent_post_comments['username'].'</h4>
							   		 		<p>'.$parent_post_comments['content'].'</p>
							   		 		<a href="#comment-form" class="reply" data-id="'.$parent_post_comments['id'].'"><strong><i class="fa fa-reply fa-fw"></i> Reply</strong></a>';

					   		 		foreach ($comment as $parent_post_comments1) {
					   		 			$user_img2 = $grav_url.md5( strtolower( trim($parent_post_comments1['email']) ).'.jpg' );
							   			if($parent_post_comments1['post_id'] == $post_id['id'] && $parent_post_comments1['parent_id'] == $parent_post_comments['id']){
							   		 		$comments .= '<div id="comment'.$parent_post_comments1['id'].'" class="media">
										  			<div class="media-left">
										    			<a href="#">
										     	 			<img class="media-object" src="'.$user_img2.'">
										   	 			</a>
										  			</div>
										  			<div class="media-body">
										    			<h4 class="media-heading">'.$parent_post_comments1['username'].'</h4>
										   		 		<p>'.$parent_post_comments1['content'].'</p>
										   		 		<a href="#comment-form" class="reply" data-id="'.$parent_post_comments1['id'].'"><strong><i class="fa fa-reply fa-fw"></i> Reply</strong></a>';
										   		 		foreach ($comment as $parent_post_comments2) {
										   		 			$user_img3 = $grav_url.md5( strtolower( trim($parent_post_comments2['email']) ).'.jpg' );
												   			if($parent_post_comments2['post_id'] == $post_id['id'] && $parent_post_comments2['parent_id'] == $parent_post_comments1['id']){
												   		 		$comments .= '<div id="comment'.$parent_post_comments2['id'].'" class="media">
															  			<div class="media-left">
															    			<a href="#">
															     	 			<img class="media-object" src="'.$user_img3.'">
															   	 			</a>
															  			</div>
															  			<div class="media-body">
															    			<h4 class="media-heading">'.$parent_post_comments2['username'].'</h4>
															   		 		<p>'.$parent_post_comments2['content'].'</p>
															  			</div>
																	</div>';
															}
														}
										  			$comments .= '</div></div>';
										}
									}
			  				$comments .= '</div></div>';
			  				}
						}
	  		$comments .= '</div></div>';
		}
	}

	return $comments;
}

function count_comment($post_id){
	$comment = $GLOBALS['data']->read('comment');
	$count_comment = array();
	foreach ($comment as $value_count_comment) {
		if($value_count_comment['post_id'] == $post_id['id']){
			$count_comment[] = $value_count_comment;
		}
	}
	$count_comment = count($count_comment);
	$count_comment = !empty($count_comment) ? $count_comment: 0;
	return $count_comment;
}