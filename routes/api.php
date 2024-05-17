<?php

use App\Http\Controllers\API\TodoController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UserController::class, 'getUsers'])->middleware('auth:sanctum');

Route::prefix('todos')->controller(TodoController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'getOne');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
    Route::put('/{id}/complete', 'complete');
});

require __DIR__ . '/auth.php';
