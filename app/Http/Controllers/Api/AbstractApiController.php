<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AbstractController;

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
}
