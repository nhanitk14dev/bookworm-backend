<?php

namespace App\Http\Resources;

use App\Http\Resources\DiscountResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $available_discount = $this->discount && $this->discount->discount_end_date > now();
        return [
            'id'               => $this->id,
            'category_id'      => $this->category_id,
            'author_id'        => $this->author_id,
            'book_title'       => $this->book_title,
            'slug'             => $this->slug,
            'book_summary'     => $this->book_summary,
            'book_price'       => $this->book_price,
            'book_cover_photo' => $this->book_cover_photo,
            'category_name'    => $this->category->category_name,
            'author_name'      => $this->author->author_name,
            'sub_price'        => $this->sub_price,
            'count_reviews'    => $this->count_reviews,
            'avg_rating_star'  => $this->avg_rating_star,
            'discount'         => new DiscountResource($this->discount),
        ];
    }
}
