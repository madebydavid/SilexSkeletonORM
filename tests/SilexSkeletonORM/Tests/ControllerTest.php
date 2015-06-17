<?php

namespace SilexSkeletonORM\Tests {

    class ControllerTest extends Base {

        public function testIndex() {

            $client = static::createClient();
            $client->request('GET', '/');

            $this->assertEquals(200, $client->getResponse()->getStatusCode());

        }

        public function test404() {

            $client = static::createClient();
            $client->request('GET', '/this-is-a-404');

            $this->assertEquals(404, $client->getResponse()->getStatusCode());

        }

    }
    
}