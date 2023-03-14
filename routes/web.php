<?php

use App\Http\Controllers\OpenAiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(OpenAiController::class )->group(function (){

    Route::get('/prompt', 'index')->name('prompt.page');
    Route::post('/prompt/search', 'search')->name('prompt.search');
});


