<?php

namespace App\Http\Controllers;

use App\Models\Bookable;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Resources\ViewResource;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, Request $request)
    {
        $bookable = new ViewResource(Bookable::findOrFail('id'));

        return $bookable->reviews()->latest()->get();
    }

}
