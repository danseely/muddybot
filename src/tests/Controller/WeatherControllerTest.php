<?php

// tests/Controller/WeatherControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WeatherControllerTest extends WebTestCase {
	public function testShowWeatherReturns200() {
		$client = static::createClient();

		$client->request('GET', '/weather');

		$this->assertEquals(200, $client->getResponse()->getStatusCode());
	}

	public function testShowWeatherHasZipKey() {
		$client = static::createClient();

		$client->request('GET', '/weather');

		$this->assertContains('zip', $client->getResponse()->getContent());
	}

	public function testShowWeatherHasWillBeMuddyKey() {
		$client = static::createClient();

		$client->request('GET', '/weather');

		$this->assertContains('muddy', $client->getResponse()->getContent());
	}
}
