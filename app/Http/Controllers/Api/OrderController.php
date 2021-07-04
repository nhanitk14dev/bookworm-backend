<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        DB::transaction(function () use ($data) {
            $new_order               = new Order();
            $new_order->order_amount = count($data);
            $new_order->order_date   = now();
            $new_order->save();

            $order_items = array();
            foreach ($data as $key => $item) {
                $order_items[$key] = [
                    'book_id'  => $item['book_id'],
                    'quantity' => $item['quantity'],
                    'price'    => $item['price'],
                ];
            }

            $new_order_items = $new_order->orderItems()->createMany($order_items);
        });
        $result = array('code' => RESPONSE_CODES['request_success']);
        return response($result, 200);
    }
}
