<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
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
                'role' => 'Admin'
            ],
            [
                'role' => 'Doctor'
            ],
            [
                'role' => 'Patient'
            ],
        ];


        foreach ($data as $key => $value) {
            DB::table('roles')->insert($value);
        }
    }
}
