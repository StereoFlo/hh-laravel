<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AbstractController;
use App\Models\Weather;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Psr\Http\Client\ClientExceptionInterface;
use function view;

/**
 * Class WeatherController
 * @package App\Http\Controllers\Admin
 */
class WeatherController extends AbstractController
{
    /**
     * @param Request $request
     * @param Weather $weatherModel
     *
     * @return Factory|View
     * @throws ClientExceptionInterface
     */
    public function addCity(Request $request, Weather $weatherModel)
    {
        $city = $request->get('city');
        $weatherModel->updateWeather($city);
        return redirect()->route('');
    }

    public function deleteCity()
    {

    }

    public function getList()
    {

    }
}
