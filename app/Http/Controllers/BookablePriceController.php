<?php

namespace App\Http\Controllers;

use App\Models\Bookable;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookablePriceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke($id, Request $request)
    {
        $bookable = Bookable::findOrFail($id);

        $data = $request->validate([
            'from' => 'required|date_format:Y-m-d',
            'to' => 'required|date_format:Y-m-d|after_or_equal:from'
        ]);

        $days = (new Carbon($data['from']))->diffInDays(new Carbon($data['to'])) + 1;
        $price = $days * $bookable->price;

        return response()->json([
            'total' => $price,
            'breakdown' => [
                $bookable->price => $days
            ]
        ]);
    }
}
