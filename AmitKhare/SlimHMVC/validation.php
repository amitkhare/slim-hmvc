<?php
namespace AmitKhare\SlimHMVC;

class ValidateIt {

	private $code;
	private $msgs;

	function __construct(){
		$this->msgs = array();
		$this->code = 200;
	}

	public function check($data=array(),$field="",$rules="required|numeric"){
		if(!isset($data[$field]) || $data[$field]==""){
			$this->setStatus(500,$this->readable($field));
		}
	}

	private function readable($field){
		$str = "The '".$field."' field is not set.";
		return $str;
	}

	private function setStatus($code,$msg){
			$this->code=$code;
			$this->msgs[]=$msg;
	}

	public function isValid(){
		if($this->code===200){
			return true;
		}
		return false;
	}

	public function getStatus(){
		$status = array(
				"code"=>$this->code,
				"msgs"=>$this->msgs
			);
		return $status;
	}
	static function makeStatus($code=200,$msg="ok"){
		return array("code"=>$code,"msgs"=>array($msg));
	}

	static function ifSet($data=array(),$field="",$default=0){
		if(isset($data[$field])){
			return $field;
		}
		return $default;
	}
}