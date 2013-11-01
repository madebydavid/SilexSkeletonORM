<?php

namespace Controller {
	
	use Silex\Application;
	use Silex\ControllerProviderInterface;
	use Symfony\Component\HttpFoundation\Response;

	class Index implements ControllerProviderInterface {
		
		public function connect(Application $app) {
			$indexController = $app['controllers_factory'];
			$indexController->get("/", array( $this, 'index' ) );
			return $indexController;
		}

		public function index(Application $app) {
			  return $app['twig']->render('index.twig');
		}
		
	}
}