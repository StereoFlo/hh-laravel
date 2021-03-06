<?php

namespace App\Http\Controllers\Auth;

use App\Infrastructure\Util;
use App\Models\User;
use App\Http\Controllers\AbstractController;
use function date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use function md5;
use function mt_rand;
use function time;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Auth
 */
class RegisterController extends AbstractController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'login' => ['required', 'string', 'max:20', 'unique:users'],
            'password' => ['required', 'string', 'min:2', 'confirmed'],
            'token' => ['required', 'string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function create(array $data): User
    {
        return User::create([
            'login' => Util::getProperty($data, 'name'),
            'password' => Hash::make(Util::getProperty($data, 'password')),
            'token' => Hash::make(md5(env('APP_KEY') . date(time()) . mt_rand())),
        ]);
    }
}
