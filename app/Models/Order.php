<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'order_amount',
        'order_date',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
