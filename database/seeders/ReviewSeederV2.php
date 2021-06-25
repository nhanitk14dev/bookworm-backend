<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReviewSeederV2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createDataReviews();
    }

    public function createDataReviews()
    {
        for ($i = 1; $i < 10; $i++) {
            DB::transaction(function () {
                $books     = \DB::table('books')->take(10)->get();
                $bad_books = \DB::table('books')->take(5)->get();

                $str_lorem = '- Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.';

                $review_title_good  = "Good book - " . Str::random(20);
                $review_title_bad   = "Bad book - " . Str::random(20);
                $review_detail_good = "Good - " . Str::random(40) . $str_lorem;
                $review_detail_bad  = "Bad - " . Str::random(40) . $str_lorem;

                foreach ($books as $key => $b) {
                    Review::firstOrCreate([
                        'book_id'       => $b->id,
                        'review_title'  => $b->book_title . ' - ' . $review_title_good,
                        'review_detail' => $b->book_title . ' - ' . $review_detail_good,
                        'review_date'   => $b->created_at,
                        'rating_star'   => 5,
                    ]);
                }

                foreach ($bad_books as $key => $b) {
                    Review::firstOrCreate([
                        'book_id'       => $b->id,
                        'review_title'  => $b->book_title . ' - ' . $review_title_bad,
                        'review_detail' => $b->book_title . ' - ' . $review_detail_bad,
                        'review_date'   => $b->created_at,
                        'rating_star'   => 1,
                    ]);
                }
            });
        }
    }
}
