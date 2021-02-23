<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::get( "/", [ HomeController::class, "home"] );
Route::post( "/", [ HomeController::class, "homePost"] );

Route::get( "/login", [ HomeController::class, "login"] );
Route::post( "/loginPost", [ HomeController::class, "loginPost"] );

Route::get( "/register", [ HomeController::class, "register"] );
Route::post( "/registerPost", [ HomeController::class, "registerPost"] );

Route::get( "/logOut", [ HomeController::class, "logOut"] );

Route::get( "/favory", [ HomeController::class, "favory"] );

Route::get( "/listFavories", [ HomeController::class, "listFavories"] );

Route::post( "/search", [ HomeController::class, "search"] );

Route::get( "/delete/{id}", [ HomeController::class, "delete"] );