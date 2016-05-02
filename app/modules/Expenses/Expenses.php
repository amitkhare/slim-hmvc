<?php

class Expenses extends AmitKhareSlimHMVC\Controller {
	protected $modeuleName ="Expenses";

	function testView($data){
		$data['title']="Modular Slim 3";
		return Modules::loadView('Expenses','index',$data);
	}

	function findAll() {
		return parent::findAll();
	}

	function findOne ($id,$key =  "`id` = "){
		return parent::findOne($id,$key);
	}

	function store ($data){
		return parent::store($data);
	}

	function update ($id,$data){
		return parent::update($id,$data);
	}

	function delete ($id){
		return parent::delete($id);
	}
}