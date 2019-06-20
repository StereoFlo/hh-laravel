<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AbstractController;
use App\Models\Weather;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * Class WeatherController
 * @package App\Http\Controllers\Admin
 */
class WeatherController extends AbstractController
{
    /**
     * @var Weather
     */
    private $weatherModel;

    /**
     * WeatherController constructor.
     *
     * @param Weather $weatherModel
     */
    public function __construct(Weather $weatherModel)
    {
        $this->weatherModel = $weatherModel;
    }

    /**
     * @param Request $request
     * @param int     $id
     *
     * @return RedirectResponse|View
     * @throws ClientExceptionInterface
     */
    public function addCity(Request $request, int $id = 0)
    {
        if (empty($request->request->count())) {
            $city = null;
            if ($id) {
                $city = $this->weatherModel->getByCityId($id);
            }
            return \view('weather.form', ['city' => $city]);
        }
        $city = $request->get('name');
        $this->weatherModel->updateWeather($city);
        return redirect()->route('admin_weather_list');
    }

    /**
     * @param int $cityId
     *
     * @return RedirectResponse
     */
    public function deleteCity(int $cityId): RedirectResponse
    {
        $this->weatherModel->removeByCityId($cityId);
        return redirect()->route('admin_weather_list');
    }

    /**
     * @return View
     */
    public function getList(): View
    {
        $cities = $this->weatherModel->getList();

        return \view('weather.list', ['cities' => $cities]);
    }

    /**
     * @param int $cityId
     *
     * @return View
     */
    public function show(int $cityId): View
    {
        $city = $this->weatherModel->getByCityId($cityId);

        return \view('weather.show', ['city' => $city]);
    }
}
