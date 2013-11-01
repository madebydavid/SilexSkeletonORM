<?php

use Silex\Provider\MonologServiceProvider;

// include the prod configuration
require __DIR__.'/prod.php';

// enable the debug mode
$app['debug'] = true;

$app->register(new MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../logs/silex_dev.log',
));

$app['config'] = array(
	'js_options' => array(
		'foo' => 'bar' 
	),
	'db.options' => array(
		'driver'	=> 'pdo_mysql',
		'dbname'	=> '',
		'user'		=> '',
		'password'	=> ''
	)
);
