<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

// Define una sola ruta para la raíz que apunte a tu controlador
Route::get('/', [ImageController::class, 'index']);
Route::resource('images', ImageController::class);
