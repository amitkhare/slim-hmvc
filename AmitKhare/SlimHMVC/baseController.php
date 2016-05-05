<?php
namespace AmitKhare\SlimHMVC;

class baseController {
    protected $c;
    protected $moduleName="EMPTY-MODULE";
    protected $model;
    public function __construct($c) {
        $this->c = $c;
        $this->_loadModule($c);
    }

    private function _loadModule($c){
        $modulePath = $c->get('settings')['hmvc']['modulePath'];
        require_once $modulePath.$this->moduleName.'/'.$this->moduleName.".mdl.php";
        $nm = $this->moduleName."_mdl";
        $this->model = new $nm($c);
    }

    public function findAll($request, $response, $args) {
        $results = $this->model->findAll();
        return $results;
    }

    public function findOne ($request, $response, $args){
        $id=$args['id'];
        $key =  "`id` = ";
        $result = $this->model->findOne($id,$key,"`id` = ");
        return $result;
    }

    public function store ($request, $response, $args){
        $data=array();
        $result = $this->model->store($data);
        return $result;
    }

    public function update ($request, $response, $args){
        $id =$args['id'];
        $data=array();
        $result = $this->model->update($id,$data);
        return $result;
    }

    public function delete ($request, $response, $args){
        $id=$args['id'];
        if($result = $this->model->delete($id)){
            return true;
        }
    }
}