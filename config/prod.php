<?php

// configure your app for the production environment

$app['config'] = array(
	'js.options' => array(
	),
	'db.options' => array(
		'driver'	=> 'pdo_mysql',
		'dbname'	=> '',
		'user'		=> '',
		'password'	=> ''
	)
);
