<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    //shor url
    Route::controller(\App\Http\Controllers\UrlShortenerController::class)->group(function (){
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::post('/url/shortener', 'urlShortener')->name('url.shortener');
    });
    //redirect short url
    Route::get('/{shortUrl}', [\App\Http\Controllers\ShortUrlRedirectController::class, 'redirectedToOriginalUrl'])
        ->where('shortUrl', '[A-Za-z0-9]{8,}')
        ->name('redirected.to.original.url');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
