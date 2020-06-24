<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ViewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'bookable_id' => $this->bookable_id,
            'booking_id' => $this->booking_id,
            'rating' => $this->rating,
            'content' => $this->content,
            'created_at' => $this->created_at
        ];
    }
}
