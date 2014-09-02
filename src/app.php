<?php

$app->register(new Silex\Provider\RoutingServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());

$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Saxulum\DoctrineOrmManagerRegistry\Provider\DoctrineOrmManagerRegistryProvider());

$app['form.extensions'] = $app->factory($app->extend('form.extensions', function ($extensions) use ($app) {
    $extensions[] = new Symfony\Bridge\Doctrine\Form\DoctrineOrmExtension($app['doctrine']);
    return $extensions;
}));

$app->register(new Silex\Provider\LocaleServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
        'translator.messages' => array(),
));

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/view',
    'twig.form.templates' => array('form_div_layout.html.twig', 'common/form_div_layout.html.twig'),
));

$app->register(new Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider, array(
    'orm.em.options' => array(
        'mappings' => array(
            array(
                'type'      => 'yml',
                'namespace' => 'Model',
                'path'      => realpath(__DIR__.'/../config/doctrine'),
            ),
        ),
    ),
));

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
        'db.options' => $app['config']['db.options']
));

require __DIR__.'/routes.php';

return $app;
