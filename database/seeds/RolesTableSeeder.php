<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [

            [
                'id' => 1,
                'title' => 'administrator',
                'management_access' => '1',
                'user_access' => '1',
                'user_create' => '1',
                'user_edit' => '1',
                'user_view' => '1',
                'user_delete' => '1',
                'role_access' => '1',
                'role_create' => '1',
                'role_edit' => '1',
                'role_view' => '1',
                'role_delete' => '1',
            ],
            [
                'id' => 2,
                'title' => 'user',
                'management_access' => '0',
                'user_access' => '0',
                'user_create' => '0',
                'user_edit' => '0',
                'user_view' => '0',
                'user_delete' => '0',
                'role_access' => '0',
                'role_create' => '0',
                'role_edit' => '0',
                'role_view' => '0',
                'role_delete' => '0',
            ],


        ];

        foreach ($items as $item) {
            \App\Role::create($item);
        }
    }
}
