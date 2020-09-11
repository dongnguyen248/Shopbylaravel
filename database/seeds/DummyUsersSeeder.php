<?php

use Illuminate\Database\Seeder;
use App\User;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $userData = [
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'isAdmin' => '1',
                'password' => bcrypt('07070707'),
            ],
            [
                'name' => 'User',
                'email' => 'user@mail.com',
                'isAdmin' => '0',
                'password' => bcrypt('07070707'),
            ],
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}