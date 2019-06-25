<?php

namespace App\Http\Controllers\Api\Weather;

use App\Http\Controllers\Api\AbstractApiController;
use App\Models\Weather;
use Illuminate\Http\JsonResponse;

/**
 * Class WeatherController
 * @package App\Http\Controllers\Api\Weather
 */
class WeatherController extends AbstractApiController
{
    /**
     * WeatherController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('ApiTokenCheck');
    }

    /**
     * @param Weather $weather
     *
     * @return JsonResponse
     */
    public function getList(Weather $weather): JsonResponse
    {
        return $this->decorate($weather->getFullList()->toArray());
    }
}
