<?php

namespace App\Models;

use App\Infrastructure\WeatherFactory;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
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
     * @param string   $cityName
     *
     * @param int|null $id
     *
     * @return OpenWeatherMap|null
     * @throws ClientExceptionInterface
     */
    public function updateWeather(?string $cityName, int $id = null): ?OpenWeatherMap
    {
        try {
            $owm = WeatherFactory::getOWM($cityName, $id);
            if ($owm->getCount()) {
                foreach ($owm->getStack() as $data) {
                    $self = new self();
                    $self->city_id = $owm->getCityId();
                    $self->city_user_query = $cityName ? $cityName : $this->city_user_query;
                    $self->city_name = $owm->getCityName();
                    $self->request_time = Carbon::now();
                    $self->today_temp = $this->calcCelsius($data->getMain()->getTemp());
                    $self->today_max_temp = $this->calcCelsius($data->getMain()->getTempMax());
                    $self->today_min_temp = $this->calcCelsius($data->getMain()->getTempMin());
                    $self->save();
                }
            }
            return $owm;
        } catch (\Exception $exception) {
            return null;
        }
    }

    /**
     * @param bool $withoutPaginate
     *
     * @return LengthAwarePaginator|Collection
     */
    public function getShortList(bool $withoutPaginate = false)
    {
        if ($withoutPaginate) {
            return self::select(['city_id', 'city_name', 'city_user_query'])->get();
        }
        $test = self::distinct()->select(['city_id', 'city_name', 'city_user_query'])->paginate(10);
        return $test;
    }

    /**
     * @param bool $withoutPaginate
     *
     * @return LengthAwarePaginator|Collection
     */
    public function getFullList(bool $withoutPaginate = false)
    {
        if ($withoutPaginate) {
            return self::get();
        }
        return self::paginate(10);
    }

    /**
     * @param int $cityId
     *
     * @return self
     */
    public function getByCityId(int $cityId)
    {
        return self::where('city_id', $cityId)->paginate(10);
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
