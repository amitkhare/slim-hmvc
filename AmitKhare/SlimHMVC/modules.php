<?php
namespace AmitKhare\SlimHMVC;


class Modules {
    protected $c;
    protected $modulePath;
    //Constructor
    public function __construct($c) {
        $this->c = $c;
        $this->modulePath = $c->get('settings')['hmvc']['modulePath'];
    }

    public function getLocations() {
        $modules = $this->dirToArray($this->modulePath); // look in core.functions.php helper
        foreach ($modules as $module=>$contents) {
            $modules[$module] = (object) array("Path"=>"","Controller"=>"","Model"=>"","Views"=>"","ModelName"=>"","Routes"=>"");
            $modules[$module]->Name = $module;
            $modules[$module]->Path = $this->modulePath.$module.DS;
            $modules[$module]->Controller = $module.".php";
            $modules[$module]->Model = $module.".mdl.php";
            $modules[$module]->Routes = "routes.php";
            $modules[$module]->ModelName = $module."_mdl";

            $tempViews=Array();
            if(!empty($contents['Views'])){
                foreach ($contents['Views'] as $view) {
                    $tempViews[]=$view;
                }
                $modules[$module]->Views=(object)$tempViews;
            }
        }
        return $modules;
    }


    public function loadView($module,$view,$data=array("success"=>false)) {
        $path = $this->modulePath.$module.DS.'views'.DS.$view.'.php';
        $data = (is_array($data) && !empty($data)) ? $data : array('success'=>true);
        foreach ($data as $key => $value) {
            $$key=$value;
        }
        ob_start();
        include($path);
        return ob_get_clean();
    }

    function getModules() {
        $modulesObj = (object)array("success"=>false);

        foreach ($this->getLocations() as $module) {
            require $module->Path.$module->Controller;
            $n = $module->Name;
            $modulesObj->$n = new $n($this->c);
        }
        $this->modules = $modulesObj;
        return $this->modules;
    }

    private function dirToArray($dir) {
        $ignore = array('.','..','.DS_Store','index.html','.htaccess','modules.php',
            '_core','hmvc','Model.php','Controller.php','routes.php','autoload.php');
        $contents = array();
        # Foreach node in $dir
        foreach (scandir($dir) as $node) {
            # Skip link to current and parent folder
            if(in_array($node,$ignore)) continue;
            if($node)
                # Check if it's a node or a folder
                if (is_dir($dir . DIRECTORY_SEPARATOR . $node)) {
                    # Add directory recursively, be sure to pass a valid path
                    # to the function, not just the folder's name
                    $contents[$node] = $this->dirToArray($dir . DIRECTORY_SEPARATOR . $node);
                } else {
                    # Add node, the keys will be updated automatically
                    $contents[] = $node;
                }
        }
        # done
        return $contents;
    }
}