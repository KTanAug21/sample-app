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

// php-js with livewire
Route::get('/talk-to-me-page', function () {
    return view('talk-to-me.index');
});

// global local storage with fly-replay
Route::controller(\App\Http\Controllers\FileUploadController::class)->group(function(){
    Route::prefix('uploads')->group(function(){
        Route::get('show','show');
        Route::post('store','store')->middleware(['fly-replay']);
    }); 
});

