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
        $books = Book::all();
        return response()->json([
            'products' => BookResource::collection($books),
        ]);
    }

    public function show($id)
    {
        //
    }

    public function getDiscountBooks()
    {
        $discount_books = Book::whereHas('discount', function (Builder $query) {
            $query->whereDate('discount_end_date', '>', date('Y-m-d'));
        })->take(10)->get();

        $data = count($discount_books) ? BookResource::collection($discount_books) : array();
        return response()->json([
            'discount_books' => $data,
            'totals'         => count($data),
        ]);
    }

    public function getRecommendedBooks()
    {
        $recommended_books = Book::with('discount')
            ->withAvg('reviews', 'rating_star')
            ->orderBy('reviews_avg_rating_star', 'desc')
            ->orderBy('book_price', 'asc')
            ->take(8)
            ->get();

        return response()->json([
            'popular_books' => $recommended_books->toArray(),
            'totals'        => count($recommended_books),
        ]);
    }

    public function getPopularBooks()
    {
        $popular_books = Book::with('discount')
            ->withCount('reviews')
            ->orderBy('reviews_count', 'desc')
            ->orderBy('book_price', 'asc')
            ->take(8)
            ->get();

        return response()->json([
            'popular_books' => $popular_books->toArray(),
            'totals'        => count($popular_books),
        ]);
    }
}
