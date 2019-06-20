<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\AbstractController;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class LoginController
 * @package App\Http\Controllers\Auth\Api
 */
class LoginController extends AbstractController
{
    /**
     * @param User    $user
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function login(User $user, Request $request)
    {
        $login = $request->json('login');
        $password = $request->json('password');

        if (empty($login) || empty($password)) {
            return JsonResponse::create(['error' => 'login or password is empty'], 403);
        }

        $user = $user->getByLogin($login);
        if (empty($user->count()) || !password_verify($password, $user['password'])) {
            return JsonResponse::create(['error' => 'login or password is empty'], 403);
        }

        $res = clone $user;
        $user->token_valid_until = Carbon::now()->addDays(7); //todo сделать красиво
        $user->save();

        return JsonResponse::create($res);
    }
}
