<?php

use Illuminate\Support\Facades\Route;

// Phase 1: placeholder pages. Real controllers/views arrive in Phase 3 (products), 4 (forms) and 6 (pages).
Route::view('/', 'pages.home')->name('home');
Route::view('/about-us', 'pages.about')->name('about');
Route::view('/products', 'pages.products.index')->name('products.index');
Route::get('/products/{slug}', fn (string $slug) => view('pages.products.show', ['slug' => $slug]))->name('products.show');
Route::view('/certification', 'pages.certification')->name('certification');
Route::view('/how-we-export', 'pages.how-we-export')->name('how-we-export');
Route::view('/export-markets', 'pages.export-markets')->name('export-markets');
Route::view('/contact-us', 'pages.contact')->name('contact');
Route::view('/request-a-quote', 'pages.request-quote')->name('request-quote');
