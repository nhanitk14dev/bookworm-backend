<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
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
        $books    = \DB::table('books')->take(11)->get();
        $books_v2 = \DB::table('books')->take(8)->get();

        $review_title = [
            "Good and cheap book",
            "Good word for Goldman Sachs",
            "Good and replete with good advice",
            "Suitable with money to spend the book",
            "Very bad and very boring",
            "The book is too expensive",
            "Bad book and very boring",
            "Normal - not good book",
            "I love this book",
            "A nice book",
            "I don't like this book",
        ];

        $review_title_v2 = [
            "Comment v2 boring book",
            "Comment v2 expensive book",
            "Comment v2 bad book",
            "Comment v2 nice book",
            "Comment v2 love this book",
            "Comment v2 interesting book",
            "Comment v2 love and nice book",
            "Comment v2 very nice book",
        ];

        $review_detail = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

        $rating_star    = [4, 5, 5, 4, 1, 2, 1, 3, 5, 4, 2];
        $rating_star_v2 = [1, 2, 1, 4, 4, 5, 4, 5];

        if (count($books)) {
            foreach ($books as $key => $b) {
                Review::firstOrCreate([
                    'book_id'       => $b->id,
                    'review_title'  => $b->book_title . ' - ' . $review_title[$key],
                    'review_detail' => $b->book_title . ' - ' . $review_detail,
                    'review_date'   => $b->created_at,
                    'rating_star'   => $rating_star[$key],
                ]);
            }

            //Recommended
            foreach ($books_v2 as $key => $b) {
                Review::firstOrCreate([
                    'book_id'       => $b->id,
                    'review_title'  => $b->book_title . ' - ' . $review_title_v2[$key],
                    'review_detail' => $b->book_title . ' - ' . $review_detail,
                    'review_date'   => $b->created_at,
                    'rating_star'   => $rating_star_v2[$key],
                ]);
            }
        }
    }
}
