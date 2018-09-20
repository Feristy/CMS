<?php

class paging{

	public $db,
		   $link,
		   $admin_link,
		   $set;

	public function __construct(){
		$this->db = database::get_instance();
		$this->set = new set();
	}

	public function get_data($table, $per_page_db, $key = null, $value = null){

		if(empty(@$_GET['page'])){
			if(@$_GET['url']){
				$url_file = explode('/', filter_var(trim(@$_GET['url']), FILTER_SANITIZE_URL));
			}else{
				$url_file[0] = '';
			}

			$page = array_reverse($url_file);
			if(@$page[1] == 'page'){
				$u_page = '';
				for ($nr=0; $nr < count($url_file); $nr++) { 
					if($url_file[$nr] == 'page'){
						$u_page = $nr;
					}
				}
				unset($url_file[$u_page]);
				$u_page++;
				unset($url_file[$u_page]);
			}

			$url = @$url_file[0] != '' ? implode('/', $url_file).'/': null;
			$url = $this->set->val('url').$url.'page/';
			$page = @$page[1] == 'page' ? $page[0]: null;
			$page = !empty($page) ? $page: 1;
		}else{
			$page = $_GET['page'];
		}

		$per_page = $this->set->val($per_page_db);
		$start = ($page > 1) ? ($page * $per_page) - $per_page : 0;
		if($value == ''){
		   	$query = "SELECT * FROM $table ORDER BY id DESC LIMIT $start, $per_page";
		    $query1 = "SELECT * FROM $table";
		}else{
			$query = "SELECT * FROM $table WHERE $key LIKE '%$value%'  ORDER BY id DESC LIMIT $start, $per_page";
		    $query1 = "SELECT * FROM $table WHERE $key LIKE '%$value%'";
		}

		$result = $this->db->read_query($query);
		$result1 = $this->db->read_query($query1);
		$total_data = mysqli_num_rows($result1);
		$total_page = ceil($total_data / $per_page);
		$this->link($url, $page, $total_page, $per_page, $total_data);
		$this->admin_link($page, $total_page, $per_page, $total_data);
		$show = array();
		while($row = $result->fetch_assoc()){
			$show[] = $row;
		}
		return $show;
	}

	public function link($url, $active_page, $total_page, $per_page, $total_data){
		$link_page = null;
		$prev = $active_page == 1 ? $active_page: $active_page - 1;
		if($active_page >= 2){
			$link_page .= '<a href="'.$url.$prev.'" class="btn btn-default btn-sm">Prev</a>';
		}
		
		$number = null;
		for($i = $active_page - 3; $i < $active_page; $i++){
			if($i < 1) continue;
			$number .= '<a href="'.$url.$i.'" class="btn btn-default btn-sm">'.$i.'</a>';
		}

		$number .= '<a class="btn btn-style-default btn-sm">'.$active_page.'</a>';
		for($i = $active_page + 1; $i <= 5; $i++){
			if($i > $total_page) break;
			$number .= '<a href="'.$url.$i.'" class="btn btn-default btn-sm">'.$i.'</a>';
		}
		
		$link_page .= $number;
		if($active_page < $total_page){
			$next = $active_page + 1;
			$link_page .= '<a href="'.$url.$next.'" class="btn btn-default btn-sm">Next</a>';
		}

		$this->link = $per_page < $total_data ? '<nav class="paging">'.$link_page.'</nav>': null;
	}

	public function get_paging(){
		return $this->link;
	}

	public function admin_link($active_page, $total_page, $per_page, $total_data){
		$url = @$_GET['s'] ? '?s='.$_GET['s'].'&page=': '?page=';
		$link_page = null;
		$prev = $active_page == 1 ? $active_page: $active_page - 1;
		if($active_page < 2){
			$link_page .= '<li class="disabled"><a><i class="fa fa-angle-left"></i></a></li>';
		}else{
			$link_page .= '<li><a href="'.$url.$prev.'""><i class="fa fa-angle-left"></i></a></li>';
		}
		
		$number = null;
		for($i = $active_page - 2; $i < $active_page; $i++){
			if($i < 1) continue;
			$number .= '<li><a href="'.$url.$i.'">'.$i.'</a></li>';
		}

		$number .= '<li class="active"><a>'.$active_page.'</a></li>';
		for($i = $active_page + 1; $i < ($active_page+3); $i++){
			if($i > $total_page) break;
			$number .= '<li><a href="'.$url.$i.'">'.$i.'</a></li>';
		}
		
		$link_page .= $number;
		if($active_page < $total_page){
			
			$next = $active_page + 1;
			$link_page .= '<li><a href="'.$url.$next.'"><i class="fa fa-angle-right"></i></a></li>';
		}else{
			$link_page .= '<li class="disabled"><a><i class="fa fa-angle-right"></i></a></li>';
		}

		$this->admin_link = $per_page < $total_data ? $link_page: null;
	}

	public function get_admin_paging(){
		return $this->admin_link;
	}
}