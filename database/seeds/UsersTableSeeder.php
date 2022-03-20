<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'role_id'    => 1,
                'name'       => 'Admin',
                'email'      => 'user@admin.com',
                'password'   => Hash::make('admin@password!'),
            ]
        ];

        foreach ($data as $key => $value) {
            DB::table('users')->insert($value);
        }
    }
}
