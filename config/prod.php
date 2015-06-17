<?php

// configure your app for the production environment

$app['config'] = array(
    
    'db.options' => array(
        'driver'                => 'pdo_mysql',
        'dbname'                => 'skeleton-live',
        'user'                  => 'root',
        'password'              => ''
    ),
    
    'error.log.filename'        => __DIR__.'/../logs/app.log',
    
);
