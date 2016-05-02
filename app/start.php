<?php
define("APPPATH", __DIR__.'/');

require __DIR__ . '/../vendor/autoload.php';
session_start();

// Instantiate the app
$settings = require __DIR__ . '/src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/src/dependencies.php';

// Register middleware
require __DIR__ . '/src/middleware.php';

// setup modules *should reuired after middleware.php before routes.php*
 require(APPPATH.'/hmvc/autoload.php');

// Register routes
require __DIR__ . '/src/routes.php';

// Run app
$app->run();
