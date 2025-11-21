<?php

use App\Http\Controllers\PizzaController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::resource('pizzas', PizzaController::class)
    ->only(['index']);
