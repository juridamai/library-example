<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transactions')->insert(
            [
                'customer_id' => 1,
                'date' => '2023-09-09 12:00:00'
            ]
        );

        DB::table('item_transactions')->insert(
            [
                'transaction_id' => 1,
                'book_id' => 1,
                'qty' => 1
            ]
        );
    }
}
