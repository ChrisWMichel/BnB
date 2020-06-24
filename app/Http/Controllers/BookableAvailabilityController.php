<?php

namespace App\Http\Controllers;

use App\Models\Bookable;
use Illuminate\Http\Request;

class BookableAvailabilityController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke($id, Request $request)
    {
        $data = $request->validate([
            'from' => ['required', 'date_format:Y-m-d', 'after_or_equal:now'],
            'to' => ['required', 'date_format:Y-m-d', 'after:from']
        ]);

        $bookable = Bookable::findOrFail($id);

        return $bookable->availableFrom($data['from'], $data['to']) ? response()->json(['Available'], 200) :  response()->json(['Not Available'], 404);

    }
}
