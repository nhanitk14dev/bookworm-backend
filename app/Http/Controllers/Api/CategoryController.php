<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::select('id', 'category_name', 'category_desc')->get();
        return response([
            'categories' => $categories,
            'code'       => RESPONSE_CODES['request_success'],
        ], 200);
    }
}
