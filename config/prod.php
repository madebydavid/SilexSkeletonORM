<?php

// configure your app for the production environment

$app['config'] = array(
    'js.options' => array(
    ),
    
    'db.options' => array(
        'driver'                => 'pdo_mysql',
        'dbname'                => '',
        'user'                  => '',
        'password'              => ''
    ),
    
    'error.log.filename'        => __DIR__.'/../logs/app.log',
    
    'admin.options' => array(
        'username' => '',
        'password' => ''
    ),
);
