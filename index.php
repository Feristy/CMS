<?php
require_once 'include/init.php';
require_once 'include/core/function.php';

if(!session::exists('vistor')){
	$atime = date('Y-m-d', time());
	$live_time = $data->read('traffic', 'date', $atime);
	if(empty($live_time)){
		$data->insert('traffic', array('date' => $atime));
		$live_time = $data->read('traffic', 'date', $atime);
	}else{
		$data->update('traffic', array('date' => $atime), $live_time['id']);
	}
	$vistor_name = time().'';
	$vistor_count = $live_time['vistor'];
	$vistor_count++;
	session::set('vistor', $vistor_name);
	$data->update('traffic', array('vistor' => $vistor_count.''), $live_time['id']);
}


$max_text = $set->val('max_text') == 'Summary' ? 200: null;
$path = 'content/themes/'.$set->val('theme').'/';
$icon = $set->val('url').'content/upload/thumbs/'.$set->val('icon');
$path_img = $set->val('url').'content/upload/medium/';

if(input::get('search')){
	header('Location:'.$set->val('url').'search/'.input::get('search'));
}

if(input::get('url')){
	$url_file = explode('/', filter_var(trim(input::get('url')), FILTER_SANITIZE_URL));
	$url_file[0] = @$url_file[0] == 'page' ? 'index.php': @$url_file[0];
}else{
	$url_file[0] = 'index.php';
}

if(input::get('url') && $url_file[0] != 'index.php'){
	$post = $data->read('post');
	$single_post = $data->read('post', 'slug', implode('/', $url_file));
	if(!empty($single_post)){
		$author = $data->read('user', 'id', $single_post['author']);
		$times = time::get($single_post['time']);
		$post_tag = explode(',', $single_post['tag']);

		if(input::get('submit-comment')){
			$time_comment = time().'';
			$data->insert('comment', array(
					'parent_id' => input::get('parent_comment'),
					'post_id' => $single_post['id'],
					'username' => input::get('username'),
					'email' => input::get('email'),
					'website' => input::get('site'),
					'content' => input::get('comment'),
					'time' => $time_comment
				));
			$new_comment_id = $data->read('comment');
			foreach ($new_comment_id as $new_comment) {
				$new_comment_id = $new_comment['id'];
			}
			$position_comment = $data->read("comment", "username", input::get('username'));
			$position_comment1 = !empty($position_comment['position']) ? $position_comment['position']: $position_comment['id'];
			$position = $data->update('comment', array('position' => $position_comment1), $new_comment_id);
			header('Location: '.$set->val('url').$single_post['slug'].'#comment'.$new_comment_id);
		}

		$comment = $data->read('comment');

		$post1 = '';
		$prev = '';
		$next = '';
		$pager = '';

		for($p=0; $p < count($post); $p++){
			if(@$post[$p]['id'] == $single_post['id']){
				$post1 = $p;

			}
		}

		$prev = $post1; $prev--;
		$next = $post1; $next++;
		$pager .= !empty($post[$prev]['id']) ? 
		'<li class="previous">
			<a href="'.$set->val('url').$post[$prev]['slug'].'" data-toggle="tooltip" data-placement="left" title="'.$post[$prev]['title'].'"><span aria-hidden="true">&larr;</span> Older</a>
		</li>': null;

		$pager .= !empty($post[$next]['id']) ? 
		'<li class="next">
			<a href="'.$set->val('url').$post[$next]['slug'].'" data-toggle="tooltip" data-placement="left" title="'.$post[$next]['title'].'">Newer <span aria-hidden="true">&rarr;</span></a>
		</li>': null;

		include $path.'single.php';
	}else{
		switch ($url_file[0]) {
			case 'search':
				$search = $url_file[1];
				$post = $paging->get_data('post', 'max_post', 'title', $url_file[1]);
				if(empty($post) || count($url_file) > 4 || !empty($url_file[2]) && $url_file[2] != 'page'){
					include $path.'404.php';
				}else{
					include  $path.'index.php';
				}
			break;
			case 'category':
				$ctg = $data->read('category', 'name', $url_file[1]);
				$post = !empty($ctg) ? $paging->get_data('post', 'max_post', 'category', $ctg['name']): null;
				if(empty($post) || count($url_file) > 4 || !empty($url_file[2]) && $url_file[2] != 'page'){
					include $path.'404.php';
				}else{
					include  $path.'index.php';
				}
			break;
			case 'tag':
				$tag = $data->read('tag', 'name', $url_file[1]);
				$post = !empty($tag) ? $paging->get_data('post', 'max_post', 'tag', $tag['name']): null;
				if(empty($post) || count($url_file) > 4 || !empty($url_file[2]) && $url_file[2] != 'page'){
					include $path.'404.php';
				}else{
					include  $path.'index.php';
				}
			break;
			case 'pages':
				$pages = $data->read('page', 'slug', $url_file[1]);
				if(!empty($pages)){
					include  $path.'page.php';
				}else{
					include $path.'404.php';
				}
			break;
			default: include $path.'404.php'; break;
		}
	}
}else{
	$post = $paging->get_data('post', 'max_post', null, null);
	include $path. 'index.php';
}