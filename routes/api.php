<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Api\LoginController;
use App\Http\Controllers\Auth\Api\RegisterController;
use App\Http\Controllers\Auth\Api\BeerController;
use App\Http\Controllers\Auth\Api\BeerStyleController;

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


Route::prefix('auth')->group(function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'registerUser']);

    Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
    Route::apiResource('/beer', BeerController::class)->middleware('auth:sanctum');
    Route::apiResource('/style', BeerStyleController::class)->middleware('auth:sanctum');
});

