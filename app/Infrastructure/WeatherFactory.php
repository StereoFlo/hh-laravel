<?php

namespace App\Infrastructure;

use AlexTartan\GuzzlePsr18Adapter\Client;
use OpenWeatherMapApi\City;
use OpenWeatherMapApi\OpenWeatherMap;
use OpenWeatherMapApi\Url;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * Class WeatherFactory
 * @package App\Infrastructure
 */
class WeatherFactory
{
    /**
     * @param string $cityName
     *
     * @return OpenWeatherMap
     * @throws ClientExceptionInterface
     * @throws \Exception
     */
    public static function getOWM(string $cityName): OpenWeatherMap
    {
        $city   = new City($cityName, null); // или буквенный указатель/или айди*
        $url    = new Url(env('OWM_KEY'), Url::TYPE_WEATHER, $city);
        $client = new Client();
        return new OpenWeatherMap($client, $url);
    }
}
