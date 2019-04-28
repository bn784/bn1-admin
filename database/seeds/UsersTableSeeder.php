<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [

            ['id' => 1, 'name' => 'administrator', 'email' => 'administrator@example.com', 'password' => bcrypt('12345678'), 'role_id' => 1, 'remember_token' => '',],

            ['id' => 2, 'name' => 'user', 'email' => 'user@example.com', 'password' => bcrypt('12345678'), 'remember_token' => '',],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
