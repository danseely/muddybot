<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\Util\Weather;
use Symfony\Component\HttpFoundation\Request;

class WeatherController extends AbstractController {
	/**
	 * @Route("/weather", name="weather")
	 * @Template
	 */
	public function index(Request $request) {
		$zip = $request->request->get('_zip');

		// if we don't have $zip set, return our empty state data
		if (!$zip) {
			$return = [
				'muddy' =>
					'Enter you zip code to see if it’ll be muddy in 3 days',
				'zip' => null
			];
			return $return;
		}

		$weather = new Weather();

		// add 'muddy' forecast result to return
		$return = $weather->getWeatherForLocation($zip);

		// add requested zip to return, to show as placeholder
		$return['zip'] = $zip;

		return $return;
	}

	/**
	 * @Route("/test", name="test")
	 * @Template
	 */
	public function test(Request $request) {
		// return ['hello'];
		return $this->render('weather/test.html.twig');
	}

	/**
	 * @Route("/get-muddy-prediction", name="get-muddy-prediction")
	 * @Template
	 */
	public function getMuddyPrediction(Request $request) {
		return $this->render('weather/muddy.html.twig');
		// return ['hello'];
		$params = [];

		$zip = $request->request->get('zip');

		// if we don't have $zip set, return our empty state data
		if (!$zip) {
			$return = [
				'muddy' =>
					'Enter you zip code to see if it’ll be muddy in 3 days',
				'zip' => null
			];
			return $this->render('weather/muddy.html.twig', $return);
		}

		$weather = new Weather();

		// add 'muddy' forecast result to return
		$return = $weather->getWeatherForLocation($zip);

		// add requested zip to return, to show as placeholder
		$return['zip'] = $zip;

		return $this->render('weather/muddy.html.twig', $return);
	}
}
