<?php

// tests/Controller/WeatherControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WeatherControllerTest extends WebTestCase
{
    public function testShowWeatherReturns200()
    {
        $client = static::createClient();

        $client->request('GET', '/weather');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShowWeatherHasForecastKey()
    {
        $client = static::createClient();

        $client->request('GET', '/weather');

        $this->assertContains('forecast', $client->getResponse()->getContent());
    }
}
