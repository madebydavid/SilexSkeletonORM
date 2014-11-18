<?php

use Silex\Provider\MonologServiceProvider;

// include the prod configuration
require __DIR__.'/prod.php';

// enable the debug mode
$app['debug'] = true;

$app['config'] = array(

    'js.options' => array(
    ),
    
    'db.options' => array(
        'driver'                => 'pdo_mysql',
        'dbname'                => '',
        'user'                  => '',
        'password'              => ''
    ),
    
    'error.log.filename'        => __DIR__.'/../logs/app-dev.log',
    
    'admin.options' => array(
        'username' => '',
        'password' => ''
    ),
    
    
);
