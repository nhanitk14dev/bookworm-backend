<?php

namespace Tests\Unit;

use Illuminate\Http\Response;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateOrder()
    {
        $data = [
            [
                'book_id'  => 1,
                'quantity' => 5,
                'price'    => "1.5",
            ],
            [
                'book_id'  => 2,
                'quantity' => 4,
                'price'    => "2.5",
            ],
        ];

        $response = $this->json('POST', '/api/v1/orders', $data)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['code']);
    }
}
