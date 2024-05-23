<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\ViewController::class, 'displayAll'])->name('home');

Auth::routes();

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'displayAdmin'])->middleware('isAdmin');
Route::get('/manager', [App\Http\Controllers\ManagerController::class, 'displayManager'])->name('manager');
Route::get('/series/create', [App\Http\Controllers\SeriesController::class, 'create']);
Route::post('/series', [App\Http\Controllers\SeriesController::class, 'store']);

Route::patch('/delete_user/{id}', [App\Http\Controllers\AdminController::class, 'delete']);

Route::get('/manager/series/{id}', [App\Http\Controllers\ManagerController::class, 'showSeries']);

Route::patch('/manager/enable/{id}', [App\Http\Controllers\ManagerController::class, 'enableUser']);

Route::get('/my-series/{user}', [App\Http\Controllers\MySeriesController::class, 'displaySeries'])->name('my-series.show');


Route::post('/add-rating', [App\Http\Controllers\RateController::class, 'addRating'])->name('rating.add');

Route::delete('/delete_user/{id}', [App\Http\Controllers\AdminController::class, 'delete']);

Route::get('/my-series/{series}/edit', [App\Http\Controllers\SeriesController::class, 'edit'])->name('my-series.edit');
Route::patch('/my-series/{series}', [App\Http\Controllers\SeriesController::class, 'update'])->name('my-series.update');
Route::post('/my-series/{series}/delete', [App\Http\Controllers\SeriesController::class, 'delete']);

