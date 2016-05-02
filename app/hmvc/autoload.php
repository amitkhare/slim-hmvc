<?php
namespace AmitKhareSlimHMVC;

define('DS', DIRECTORY_SEPARATOR);
define('MODULEPATH', __DIR__.DS.'..'.DS.'modules'.DS);
define('HMVCCOREPATH', __DIR__.DS);

require(HMVCCOREPATH.'core'.DS.'functions.php');
require(HMVCCOREPATH.'core'.DS.'validation.php');
require(HMVCCOREPATH.'core'.DS.'modules.php');

require(HMVCCOREPATH.'abstract'.DS.'controller.php');
require(HMVCCOREPATH.'abstract'.DS.'model.php');

//get all modules
$mdl = new Modules();
$modules = $mdl->getAll();

// assign modules to containers modules object.
$container = $app->getContainer();
$container['Modules'] = function ($c) {
  $modulesObj = (object)array("success"=>false);
  //print_r($modules);die;
	foreach ($GLOBALS['modules'] as $module) {
      require $module->Path.$module->Controller;
	  $n = $module->Name;
      $modulesObj->$n = new $n($c);
    }
    return $modulesObj;
};

// initiate routes
foreach ($modules as $module) {
	require $module->Path.$module->Routes;
}
