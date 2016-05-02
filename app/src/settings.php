<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production

        // db settings
        'db' => [
          'username' => 'slimtest',
          'password' => 'password',
          'dbname'   => 'slimtest',
          'hostname' => 'localhost'
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-modular',
            'path' => APPPATH . 'logs'.DIRECTORY_SEPARATOR
            .date("Y").DIRECTORY_SEPARATOR
            .date("m F").DIRECTORY_SEPARATOR
            .'slim-modular-'.date("Ymd").'.log',
        ],
    ],
];
