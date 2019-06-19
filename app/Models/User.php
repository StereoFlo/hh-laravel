<?php

namespace App\Models;

use App\Infrastructure\Util;
use Exception;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Self_;

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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'token', 'role', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param int $offset
     * @param int $limit
     *
     * @return array
     */
    public function getList(int $offset = 0, int $limit = 10): array
    {
        /** @var Collection $users */
        $users = $this->skip($offset)
            ->take($limit)
            ->get();

        return $users->toArray();
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
        return self::findOrFail($id);
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
        if (empty(Util::getProperty($data, 'id'))) {
            return self::create([
                'login' => Util::getProperty($data, 'login'),
                'password' => Hash::make(Util::getProperty($data, 'password')),
                'token' => md5(env('APP_KEY') . date(time()) . mt_rand()),
                'role' => Util::getProperty($data, 'role', self::ROLE_USER),
            ]);
        }

        self::where('id', Util::getProperty($data, 'id'))->update([
            'login' => Util::getProperty($data, 'login'),
            'password' => Hash::make(Util::getProperty($data, 'password')),
            'token' => md5(env('APP_KEY') . date(time()) . mt_rand()),
            'role' => Util::getProperty($data, 'role', self::ROLE_USER),
        ]);

        return $this;
    }
}
