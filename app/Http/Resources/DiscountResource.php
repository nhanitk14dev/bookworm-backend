<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DiscountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                  => $this->id,
            'book_id'             => $this->book_id,
            'discount_start_date' => $this->discount_start_date,
            'discount_end_date'   => $this->discount_end_date,
            'discount_price'      => $this->discount_price,
        ];
    }
}
