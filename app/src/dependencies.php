<?php
// DIC configuration

$container = $app->getContainer();

//
$container['db'] = function ($c) {
    $settings = $c->get('settings')['db'];
    define( 'DB_HOST', $settings['hostname'] ); // set database host
    define( 'DB_USER', $settings['username'] ); // set database user
    define( 'DB_PASS', $settings['password'] ); // set database password
    define( 'DB_NAME', $settings['dbname'] ); // set database name
    define( 'SEND_ERRORS_TO', 'amit@khare.co.in' ); //set email notification email address
    define( 'DISPLAY_DEBUG', true ); //display db errors?

    require APPPATH.'hmvc'.DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR.'simplymysqli.php';
    $database = DB::getInstance();
    return $database;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};