<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/series/create', [App\Http\Controllers\SeriesController::class, 'create']);
Route::post('/series', [App\Http\Controllers\SeriesController::class, 'store']);

Route::get('/my-series/{user}', [App\Http\Controllers\MySeriesController::class, 'displaySeries'])->name('my-series.show');


Route::post('/add-rating', [App\Http\Controllers\RateController::class, 'addRating'])->name('rating.add');

Route::get('/home', [App\Http\Controllers\ViewController::class, 'displayAll']);

Route::get('/my-series/{series}/edit', [App\Http\Controllers\SeriesController::class, 'edit'])->name('my-series.edit');
Route::patch('/my-series/{series}', [App\Http\Controllers\SeriesController::class, 'update'])->name('my-series.update');
Route::post('/my-series/{series}/delete', [App\Http\Controllers\SeriesController::class, 'delete']);

