<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Seeder;

class DiscountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createDataDiscounts();
    }

    public function createDataDiscounts()
    {
        $books        = \DB::table('books')->take(6)->get();
        $current_date = date("Y-m-d");

        if (count($books)) {
            foreach ($books as $b) {
                Discount::firstOrCreate([
                    'book_id'             => $b->id,
                    'discount_price'      => 0.50,
                    'discount_start_date' => $current_date,
                    'discount_end_date'   => date('Y-m-d', strtotime($current_date . ' + 10 days')),
                ]);
            }
        }
    }
}
