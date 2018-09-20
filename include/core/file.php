<?php

class file{

	public $set,
		   $data;

	public function __construct(){
		$this->set = new set();
		$this->data = new data();
	}

	public function icon($files){
		if(!empty($files['size'])){
			if($files['type'] == 'image/x-icon'){
				$path = '../content/upload/thumbs/';
				$file_upload = $path.$files['name'];
				move_uploaded_file($files['tmp_name'], $file_upload);
				$this->data->update('setting', array('value' => $files['name']), $this->set->id('icon'));
				return 'The website icon successfully renamed';
			}else{
				return 'The website icon was not successfully replaced';
			}
		}
	}

	public function logo($files){
		if(!empty($files['size'])){
			if($files['type'] == 'image/jpeg' || $files['type'] == 'image/png'){
				$path = '../content/upload/thumbs/';
				$file_upload = $path.$files['name'];
				move_uploaded_file($files['tmp_name'], $file_upload);
				$this->data->update('setting', array('value' => $files['name']), $this->set->id('logo_img'));
				return 'Logo website successfully replaced';
			}else{
				return 'The website logo was not successfully replaced';
			}
		}
	}

	public function single_ico($files){
		if($files['type'] == 'image/jpeg' || $files['type'] == 'image/png'){
			$path = '../content/upload/thumbs/';
			$file_upload = $path.$files['name'];
			move_uploaded_file($files['tmp_name'], $file_upload);
			$data->update('user', array('img' => $files['name']), $id);

			switch ($files['type']) {
				case 'image/jpeg':
					$im_src = imagecreatefromjpeg($file_upload);
				break;
				case 'image/png':
					$im_src = imagecreatefrompng($file_upload);
				break;
				default: return $error; break;
			}

			$src_width = imageSX($im_src);
			$src_height = imageSY($im_src);

			$size = 150;
			$im = imagecreatetruecolor($size, $size);
			$width =  ceil(($size/$src_height) * $src_width);
			$height = ceil(($size/$src_width) * $src_height);
			$x = ceil(($width*1.61) - $size);
			$y = ceil(($height/1.15) - ($size/2));
			imagecopyresized($im, $im_src, 0, 0, $x, $y, $width, $size, $src_width, $src_height);

			switch ($files['type']) {
				case 'image/jpeg':
					imagejpeg($im, $path.$files['name']);
				break;
				case 'image/png':
					imagepng($im, $path.$files['name']);
				break;
			}
			imagedestroy($im_src);
			imagedestroy($im);
		}else{
			return 'Upload file failed.';
		}
	}

	public function up($files){
		$path = '../content/upload/';
		$notf = '';
		foreach ($files['error'] as $key => $value) {
			if ($value == UPLOAD_ERR_OK) {
				$file_upload = $path.$files['name'][$key];
				move_uploaded_file($files['tmp_name'][$key], $file_upload);
				$this->data->insert('library', array('name' => $files['name'][$key]));

				switch ($files['type'][$key]) {
					case 'image/jpeg':
						$im_src = imagecreatefromjpeg($file_upload);
					break;
					case 'image/png':
						$im_src = imagecreatefrompng($file_upload);
					break;
					default: return $error; break;
				}

				$src_width = imageSX($im_src);
				$src_height = imageSY($im_src);

				$dst_width = $this->set->val('medium_size');
				$dst_height = ($dst_width/$src_width)*$src_height;
				$im = imagecreatetruecolor($dst_width,$dst_height);

				imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

				$size = 200;
				$im1 = imagecreatetruecolor($size, $size);
				$width =  ceil(($size/$src_height) * $src_width);
				$height = ceil(($size/$src_width) * $src_height);
				$x = ceil(($width*1.35) - $size);
				$y = ceil(($height/1.15) - ($size/2));
				imagecopyresized($im1, $im_src, 0, 0, $x, $y, $width, $size, $src_width, $src_height);

				switch ($files['type'][$key]) {
					case 'image/jpeg':
						imagejpeg($im, $path.'medium/'.$files['name'][$key]);
						imagejpeg($im1, $path.'thumbs/'.$files['name'][$key]);
						$notf = 'upload file successfully';
					break;
					case 'image/png':
						imagepng($im, $path.'medium/'.$files['name'][$key]);
						imagepng($im1, $path.'thumbs/'.$files['name'][$key]);
						$notf = 'upload file successfully';
					break;
					default: return $notf = 'upload file failed'; break;
				}

				imagedestroy($im_src);
				imagedestroy($im);
			}
		}

		return $notf;
	}

	public function size($size, $precision = 0){
		
		$sizes = array('YB', 'ZB', 'EB', 'PB', 'TB', 'GB', 'MB', 'KB', 'bytes');
		$total = count($sizes);
		while($total-- && $size > 1024) $size /= 1024;
		$return = round($size, $precision).' '.$sizes[$total];
		return $return;
	}

	public function delete($files){
		$file_name = $this->data->read('media', 'id', $files);
		$path = '../content/upload/';
		$file = $path.$file_name['name'];
		$file1 = $path.'medium/'.$file_name['name'];
		$file2 = $path.'thumbs/'.$file_name['name'];

		unlink($file);
		unlink($file1);
		unlink($file2);
		
		$this->data->delete('media', 'id', $files);
	}
}