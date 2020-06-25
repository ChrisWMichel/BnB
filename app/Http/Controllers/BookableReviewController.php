<?php

namespace App\Http\Controllers;

use App\Models\Bookable;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Resources\ReviewResource;

class BookableReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request
     * @return mixed
     */
    public function __invoke($id, Request $request)
    {
        $bookable = Bookable::findOrFail($id);

        return ReviewResource::collection($bookable->reviews()->latest()->get());
    }

}
