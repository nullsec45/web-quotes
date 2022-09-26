<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{QuoteController,HomeController,QuoteCommentController,LikeController, NotificationController};
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|php
*/
Auth::routes();

Route::group(["middleware" => "auth"], function(){
    Route::resource("quotes", QuoteController::class, ["except" => ["index","show"]]);
    // Route::resource("quotes/comment", QuoteCommentController::class);
    Route::post("quotes/comment/{id}",[QuoteCommentController::class,"store"]);
    Route::get("quotes/comment/{id}/edit",[QuoteCommentController::class,"edit"]);
    Route::put("quotes/comment/{id}",[QuoteCommentController::class,"update"]);
    Route::delete("quotes/comment/{id}",[QuoteCommentController::class,"destroy"]);
    Route::get("like/{type}/{model}",[LikeController::class,"like"]);
    Route::get("unlike/{type}/{model}",[LikeController::class,"unlike"]);
    Route::get("notification",[NotificationController::class,"index"]);
});

Route::get('/home', [HomeController::class, 'index']);
Route::get('/profile/{name?}', [HomeController::class, 'profile']);
Route::get("/",[QuoteController::class,"index"]);
Route::get("quotes/category/{tag}",[QuoteController::class, "category"]);
Route::get("quotes/random", [QuoteController::class,"random"]);
Route::resource("quotes", QuoteController::class, ["only" => ["index", "show"]]);

