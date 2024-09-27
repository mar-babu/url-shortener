<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:api')->group( function () {
    //shor url
    Route::controller(\App\Http\Controllers\Api\UrlShortenerApiController::class)->group(function (){
        Route::get('/all/shortened/urls', 'index');
        Route::post('/url/shortener', 'urlShortener');
    });
});
