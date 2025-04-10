<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [RegisterController::class, 'store'])->name('api.v1.register');

//Routes Categpry
// Route::get('categories', [CategoryController::class, 'index'])->name('api.v1.categories.index');
// Route::post('categories', [CategoryController::class, 'store'])->name('api.v1.categories.store');
// Route::get('categories/{category}', [CategoryController::class, 'show'])->name('api.v1.categories.show');
// Route::put('categories/{category}', [CategoryController::class, 'update'])->name('api.v1.categories.update');
// Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('api.v1.categories.destroy');

//Usando el Route::apiResource. Contiene con la misma funcionalidad que las rutas anteriores
Route::apiResource('categories', CategoryController::class)->names('api.v1.categories');

//Routes Announcement


//Routes User


//Routes Role
