<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with('discount')->get();
        return response([
            'products' => BookResource::collection($books),
            'code'     => RESPONSE_CODES['request_success'],
        ], 200);
    }

    public function show($slug)
    {
        $book = Book::where('slug', $slug)->first();

        if ($book) {
            $result = [
                'book' => new BookResource($book),
                'code' => RESPONSE_CODES['request_success'],
            ];
        } else {
            $result = [
                'code'    => RESPONSE_CODES['item_not_found'],
                'message' => 'Item not found',
            ];
        }
        return response($result, 200);
    }

    public function getDiscountBooks()
    {
        $discount_books = Book::whereHas('discount', function (Builder $query) {
            $query->whereDate('discount_end_date', '>', date('Y-m-d'));
        })->take(10)->get();

        $data = count($discount_books) ? BookResource::collection($discount_books) : array();
        return response([
            'discount_books' => $data,
            'totals'         => count($data),
            'code'           => RESPONSE_CODES['request_success'],
        ], 200);
    }

    public function getRecommendedBooks()
    {
        $recommended_books = Book::with('discount')
            ->withAvg('reviews', 'rating_star')
            ->orderBy('reviews_avg_rating_star', 'desc')
            ->orderBy('book_price', 'asc')
            ->take(8)
            ->get();

        return response([
            'recommended_books' => $recommended_books->toArray(),
            'totals'            => count($recommended_books),
            'code'              => RESPONSE_CODES['request_success'],
        ], 200);
    }

    public function getPopularBooks()
    {
        $popular_books = Book::with('discount')
            ->withCount('reviews')
            ->orderBy('reviews_count', 'desc')
            ->orderBy('book_price', 'asc')
            ->take(8)
            ->get();

        return response([
            'popular_books' => $popular_books->toArray(),
            'totals'        => count($popular_books),
            'code'          => RESPONSE_CODES['request_success'],
        ], 200);
    }
}
