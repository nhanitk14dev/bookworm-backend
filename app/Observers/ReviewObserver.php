<?php

namespace App\Observers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class ReviewObserver
{
    public function created(Review $review)
    {
        $this->updateBookReview($review->book_id);
    }

    public function deleted(Review $review)
    {
        $this->updateBookReview($review->book_id);
    }

    public function updateBookReview($book_id)
    {
        DB::transaction(function () use ($book_id) {
            $book = Book::where('id', $book_id)
                ->withAvg('reviews', 'rating_star')
                ->withCount('reviews')
                ->first();

            if ($book) {
                $book->count_reviews   = (int) $book->reviews_count;
                $book->avg_rating_star = $book->reviews_avg_rating_star;
                $book->save();
            }
        });
        return;
    }
}
