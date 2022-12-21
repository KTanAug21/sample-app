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

Route::get('/talk-to-me-page', function () {
    return view('talk-to-me.index');
});

Route::get('/uploads/show', [\App\Http\Controllers\FileUploadController::class,'show']);

Route::post('/uploads/update', [\App\Http\Controllers\FileUploadController::class,'update'])->middleware(['fly-replay']);;

