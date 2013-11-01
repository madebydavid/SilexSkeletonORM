<?php
// /app/app.php

 
$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => __DIR__.'/view'
));

$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());

$app->register(new Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider, array(
	"orm.em.options" => array(
		"mappings" => array(
			array(
				"type"      => "yml",
				"namespace" => "Model",
				"path"      => realpath(__DIR__."/../config/doctrine"),
			),
		),
	),
));

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
		'db.options' => $app['config']['db.options']
));

require __DIR__.'/routes.php';

return $app;