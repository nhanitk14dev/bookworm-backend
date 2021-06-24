<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'discount_start_date',
        'discount_end_date',
        'discount_price',
        'book_summary',
    ];

    protected $casts = [
        'discount_start_date' => 'datetime:Y-m-d',
        'discount_end_date'   => 'datetime:Y-m-d',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
