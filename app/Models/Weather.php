<?php

namespace App\Models;

use App\Infrastructure\WeatherFactory;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use OpenWeatherMapApi\OpenWeatherMap;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * Class Weather
 * @property string          city_id
 * @property CarbonInterface request_time
 * @property float           today_temp
 * @property float           today_max_temp
 * @property float           today_min_temp
 * @property string          city_user_query
 * @property string          city_name
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
                $self->city_user_query = $cityName;
                $self->city_name = ''; //$owm->getCity()->getName();
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
     * @return LengthAwarePaginator
     */
    public function getList()
    {
        $test = self::distinct()->select(['city_id', 'city_name', 'city_user_query'])->paginate(10);
        return $test;
    }

    /**
     * @param int $cityId
     *
     * @return self
     */
    public function getByCityId(int $cityId)
    {
        return self::where('city_id', $cityId)->get();
    }

    /**
     * @param int $cityId
     *
     * @return mixed
     */
    public function removeByCityId(int $cityId)
    {
        return self::where('city_id', $cityId)->delete();
    }

    /**
     * @param float $fahrenheit
     *
     * @return float
     */
    private function calcCelsius(float $fahrenheit): float
    {
        return ($fahrenheit - 273.15);
    }
}
