<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Exception;
use Illuminate\Http\JsonResponse;
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
            return new JsonResponse(['error' => 'token is empty or expired'], 403);
        }

        $user = new User();
        try {
            $user = $user->getByToken($request->headers->get('x-api-token'));
            if (empty($user['token']) || empty($user['token_valid_until']) || Carbon::parse($user['token_valid_until'])->timestamp <= time()) {
                return new JsonResponse(['error' => 'token is empty or expired'], 403);
            }
        } catch (Exception $exception) {
            return new JsonResponse(['error' => 'token is not found'], 403);
        }
        return $next($request);
    }
}
