<?php

namespace App\Util;

use DmitryIvanov\DarkSkyApi\DarkSkyApi;

class Weather {
    function getWeatherForLocation(array $location) {
        $forecast = (new DarkSkyApi('faee3540bda4fe77d5cf06d1615ead0d'))
            ->location($location[0], $location[1])
            ->forecast('minutely');

        return [
            'forecast' => $forecast->minutely()->summary()
        ];
    }
}