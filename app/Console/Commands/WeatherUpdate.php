<?php

namespace App\Console\Commands;

use App\Models\Weather;
use App\Models\WeatherSchedule;
use Illuminate\Console\Command;
use Psr\Http\Client\ClientExceptionInterface;

class WeatherUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates weather';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param WeatherSchedule $weatherSchedule
     * @param Weather         $weather
     *
     * @return mixed
     * @throws ClientExceptionInterface
     */
    public function handle(WeatherSchedule $weatherSchedule, Weather $weather)
    {
        $list = $weatherSchedule->getByTime(date('H:i') . ':00'); //todo может быть можно сделать красивее, например, карбоном, но ДАТЕ работает быстрее
        if (empty($list->count())) {
            return 1;
        }

        $cities = $weather->getList(true);
        if (empty($cities->count())) {
            return 1;
        }

        foreach ($cities as $city) {
            $weather->city_user_query = !isset($city['city_user_query']) ?: $city['city_user_query'];
            $weather->updateWeather(null, $city['city_id']);
            continue;
        }

        return 0;
    }
}
