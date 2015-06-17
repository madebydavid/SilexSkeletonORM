<?php

use Silex\Provider\MonologServiceProvider;

// include the prod configuration
require __DIR__.'/prod.php';

// enable the debug mode
$app['debug'] = true;

$app['config'] = array(
    
    'db.options' => array(
        'driver'                => 'pdo_mysql',
        'dbname'                => 'skeleton-test',
        'user'                  => 'root',
        'password'              => ''
    ),
    
    'error.log.filename'        => __DIR__.'/../logs/app-test.log',

);
