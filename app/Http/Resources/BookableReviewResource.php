<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class BookableReviewResource extends JsonResource
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
            'rating' => $this->rating,
            'content' => $this->content,
            'created_at' => $this->created_at
        ];
        //Carbon::createFromTimestamp(strtotime($this->created_at))->diffForHumans()
    }
}
