<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ManagerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = env('MANAGER_NAME');
        $email = \sprintf(
            "%s@%s",
            Str::lower($name),
            \parse_url(\config('app.url'), \PHP_URL_HOST)
        );

        User::factory()->makeOne([
            'name' => $name,
            'password' => Hash::make(env('MANAGER_PASSWORD')),
            'email' => $email, /* TODO: domain from env */
        ])->save();
    }
}
