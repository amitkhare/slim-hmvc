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

}