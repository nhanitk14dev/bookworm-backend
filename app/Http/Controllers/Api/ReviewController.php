<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{

    public function index($book_id, Request $request)
    {
        $reviews   = Review::where('book_id', $book_id);
        $meta_data = [
            'avg_rating_star' => number_format($reviews->get()->avg('rating_star'), 1),
            'five_star'       => $reviews->get()->where('rating_star', 5)->count(),
            'four_star'       => $reviews->get()->where('rating_star', 4)->count(),
            'three_star'      => $reviews->get()->where('rating_star', 3)->count(),
            'two_star'        => $reviews->get()->where('rating_star', 2)->count(),
            'one_star'        => $reviews->get()->where('rating_star', 1)->count(),
        ];

        if ($request->query('sortByKey') == 'oldest') {
            $reviews->orderBy('review_date', 'asc');
        } else {
            $reviews->orderByDesc('review_date');
        }

        $per_page = $request->query('perPage');
        $result   = empty($per_page) ? $reviews->paginate(10) : $reviews->paginate((int) $per_page);

        return response([
            'reviews'   => $result,
            'meta_data' => $meta_data,
            'code'      => RESPONSE_CODES['request_success'],
        ], 200);
    }

    public function store($book_id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'review_title' => 'required|max:120',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first(),
                'code'    => RESPONSE_CODES['item_not_failed'],
            ], 200);
        }

        $result = [];
        $book   = Book::find($book_id);
        if ($book) {
            DB::transaction(function () use ($book_id, $request) {
                $review                = new Review();
                $review->book_id       = $book_id;
                $review->review_title  = $request->input('review_title');
                $review->review_detail = $request->input('review_detail');
                $review->rating_star   = $request->input('rating_star');
                $review->review_date   = date('Y-m-d H:i:s');
                $review->save();
            });

            $result = array('code' => RESPONSE_CODES['request_success']);
        } else {
            $result = [
                'message' => 'The current book is not found',
                'code'    => RESPONSE_CODES['item_not_found'],
            ];
        }

        return response($result, 200);
    }
}
