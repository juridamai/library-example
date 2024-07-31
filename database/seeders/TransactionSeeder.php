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
                'date' => '2024-07-20 12:00:00',
                'date_must_return' => '2024-07-27 12:00:00',
            ]
        );

        DB::table('item_transactions')->insert(
            [
                'transaction_id' => 1,
                'book_id' => 1,
                'qty' => 1
            ]
        );

        DB::table('item_transactions')->insert(
            [
                'transaction_id' => 1,
                'book_id' => 2,
                'qty' => 1
            ]
        );
    }
}
