<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = Book::select([
            'id',
            'category_id',
            'author_id',
            'book_title',
            'slug',
            'book_price',
            'book_cover_photo',
            'count_reviews',
            'sub_price',
            'avg_rating_star',
        ])->with(['discount', 'author']);

        $sort = $request->query('sortByKey');
        if (empty($sort) || $sort == 'sale') {
            $books->where('sub_price', '>', 0)->orderBy('sub_price', 'asc');
        } else {
            switch ($sort) {
                case 'highPrice':
                    $books->orderByDesc('sub_price');
                    break;
                case 'lowPrice':
                    $books->orderBy('sub_price', 'asc');
                    break;
                default:
                    // Sort by popular
                    $books->orderByDesc('count_reviews')->orderBy('sub_price', 'asc');
                    break;
            }
        }

        $filter_category = $request->query('fCategory');
        if (!empty($filter_category) && $filter_category != 'all') {
            $books->where('category_id', $filter_category);
        }

        $filter_author = $request->query('fAuthor');
        if (!empty($filter_author) && $filter_author != 'all') {
            $books->where('author_id', (int) $filter_author);
        }

        $filter_rating = $request->query('fRating');
        if (!empty($filter_rating) && $filter_rating != 'all') {
            $books->where('avg_rating_star', '>=', (int) $filter_rating);
        }

        $per_page = $request->query('perPage');
        $result   = empty($per_page) ? $books->paginate(8) : $books->paginate((int) $per_page);

        return response([
            'books' => $result,
            'code'  => RESPONSE_CODES['request_success'],
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
        $discount_books = Book::with('discount')
            ->where('sub_price', '>', 0)
            ->orderBy('sub_price', 'asc')
            ->take(10)
            ->get();

        return response([
            'discount_books' => BookResource::collection($discount_books),
            'totals'         => count($discount_books),
            'code'           => RESPONSE_CODES['request_success'],
        ], 200);
    }

    public function getRecommendedBooks()
    {
        $recommended_books = Book::with('discount')
            ->orderBy('avg_rating_star', 'desc')
            ->orderBy('book_price', 'asc')
            ->take(8)
            ->get();

        return response([
            'recommended_books' => BookResource::collection($recommended_books),
            'totals'            => count($recommended_books),
            'code'              => RESPONSE_CODES['request_success'],
        ], 200);
    }

    public function getPopularBooks()
    {
        $popular_books = Book::with('discount')
            ->orderBy('count_reviews', 'desc')
            ->orderBy('book_price', 'asc')
            ->take(8)
            ->get();

        return response([
            'popular_books' => BookResource::collection($popular_books),
            'totals'        => count($popular_books),
            'code'          => RESPONSE_CODES['request_success'],
        ], 200);
    }
}
