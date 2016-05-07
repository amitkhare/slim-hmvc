<?php
namespace AmitKhare\SlimHMVC;

if (!defined('DS')) {
    define("DS",DIRECTORY_SEPARATOR);
}

require_once (__DIR__."/modules.php");
require_once (__DIR__."/baseModel.php");
require_once (__DIR__."/baseController.php");
require_once (__DIR__."/simplymysqli.php");


class AutoloadHMVC {
    protected $app;
    protected $c;
    protected $modulesLocations;
    protected $modules;
    function __construct($app){
        $this->app = $app;
        $this->c = $this->app->getContainer();
        $this->_check();
        $this->init($this->app);
    }

    private function _check(){

        if(!isset($this->c->get('settings')['hmvc']['modulePath'])){
            die("Please set Module Path ['hmvc']['modulePath'] at app container settings");
        }
        if(!isset($this->c->get('settings')['db'])){
            die("Please set database perameters ['db'] at app container settings");
        }
        
    }

    public function init($app){
        $mdl = new Modules($this->c);
        $this->modules = $mdl->getModules();
        $this->modulesLocations = $mdl->getLocations();
       
        $app->getContainer()['Modules'] = function () {
            return $this->modules;
        };
        ob_start();
        foreach ($this->modulesLocations as $module) {
           include_once $module->Path.$module->Routes;
        }
        return ob_get_clean();
    }

}
