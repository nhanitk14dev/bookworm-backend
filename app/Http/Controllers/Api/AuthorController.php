<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $authors = Author::select('id', 'author_name')->get();
        return response([
            'authors' => $authors,
            'code'    => RESPONSE_CODES['request_success'],
        ], 200);
    }
}
