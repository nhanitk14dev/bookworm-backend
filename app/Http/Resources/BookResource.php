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
        return [
            'id'               => $this->id,
            'category_id'      => $this->category_id,
            'author_id'        => $this->author_id,
            'book_title'       => $this->book_title,
            'slug'             => $this->slug,
            'book_summary'     => $this->book_summary,
            'book_price'       => $this->book_price,
            'book_cover_photo' => env('APP_URL') . '/products/' . $this->book_cover_photo,
            'discount'         => new DiscountResource($this->discount),
        ];
    }
}
