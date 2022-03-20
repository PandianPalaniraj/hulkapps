<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeSlotTableSeeder extends Seeder
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
                'time_slot' => '10:00 AM - 11:00 AM' 
            ],
            [
                'time_slot' => '11:00 AM - 12:00 AM' 
            ],
            [
                'time_slot' => '12:00 AM - 01:00 PM' 
            ],
            [
                'time_slot' => '01:00 PM - 02:00 PM' 
            ],
            [
                'time_slot' => '02:00 AM - 03:00 PM' 
            ],
            [
                'time_slot' => '03:00 AM - 04:00 PM' 
            ],
            [
                'time_slot' => '04:00 AM - 05:00 PM' 
            ],
            [
                'time_slot' => '05:00 AM - 06:00 PM' 
            ],
            [
                'time_slot' => '06:00 AM - 07:00 PM' 
            ],
        ];

        foreach ($data as $key => $value) {
            DB::table('time_slot')->insert($value);
        }
    }
}
