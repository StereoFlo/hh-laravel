<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserTableSeeder
 */
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->login = 'admin';
        $admin->role = User::ROLE_ADMIN;
        $admin->password = Hash::make(123);
        $admin->token = md5(mt_rand() . date(time()) . time());
        $admin->token_valid_until = Carbon::now();
        $admin->save();

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->login = 'user' . $i;
            $user->role = User::ROLE_USER;
            $user->password = Hash::make(123);
            $user->token = md5(mt_rand() . date(time()) . time());
            $user->token_valid_until = Carbon::now()->subDays(7);
            $user->save();
        }
    }
}
