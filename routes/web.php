<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\CareersController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[HomeController::class,'index']);
Route::get('/aboutus',[AboutUsController::class,'aboutusIndex']);
Route::get('/careers', [CareersController::class, 'index']);






