<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

/**
 * Class ApiTokenCheck
 * @package App\Http\Middleware
 */
class ApiTokenCheck
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (empty($request->headers->get('x-api-token'))) {
            abort(403);
        }

        $user = new User();
        $user = $user->getByToken($request->headers->get('x-api-token'));
        if (empty($user['token']) || empty($user['token_valid_until']) || $user['token_valid_until']->timestamp <= time()) {
            abort(403);
        }
        return $next($request);
    }
}
