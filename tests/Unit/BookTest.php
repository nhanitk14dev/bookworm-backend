<?php

namespace Tests\Unit;

use App\Models\Book;
use Illuminate\Http\Response;
use Tests\TestCase;

class BookTest extends TestCase
{

    public function testGettingAllBooksWithFilters()
    {
        $response = $this->json('GET', '/api/v1/books?page=1&sortByKey=popular&perPage=8&fRating=4&fAuthor=1')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'books' => [
                        "data" => [
                            "*" => [
                                "id",
                                "category_id",
                                "author_id",
                                'slug',
                                'book_price',
                                'book_cover_photo',
                                'author',
                                'sub_price',
                                'count_reviews',
                                'avg_rating_star',
                                'discount',
                            ],
                        ],
                    ],
                ]
            );
    }

    public function testGetBookBySlug()
    {
        $book = Book::create(
            [
                'category_id'      => 1,
                'author_id'        => 1,
                'book_title'       => 'TESTING BRITISH TOUR',
                'slug'             => 'testing-british-tour-' . time(),
                'book_summary'     => "Little Miss Sunshine has bought a",
                'book_price'       => 3.5,
                'book_cover_photo' => 'tour.jpg', 1,
            ]
        );

        $response = $this->json('GET', '/api/v1/books/' . $book->slug)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'book' => [
                        "id",
                        "book_title",
                        'slug',
                        'book_summary',
                        'book_price',
                        'book_cover_photo',
                        "category_name",
                        'author_name',
                        'sub_price',
                        'count_reviews',
                        'avg_rating_star',
                        'discount',
                    ],
                ]
            );
    }

    public function testDeleteBook()
    {

        $latest_book = Book::latest()->first();
        $book        = $this->json('DELETE', '/api/v1/books/' . $latest_book->id)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['code']);
    }
}
