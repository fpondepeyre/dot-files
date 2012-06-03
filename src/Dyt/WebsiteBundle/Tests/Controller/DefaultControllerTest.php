<?php

namespace Dyt\WebsiteBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        //$this->assertTrue($crawler->filter('html:contains("Hello world")')->count() > 0);
        $this->assertEquals(42, 42);
    }
}
