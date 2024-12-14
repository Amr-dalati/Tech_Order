<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth Route

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/user/changePassword', [UserController::class, 'updatePassword']);
    Route::post('/logout', [Authcontroller::class, 'logout']);

    // User Routes
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::post('/user', [UserController::class, 'store']);
    Route::put('/user/{id}', [UserController::class, 'update']);
    Route::delete('/user/{id}', [UserController::class, 'delete']);

    // Tag Routes
    Route::get('/tag', [TagController::class, 'index']);
    Route::get('/tag/{id}', [TagController::class, 'show']);
    Route::post('/tag', [TagController::class, 'store']);
    Route::put('/tag/{id}', [TagController::class, 'update']);
    Route::delete('/tag/{id}', [TagController::class, 'destroy']);

    // category Routes
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category/{id}', [CategoryController::class, 'show']);
    Route::post('/category', [CategoryController::class, 'store']);
    Route::put('/category/{id}', [CategoryController::class, 'update']);
    Route::delete('/category/{id}', [CategoryController::class, 'destroy']);

    // customer Routes
    Route::get('/customer', [CustomerController::class, 'index']);
    Route::get('/customer/{id}', [CustomerController::class, 'show']);
    Route::post('/customer', [CustomerController::class, 'store']);
    Route::put('/customer/{id}', [CustomerController::class, 'update']);
    Route::delete('/customer/{id}', [CustomerController::class, 'destroy']);

    //meals Routes
    // customer Routes
    Route::get('/meal', [MealController::class, 'index']);
    Route::get('/meal/{id}', [MealController::class, 'show']);
    Route::post('/meal', [MealController::class, 'store']);
    Route::put('/meal/{id}', [MealController::class, 'update']);
    Route::delete('/meal/{id}', [MealController::class, 'destroy']);
});
