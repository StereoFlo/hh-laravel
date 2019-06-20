<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AbstractController;
use App\Models\Weather;
use Illuminate\Http\Request;

/**
 * Class WeatherController
 * @package App\Http\Controllers\Admin
 */
class WeatherController extends AbstractController
{
    public function addCity(Request $request, Weather $weatherModel)
    {
        $city = $request->get('city');
        $weatherModel->updateWeather($city);
        return response()->json('OK');
    }

    public function deleteCity()
    {

    }
}
