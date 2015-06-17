<?php

namespace SilexSkeletonORM\Tests {

    use Silex\WebTestCase;
        
    use Symfony\Component\Debug\Debug;

    use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
    use Doctrine\Common\DataFixtures\Loader;
    use Doctrine\Common\DataFixtures\Purger\ORMPurger;

    abstract class Base extends WebTestCase {
        
        protected static $em;
        protected static $schemaTool;
        protected static $classes;

        public function createApplication() {
            global $app;
            return $this->app = $app;
        }
       
        public static function setUpBeforeClass() {
            /* init's the silex app and create the schema */
            global $app;

            Debug::enable();

            $app = new \Silex\Application();

            require 'config/test.php'; /* seperate config for the test db */
            require 'src/app.php';

            self::createSchema();

            $app['session.test'] = true;

        }

        public static function tearDownAfterClass() {
            self::dropSchema();
        }
        
        public function setUp() {
            global $app;

            try {
                /* delete the existing entities before each test */
                
                /* if we delete the entities the ids go out of sync, which means the data 
                 * in the fixures is not what the tests expect - guess we should use mocks 
                 * but I find that messy */
                 
                 /* so we kill the whole db before each test and then reload the fixtures */ 
                self::setUpBeforeClass();
                
                /* load the fixtures */
                $loader = new Loader();
                $loader->loadFromDirectory('config/doctrine/fixtures/');
                $fixtures = $loader->getFixtures();

                $purger = new ORMPurger($app['orm.em']);

                $purger->setPurgeMode(ORMPurger::PURGE_MODE_DELETE);
                $executor = new ORMExecutor($app['orm.em'], $purger);
                $executor->execute($fixtures);
            } catch (\Exception $e) {
                /* ignored */
            }

            parent::setUp();
        }

        protected static function createSchema() {
            global $app;
            
            self::$classes = $app['orm.em']->getMetadataFactory()->getAllMetadata();
            self::$schemaTool = new \Doctrine\ORM\Tools\SchemaTool($app['orm.em']);
            
             /* so that we don't get errors if the tables already exist */
            self::dropSchema();
         
            self::$schemaTool->createSchema(self::$classes);   
            
        }

        protected static function dropSchema() {
            try {
                self::$schemaTool->dropSchema(self::$classes);
            } catch (\Exception $e) {
                /* ignored */
            } 
        }
        
        protected function deleteEntities($em, $classes) {
            $em->getConnection()->query('SET FOREIGN_KEY_CHECKS=0');
            foreach ($classes as $class) {
                $em->createQuery(
                    sprintf('DELETE FROM %s', $class->getName())
                )->execute();
            }
            $em->getConnection()->query('SET FOREIGN_KEY_CHECKS=1');
            $em->flush();
        }
        
    }

}