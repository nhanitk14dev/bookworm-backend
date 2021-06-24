<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'book_id',
        'review_title',
        'review_detail',
        'review_date',
        'rating_star',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
