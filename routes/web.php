<?php

use Illuminate\Support\Facades\Route;


Route::view('/404-tenant','errors.404-tenant')->name('404.tenant');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
