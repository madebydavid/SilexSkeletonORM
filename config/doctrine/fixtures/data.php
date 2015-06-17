<?php

// config/doctrine/fixtures/data.php

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

class LoadBasicData implements FixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    private $manager;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function getManager() {
        return $this->manager;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setManager(ObjectManager $manager) {
        $this->manager = $manager;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {

        /* Add your fixtures here */
        
        /* force writes */
        $manager->flush();

    }

}
