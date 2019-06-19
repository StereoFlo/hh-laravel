<?php

namespace App\Http\Middleware;

use function abort;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Request;

/**
 * Class CheckAdmin
 * @package App\Http\Middleware
 */
class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (empty($request->user()) || !$request->user()->isAdmin()) {
            abort(401, 'This action is unauthorized.');
        }
        return $next($request);
    }
}
