<?php

class set{
	public $data;

	public function __construct(){
		$this->data = new data();
	}

	public function val($value){
		$config = $this->data->read('setting', 'name', $value);
		$config = $config['value'];
		return $config;
	}

	public function id($id){
		$id = $this->data->read('setting', 'name', $id);
		$id = $id['id'];
		return $id;
	}

	public function slug($time = ''){
		$time = !empty($time) ? $time: time();
		switch ($this->val('permalink')) {
			case 'slug/post-title':
					$slug = $this->val('default_permalink').'/';
				break;
			case 'yyyy/mm/dd/post-title':
					$slug = date('Y/m/d/', $time);
				break;
			case 'yyyy/mm/post-title':
					$slug = date('Y/m/', $time);
				break;
			case 'archives/post-title':
					$slug = 'archives/';
				break;
			case 'post-title':
					$slug = '';
				break;
		}

		return $slug;
	}

	public function view_slug(){
		switch ($this->val('permalink')) {
			case 'slug/post-title':
					$permalink = 'slug1';
				break;
			case 'yyyy/mm/dd/post-title':
					$permalink = 'slug2';
				break;
			case 'yyyy/mm/post-title':
					$permalink = 'slug3';
				break;
			case 'archives/post-title':
					$permalink = 'slug4';
				break;
			case 'post-title':
					$permalink = 'slug5';
				break;
			default: $permalink = 'slug/post-title'; break;
		}
		return $permalink;
	}

	public function change_slug($permalink){
		$update_permalink = $this->data->update('setting', array('value' => $permalink), $this->id('permalink'));
		if($permalink != $this->val('permalink')){
			$posts = $this->$data->read('post');
			foreach ($posts as $post) {
				$data_post = explode('/', $post['slug']);
				$data_post = array_reverse($data_post);
				$data_post = $data_post[0];
				switch ($permalink) {
					case 'slug/post-title':
							$slug = $this->val('default_permalink').'/'.$data_post;
							$this->$data->update('post', array('slug' => $slug), $post['id']);
						break;
					case 'yyyy/mm/dd/post-title':
							$slug = date('Y/m/d/', $post['time']).$data_post;
							$this->$data->update('post', array('slug' => $slug), $post['id']);
						break;
					case 'yyyy/mm/post-title':
							$slug = date('Y/m/', $post['time']).$data_post;
							$this->$this->$data->update('post', array('slug' => $slug), $post['id']);
						break;
					case 'archives/post-title':
							$slug = 'archives/'.$data_post;
							$this->$data->update('post', array('slug' => $slug), $post['id']);
						break;
					case 'post-title':
							$this->$data->update('post', array('slug' => $data_post), $post['id']);
						break;
				}
			}
		}
	}
}