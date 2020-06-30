<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('bookables', 'BookableController');
Route::get('bookables/{id}/availability', 'BookableAvailabilityController')->name('bookables.availability.show');
Route::get('bookables/{id}/reviews', 'BookableReviewController')->name('bookables.reviews.index');
Route::get('bookables/{id}/price', 'BookablePriceController')->name('bookables.price.show');
Route::get('booking-by-review/{reviewKey}', 'BookingByReviewController')->name('booking.by-review.show');

Route::apiResource('reviews', 'ReviewController')->only(['show', 'store']);
