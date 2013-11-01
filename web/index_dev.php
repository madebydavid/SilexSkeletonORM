<?php

use Symfony\Component\Debug\Debug;

require_once __DIR__.'/../vendor/autoload.php';

Debug::enable();

$app = new \Silex\Application();

require __DIR__.'/../config/dev.php';

require __DIR__.'/../src/app.php';

$app->run();