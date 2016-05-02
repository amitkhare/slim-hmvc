<?php

class Expenses_mdl extends AmitKhareSlimHMVC\Model {
	protected  $tableName="expenses";

	function findAll(){
		return parent::findAll();
	}

	function findOne($id,$key =  "`id` = "){
		return parent::findOne($id,$key);
	}

	function store ($data){
		$data = $this->db->filter( $data );
		$status = setStatus();

		$v = new ValidateIt();
		$v->check($data,'price','required|numeric');
		$v->check($data,'description','required|numeric');

		if($v->isValid() !== true) {
		    return $v->getStatus();
		}
		$data = array(
			"price"=>$data['price'],
			"description"=>$data['description'],
			"visible"=>ValidateIt::ifSet($data,'visible',0)
		);
		if($id = parent::store($data)){
			$status = setStatus(200,$id);
		} else {
			$status = setStatus(500,'something went wrong');
		}
		return $status;
	}

	function update($id, $data){
	 	$data = $this->db->filter( $data );
		$status = setStatus();

		$v = new ValidateIt();
		$v->check($data,'price','required|numeric');
		$v->check($data,'description','required|numeric');

		if($v->isValid() !== true) {
		    return $v->getStatus();
		}
		$data = array(
				"price"=>$data['price'],
				"description"=>$data['description'],
				"visible"=>ValidateIt::ifSet($data,'visible',0)
			);
		if(parent::update($id,$data)){
			$status = setStatus(200,'data updated');
		} else {
			$status = setStatus(500,'something went wrong');
		}
		return $status;
     }

     function delete($id){
     	return parent::delete($id);
     }
}