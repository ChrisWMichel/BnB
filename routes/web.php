<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

/* --This works  */
//Route::get('/{any?}', function () {
//    return view('welcome');
//})->where('any', '.*');

Auth::routes();

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});


Route::view('/', 'welcome');
Route::view('/{any}', 'welcome');
Route::view('/{any}/{any1}', 'welcome');
