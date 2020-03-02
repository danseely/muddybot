<?php

namespace App\Util;

// https://github.com/dmitry-ivanov/dark-sky-api
use DmitryIvanov\DarkSkyApi\DarkSkyApi;

use \Datetime;
use \DateInterval;

class Weather {
	// const GOOGLE_MAPS_API_KEY = "AIzaSyCGXiB0TUNin5wYL0yE85nylYGsfo6Rb84";

	function getWeatherForLocation(string $zip) {
		// start with today
		$date = new DateTime();

		// add 3 days, that's our target
		$date->add(new DateInterval('P3D'));

		$location = $this->geocodeZip($zip);

		// $forecast = (new DarkSkyApi('faee3540bda4fe77d5cf06d1615ead0d'))
		$forecast = (new DarkSkyApi($_ENV['DARK_SKY_API_KEY']))
			->location($location['lat'], $location['long'])
			->timeMachine($date->format('Y-m-d'), ['daily']);

		// get our high temp & chance of precipitation
		// if it's over freezing, and there's at elase a 30% change of precip,
		// we'll consider that "muddy"
		$tempHigh = $forecast->daily()->temperatureHigh();
		$precipChance = $forecast->daily()->precipProbability();

		if ($tempHigh >= 32 && $precipChance > 0.3) {
			$muddy = true;
		} else {
			$muddy = false;
		}

		// craft a message, including the city name if we got one back
		$cityMessage = $location['city'] ? " in {$location['city']}" : '';
		$message = $muddy
			? "Yep, it's gonna be muddy$cityMessage! Better grab yer boots 😉"
			: "Nope, it shouldn’t be muddy$cityMessage! Grab those sandals! 😎";

		return ['muddy' => $message];
	}

	// see https://www.codeofaninja.com/2014/06/google-maps-geocoding-example-php.html
	function geocodeZip($zip) {
		// url encode the address
		$zip = urlencode($zip);

		// google map geocode api url
		$url =
			"https://maps.googleapis.com/maps/api/geocode/json?components=country:US%7Cpostal_code:{$zip}&key=" .
			$_ENV['GOOGLE_MAPS_API_KEY'];

		// get & decode the json response
		$resp_json = file_get_contents($url);
		$resp = json_decode($resp_json, true);

		// response status will be 'OK', if able to geocode given address
		if ($resp['status'] == 'OK') {
			// get the important data
			$lat = isset($resp['results'][0]['geometry']['location']['lat'])
				? $resp['results'][0]['geometry']['location']['lat']
				: '';
			$long = isset($resp['results'][0]['geometry']['location']['lng'])
				? $resp['results'][0]['geometry']['location']['lng']
				: '';
			$city = isset(
				$resp['results'][0]['address_components'][1]['long_name']
			)
				? $resp['results'][0]['address_components'][1]['long_name']
				: '';

			// verify if data is complete
			if ($lat && $long) {
				// put the data in the array
				$data_arr = ['lat' => $lat, 'long' => $long, 'city' => $city];

				return $data_arr;
			} else {
				return false;
			}
		} else {
			echo "<strong>ERROR: {$resp['status']}</strong>";
			return false;
		}
	}
}
