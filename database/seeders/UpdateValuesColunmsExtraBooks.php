<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateValuesColunmsExtraBooks extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = Book::select([
            'id',
            'book_price',
            'sub_price',
            'count_reviews',
            'avg_rating_star',
        ])->withAvg('reviews', 'rating_star')
            ->withCount('reviews')
            ->with('discount')
            ->get();

        DB::transaction(function () use ($books) {
            foreach ($books as $b) {
                if ($b->discount && $b->discount->discount_end_date >= now()) {
                    $b->sub_price = ($b->book_price - $b->discount->discount_price);
                }

                if ($b->reviews_count > 0) {
                    $b->count_reviews = (int) $b->reviews_count;
                }

                if ($b->reviews_avg_rating_star) {
                    $b->avg_rating_star = $b->reviews_avg_rating_star;
                }
                $b->save();
            }
        });
    }
}
