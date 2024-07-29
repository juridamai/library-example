<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert(
            [
                ['member_id' => 'M001','name' => 'Joko','dob' => '1997-04-10'],
                ['member_id' => 'M002','name' => 'Susi','dob' => '1998-05-21'],
            ]
        );
    }
}
