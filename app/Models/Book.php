<?php

namespace App\Models;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    public function discount()
    {
        return $this->hasOne(Discount::class);
    }
}
