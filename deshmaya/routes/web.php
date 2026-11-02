<?php

use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\QuoteRequestController;
use App\Http\Middleware\DiscardHoneypotSubmission;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/about-us', 'pages.about')->name('about');
Route::view('/products', 'pages.products.index')->name('products.index');
Route::get('/products/{slug}', fn (string $slug) => view('pages.products.show', ['slug' => $slug]))->name('products.show');
Route::view('/certification', 'pages.certification')->name('certification');
Route::view('/how-we-export', 'pages.how-we-export')->name('how-we-export');
Route::view('/export-markets', 'pages.export-markets')->name('export-markets');
Route::get('/contact-us', [ContactMessageController::class, 'create'])->name('contact');
Route::post('/contact-us', [ContactMessageController::class, 'store'])
    ->middleware(['throttle:forms', DiscardHoneypotSubmission::class])
    ->name('contact.submit');
Route::get('/request-a-quote', [QuoteRequestController::class, 'create'])->name('request-quote');
Route::post('/request-a-quote', [QuoteRequestController::class, 'store'])
    ->middleware(['throttle:forms', DiscardHoneypotSubmission::class])
    ->name('request-quote.submit');
