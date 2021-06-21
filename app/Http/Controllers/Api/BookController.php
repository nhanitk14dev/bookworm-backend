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
}
