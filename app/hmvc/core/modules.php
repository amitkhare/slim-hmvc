<?php
namespace AmitKhareSlimHMVC;
class Modules {
	public function getAll() {
		$modules = $this->dirToArray(); // look in core.functions.php helper
		foreach ($modules as $module=>$contents) {
			$modules[$module] = (object) array("Path"=>"","Controller"=>"","Model"=>"","Views"=>"","ModelName"=>"","Routes"=>"");
			$modules[$module]->Name = $module;
		    $modules[$module]->Path = MODULEPATH.$module.DS;
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

	static function loadModel($name,$c) {
		$path = MODULEPATH.$name;
		require $path.'/'.$name.'.mdl.php';
		$name =$name.'_mdl';
		return new $name($c);
	}

	static function loadView($module,$view,$data=array("success"=>false)) {
		$path = MODULEPATH.$module.DS.'Views'.DS.$view.'.php';
		$data = (is_array($data) && !empty($data)) ? $data : array('success'=>true);
		foreach ($data as $key => $value) {
			$$key=$value;
		}
		ob_start();
		include($path);
		return ob_get_clean();
	}

	private function dirToArray($dir = MODULEPATH) {
	    $ignore = array('.','..','.DS_Store','index.html','.htaccess','modules.php',
	    	'_core','hmvc','Model.php','Controller.php','routes.php','autoload.php');
	    $contents = array();
	    # Foreach node in $dir
	    foreach (scandir($dir) as $node) {
	        # Skip link to current and parent folder
	        if(in_array($node,$ignore)) continue;
	        if($node)
	        # Check if it's a node or a folder
	        if (is_dir($dir . DS . $node)) {
	            # Add directory recursively, be sure to pass a valid path
	            # to the function, not just the folder's name
	            $contents[$node] = $this->dirToArray($dir . DS . $node);
	        } else {
	            # Add node, the keys will be updated automatically
	            $contents[] = $node;
	        }
	    }
	    # done
	    return $contents;
	}
}