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
    public function __construct()
    {
        parent::__construct();
        $this->middleware('ApiTokenCheck');
    }

    public function getList(Weather $weather)
    {
        return JsonResponse::create($weather->getList(true)->toArray());
    }
}
