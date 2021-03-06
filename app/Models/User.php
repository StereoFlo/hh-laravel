<?php

namespace App\Models;

use App\Infrastructure\Util;
use Exception;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable;

    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token'
    ];

    /**
     * @return LengthAwarePaginator
     */
    public function getList()
    {
        return $this->paginate(10);
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        if ($this->role !== self::ROLE_ADMIN) {
            return false;
        }

        return true;
    }

    /**
     * @param int $id
     * @return User
     */
    public function getById(int $id): self
    {
        return self::find($id);
    }

    /**
     * @param string $login
     *
     * @return self
     */
    public function getByLogin(string $login): self
    {
        return self::where('login', $login)->first();
    }

    /**
     * @param string $token
     *
     * @return self
     */
    public function getByToken(string $token): self
    {
        return self::where('token', $token)->first();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function removeById(int $id)
    {
        return self::where('id', $id)->delete();
    }

    /**
     * @param array $data
     *
     * @return User
     * @throws Exception
     */
    public function createOrUpdate(array $data): self
    {
        $toSave = [
            'login' => Util::getProperty($data, 'login'),
            'password' => Hash::make(Util::getProperty($data, 'password')),
            'token' => md5(env('APP_KEY') . date(time()) . mt_rand()),
            'role' => Util::getProperty($data, 'role', self::ROLE_USER),
        ];

        if (empty(Util::getProperty($data, 'id'))) {
            return self::create($toSave);
        }

        self::where('id', Util::getProperty($data, 'id'))->update($toSave);

        return $this;
    }
}
