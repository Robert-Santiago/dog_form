<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages/main');
});

Route::get('/fetch_dog', [App\Http\Controllers\DogController::class, 'produce_image'])->name('produce_image');


Route::get('/fetch_breeds', [App\Http\Controllers\DogController::class, 'fetchBreeds']); // da route to fetch the list of dog breeds
