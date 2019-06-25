<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AbstractController;
use App\Infrastructure\ApiWeatherDecorator;
use Illuminate\Http\JsonResponse;

/**
 * Class AbstractApiController
 * @package App\Http\Controllers\Api
 */
abstract class AbstractApiController extends AbstractController
{
    /**
     * AbstractApiController constructor.
     */
    public function __construct()
    {
        $this->middleware('ApiTokenCheck');
    }

    /**
     * @param array $data
     *
     * @return JsonResponse
     */
    protected function decorate(array $data): JsonResponse
    {
        return new JsonResponse(ApiWeatherDecorator::create($data)->decorate());
    }
}
