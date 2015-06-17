<?php

/**
 * Controller/Index.php
 *
 * @package    SilexSkeletonORM
 * @author     David Sutherland <sutherland.dave@gmail.com>
 * @link       https://github.com/madebydavid/SilexSkeletonORM
 */

namespace Controller {
    
    use Silex\Application;
    use Silex\Api\ControllerProviderInterface;
    use Symfony\Component\HttpFoundation\Response;

    /**
     * The Index controller class
     * 
     * Very simple - just add whatever you want here
     * 
     */
    class Index implements ControllerProviderInterface {
        
        /**
         * Connects and binds the index route
         * 
         * @param Application   $app The current application
         * 
         * @return ControllerCollection   
         * 
         */
        public function connect(Application $app) {

            $indexController = $app['controllers_factory'];

            $indexController->get(
                '/',
                array($this, 'index') 
            )->bind('index');

            return $indexController;
        }

        /**
         * Controler for the index page
         * 
         * @param Application   $app The current application
         * 
         * @return mixed   
         * 
         */
        public function index(Application $app) {
              return $app['twig']->render('index.twig');
        }
        
    }
}
