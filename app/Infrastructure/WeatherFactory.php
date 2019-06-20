<?php

namespace App\Infrastructure;

use AlexTartan\GuzzlePsr18Adapter\Client;
use Exception;
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
     * @param string|null $cityName
     * @param int|null    $id
     *
     * @return OpenWeatherMap
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public static function getOWM(?string $cityName, int $id = null): OpenWeatherMap
    {
        $city   = new City($cityName, $id); // или буквенный указатель/или айди*
        $url    = new Url(env('OWM_KEY'), Url::TYPE_WEATHER, $city);
        $client = new Client();
        return new OpenWeatherMap($client, $url);
    }
}
