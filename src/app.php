<?php

/* Bootstrapping... */
date_default_timezone_set('Europe/London');

$app->register(new Silex\Provider\RoutingServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());

$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Saxulum\DoctrineOrmManagerRegistry\Provider\DoctrineOrmManagerRegistryProvider());

$app['form.extensions'] = $app->factory($app->extend('form.extensions', function ($extensions) use ($app) {
    $extensions[] = new Symfony\Bridge\Doctrine\Form\DoctrineOrmExtension($app['doctrine']);
    return $extensions;
}));

/* translations and i18n */
$app->register(new Silex\Provider\LocaleServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
        'translator.messages' => array(),
));

/* templating */
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/view',
    'twig.form.templates' => array('form_div_layout.html.twig', 'common/form_div_layout.html.twig'),
));


$app->register(new Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider, array(
    'orm.proxies_dir' => sprintf('%s/doctrine/proxy', realpath(sprintf('%s/../cache', __DIR__))),
    'orm.auto_generate_proxies' => true,
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

/* load the database configurations */
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
        'db.options' => $app['config']['db.options']
));

/* sessions */
$app->register(new Silex\Provider\SessionServiceProvider());

/*
 * Security stuff - to use this, add the following to composer.json deps:
 *  
 *     "symfony/security": "2.6.*",
 * 
$encoder = new \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder();
$app['security.firewalls'] = array(
    'admin' => array(
        'pattern' => '^/admin/.*$',
        'http' => true,
        'users' => array(
            $app['config']['admin.options']['username'] => array(
                'ROLE_ADMIN',
                $encoder->encodePassword(
                    $app['config']['admin.options']['password'], null
                )
            )
        )
    ),
    'everything-else' => array(
        'pattern' => '^/((?!admin/?$).)*$',
        'anonymous' => true
    )
);

$app->register(new Silex\Provider\SecurityServiceProvider(array()));
*/

/* logging */
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => $app['config']['error.log.filename'],
    'monolog.name' => 'my-silex-app'
));

/* in the front-end - add the chrome debugger if we're in the dev app */
$app->extend('monolog', function ($monolog, $app) use ($app) {
    if ($app['debug']) {
        $monolog->pushHandler(new Monolog\Handler\ChromePHPHandler());
    }
    return $monolog;
});

require __DIR__.'/routes.php';

return $app;
