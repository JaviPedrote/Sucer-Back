<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Middleware\AnnouncementApiMiddleware;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Models\Announcement;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

//Routes Auth

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register'])->name('api.v1.register');
// Route::post('/forgot-password', ForgotPasswordController::class)->name('password.email');
// Route::post('/reset-password', ResetPasswordController::class)->name('password.reset');




Route::middleware('auth:api')->group(function () {

    Route::post('logout', [\App\Http\Controllers\Api\Auth\AuthController::class, 'logout'])->middleware('auth:api');

    //Usando el Route::apiResource. Contiene con la misma funcionalidad que las rutas anteriores
    Route::apiResource('categories', CategoryController::class)->names('api.v1.categories');

    //Routes Announcement
    Route::apiResource('announcements', AnnouncementController::class)->names('api.v1.announcements');
});


//Routes User
Route::get('users', [\App\Http\Controllers\Api\UserController::class, 'index'])->middleware('auth:api');
Route::get('users/{user}', [\App\Http\Controllers\Api\UserController::class, 'show'])->middleware('auth:api');
Route::put('users/{user}', [\App\Http\Controllers\Api\UserController::class, 'update'])->middleware('auth:api');
Route::delete('users/{user}', [\App\Http\Controllers\Api\UserController::class, 'destroy'])->middleware('auth:api');

//Routes Role
