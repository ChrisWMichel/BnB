<?php

namespace App\Http\Controllers;

use App\Models\Bookable;
use Illuminate\Http\Request;
use App\Http\Resources\BookableReviewResource;

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

        return BookableReviewResource::collection($bookable->reviews()->latest()->get());
    }

}
