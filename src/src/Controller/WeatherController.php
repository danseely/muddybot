<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\Util\Weather;

class WeatherController extends AbstractController
{
    /**
     * @Route("/weather", name="weather")
     * @Template
     */
    public function index()
    {
        $weather = new Weather();

        $forecast = $weather->getWeatherForLocation([42.279594, -83.732124]);

        return $forecast;
    }
}
