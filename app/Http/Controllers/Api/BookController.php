<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Book::leftJoin('reviews as rv', 'books.id', '=', 'rv.book_id')
            ->leftJoin('authors as au', 'books.author_id', 'au.id')
            ->join('discounts as d', 'd.book_id', '=', 'books.id');

        $books = $query->select(
            'books.id',
            'books.category_id',
            'books.book_title',
            'books.slug',
            'books.book_cover_photo',
            'books.book_price as book_price',
            'd.discount_end_date',
            'd.discount_price as discount_price',
            DB::raw('count(rv.book_id) as count_reviews'),
            DB::raw('book_price - discount_price as sub_price'),
            DB::raw('avg(rv.rating_star) as avg_rating_star')
        )->groupBy(
            'books.id',
            'sub_price',
            'discount_end_date',
            'discount_price',
        );

        $sort = $request->query('sortByKey');
        if (empty($sort) || $sort == 'sale') {
            /**
             * Default order by sale, the most discount price.
             * Price display: The discount price have an expired date. It is only available
             * when the current date is before its expired date or its expired date is null.
             * If a book has an available discount price, display it as a final price and put the book price
             * in front of it like the mock-up. Otherwise, only display the book price.
             */
            $books->whereDate('d.discount_end_date', '>', date('Y-m-d'))->orderBy('sub_price', 'asc');
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
            $books->where('author_id', $filter_author);
        }

        $filter_rating = $request->query('fRating');
        if (!empty($filter_rating) && $filter_rating != 'all') {
            // https://laravel.com/docs/8.x/queries#raw-methods
            $books->havingRaw('avg(rv.rating_star) > ?', [$filter_rating]);
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

    public function getReviews($book_id, Request $request)
    {
        $reviews = Review::where('book_id', $book_id);

        if ($request->query('sortByKey') == 'oldest') {
            $reviews->orderBy('review_date', 'asc');
        } else {
            $reviews->orderByDesc('review_date');
        }

        $per_page = $request->query('perPage');
        $result   = empty($per_page) ? $reviews->paginate(10) : $reviews->paginate((int) $per_page);

        return response([
            'reviews' => $result,
            'code'    => RESPONSE_CODES['request_success'],
        ], 200);
    }
}
