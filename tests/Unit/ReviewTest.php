<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Models\Review;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    public function testCreateReview()
    {
        $book = Book::latest()->first();
        $data = [
            "review_title"  => "This is good book for testing",
            "review_detail" => "Description for testing",
            "rating_star"   => 5,
        ];

        $response = $this->json('POST', '/api/v1/reviews/' . $book->id, $data)
            ->assertStatus(200)
            ->assertJsonStructure(['code']);
    }

    public function testDeleteReview()
    {
        $review   = Review::latest()->first();
        $response = $this->json('DELETE', '/api/v1/reviews/' . $review->id)
            ->assertStatus(200)
            ->assertJsonStructure(['code']);
    }

    public function testGetReviews()
    {
        $book = Book::latest()->first();
        $response = $this->json('GET', '/api/v1/reviews/' . $book->id)
            ->assertStatus(200)
            ->assertJsonStructure(['code']);
    }
}
