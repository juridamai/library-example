<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert(
            [
                ['code'=>'073a3501-b891-4028-953c-a26cdacafcce','title' => 'Lorem Ipsum','date_of_issue' => '2023-04-10','stock' => 23,'publisher_id' => 1],
                ['code'=>'073a3501-b891-4028-853c-a26cdacafcce','title' => 'Lorem Ipsum 2','date_of_issue' => '2023-04-10','stock' => 23,'publisher_id' => 1],
            ]
        );
    }
}
