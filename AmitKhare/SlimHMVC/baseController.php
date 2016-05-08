<?php
namespace AmitKhare\SlimHMVC;

class baseController {
    protected $c;
    protected $modulesClass;
    protected $moduleName="EMPTY-MODULE";
    protected $modules;
    protected $model;
    public function __construct($c) {
        $this->modules = new \stdClass();
        $this->c = $c;
        $this->modulesClass = new Modules($this->c);
        $this->_loadModal($c);
    }

    private function _loadModal($c){
        $modulePath = $c->get('settings')['hmvc']['modulePath'];
        require_once $modulePath.$this->moduleName.'/'.$this->moduleName.".mdl.php";
        $nm = $this->moduleName."_mdl";
        $this->model = new $nm($c);
    }

    protected function loadView($module,$view,$data=array()) {
        return $this->modulesClass->loadView($module,$view,$data);
    }

    protected function loadModule($name){
        $n =strtolower($name);
        $this->modules->$n = new $name($this->c);
        //$this->$n = new $name($this->c);
    }

}