<?php
namespace AmitKhareSlimHMVC;

class Controller {
	protected $c;
	protected $model;
	protected $modeuleName;
	public function __construct($c)  {
		$this->c = $c;
		$this->model = Modules::loadModel($this->modeuleName,$this->c);
	}
	function findAll() {
		$results = $this->model->findAll();
		return $results;
	}

	function findOne ($id,$key =  "`id` = "){
		$result = $this->model->findOne($id,$key,"`id` = ");
		return $result;
	}

	function store ($data){
		$result = $this->model->store($data);
		return $result;
	}

	function update ($id,$data){
		$result = $this->model->update($id,$data);
		return $result;
	}

	function delete ($id){
		if($result = $this->model->delete($id)){
			return true;
		}
	}
}