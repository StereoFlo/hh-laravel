<?php

namespace App\Models;

use App\Infrastructure\WeatherFactory;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;
use OpenWeatherMapApi\OpenWeatherMap;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * Class Weather
 * @property string          city_id
 * @property CarbonInterface request_time
 * @property float           today_temp
 * @property float           today_max_temp
 * @property float           today_min_temp
 * @package App\Models
 */
class Weather extends Model
{
    /**
     * @param string $cityName
     *
     * @return OpenWeatherMap
     * @throws ClientExceptionInterface
     */
    public function updateWeather(string $cityName)
    {
        $owm = WeatherFactory::getOWM($cityName);
        if ($owm->getCount()) {
            foreach ($owm->getStack() as $data) {
                $self = new self();
                $self->city_id = $data->getSys()->getId();
                $self->request_time = Carbon::now();
                $self->today_temp = $this->calcCelsius($data->getMain()->getTemp());
                $self->today_max_temp = $this->calcCelsius($data->getMain()->getTempMax());
                $self->today_min_temp = $this->calcCelsius($data->getMain()->getTempMin());
                $self->save();
            }
        }
        return $owm;
    }

    /**
     * @param float $fahrenheit
     *
     * @return float
     */
    private function calcCelsius(float $fahrenheit): float
    {
        return ($fahrenheit - 32) * 5/9;
    }
}
