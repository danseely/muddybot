<?php

// tests/Util/WeatherTest.php
namespace App\Tests\Util;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Util\Weather;

class WeatherTest extends WebTestCase {
    public function testGetWeather() {
        $weather = new Weather();
        $forecast = $weather->getWeatherForLocation([42.279594, -83.732124]);

        $this->assertArrayHasKey('forecast', $forecast);
        $this->assertNotNull($forecast['forecast']);
    }
}
