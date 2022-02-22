<?php

use App\Http\Controllers\WarriorsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("warriors/doc", [WarriorsController::class, "doc"]);

Route::get("warriors", [WarriorsController::class, "index"]);

Route::get("warriors/{id}", [WarriorsController::class, "show"]);

Route::post("warriors/create", [WarriorsController::class, "store"]);

// Route::get("warriors/update/{id}", [WarriorsController::class, "index"]);

// Route::get("warriors/delete/{id}", [WarriorsController::class, "index"]);
