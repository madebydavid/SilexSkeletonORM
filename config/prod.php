<?php

// configure your app for the production environment

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
