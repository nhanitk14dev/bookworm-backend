<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'author_id',
        'book_title',
        'slug',
        'book_summary',
        'book_price',
        'book_cover_photo',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function discount()
    {
        return $this->hasOne(Discount::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getBookCoverPhotoAttribute($value)
    {
        return '/products/' . $value;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
