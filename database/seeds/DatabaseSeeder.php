<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
// сначало RolesTableSeeder потом UsersTableSeeder иначе выдает ошибку
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
