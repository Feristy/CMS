<?php

class validation{
	private $_passed = false,
			$_errors = array(),
			$user,
			$data;

	public function __construct(){
		$this->user = new user();
	}

	public function check($items = array()){
		foreach($items as $item => $rules){
			foreach ($rules as $rule => $rule_value){
				switch ($rule) {
					case 'required':
							if(trim(input::get($item)) == false && $rule_value == true){
								$this->add_error("$item wajib diisi");
							}
						break;
					case 'min':
							if(strlen(input::get($item)) < $rule_value){
								$this->add_error("$item minimal $rule_value karakter.");
							}
						break;
					case 'max':
							if(strlen(input::get($item)) > $rule_value){
								$this->add_error("$item Maximal $rule_value karakter.");
							}
						break;
					case 'match':
						if(input::get($item) != input::get($rule_value)){
							$this->add_error("Password harus sama dengan $rule_value.");
						}
						break;
					case 'match_user':
						if($this->user->is_data('user', 'username', input::get($item))){
							$this->add_error("Username sudah terdaftar.");
						}
						break;

					default:
						# code...
						break;
				}
			}
		}
		if(empty($this->_errors)){
			$this->_passed = true;
		}
		return $this;
	}

	public function add_error($error){
		$this->_errors[] = $error;
	}

	public function errors(){
		return $this->_errors;
	}

	public function passed(){
		return $this->_passed;
	}
}