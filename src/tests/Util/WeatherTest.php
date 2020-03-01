<?php

// tests/Util/WeatherTest.php
namespace App\Tests\Util;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Util\Weather;

class WeatherTest extends WebTestCase {
    public function testGetWeather() {
        $weather = new Weather();
        $forecast = $weather->getWeatherForLocation([42.279594, -83.732124]);

        // $this->assertArrayHasKey('forecast', $forecast);
        // $this->assertNotNull($forecast['forecast']);

        $this->assertArrayHasKey('muddy', $forecast);
        $this->assertNotNull($forecast['muddy']);
    }

    public function testGeocodeZip() {
        $weather = new Weather();
        $json_result = $weather->geocodeZip('48104');

        $this->assertNotNull($json_result);

        $this->assertEquals("42.2660881", $json_result[0]);
        $this->assertEquals("-83.7146001", $json_result[1]);
    }
}
