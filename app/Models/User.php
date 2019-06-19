<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
use function in_array;
use function strtolower;

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
        'login', 'token', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
}
