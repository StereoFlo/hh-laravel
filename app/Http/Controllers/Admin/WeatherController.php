<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AbstractController;
use App\Models\Weather;
use App\Models\WeatherSchedule;
use Illuminate\Contracts\View\Factory;
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
        $res = $this->weatherModel->updateWeather($city);
        if (empty($res)) {
            return \view('weather.form', ['city' => $city, 'error' => 'city does not found or was an error while request processing']);
        }
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

    /**
     * @param WeatherSchedule $weatherSchedule
     *
     * @return Factory|View
     */
    public function getScheduleList(WeatherSchedule $weatherSchedule)
    {
        return \view('weather.schedule_list', ['schedules' => $weatherSchedule->getList()]);
    }

    /**
     * @param Request         $request
     * @param WeatherSchedule $weatherSchedule
     *
     * @return Factory|RedirectResponse|View
     */
    public function addSchedule(Request $request, WeatherSchedule $weatherSchedule)
    {
        if (empty($request->request->count())) {
            return \view('weather.schedule_form');
        }
        $city = $request->get('date');
        $weatherSchedule->store($city);
        return redirect()->route('admin_weather_schedule_list');
    }

    /**
     * @param WeatherSchedule $weatherSchedule
     * @param int             $id
     *
     * @return RedirectResponse
     */
    public function removeSchedule(WeatherSchedule $weatherSchedule, int $id)
    {
        $weatherSchedule->removeById($id);
        return redirect()->route('admin_weather_schedule_list');
    }
}
