<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Amnésia na hora de desenvolver, esquecimento dos commits granulares, vou comentando inicio e fim
// Inicio das rotas publicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Final das rotas publicas

Route::middleware('auth:api')->group(function () {
    //Inicio das rotas autenticadas para o usuario
    Route::get('/profile', [UserController::class, 'profile']);
    Route::put('/profile', [UserController::class, 'updateProfile']);
    //Final das rotas autenticadas para o usuario

    Route::middleware('admin')->group(function () {
        //Inicio das rotas autenticadas para o admin
        Route::get('/users', [UserController::class, 'index']);
        Route::put('/users/{user}', [UserController::class, 'update']);
        Route::delete('/users/{user}', [UserController::class, 'destroy']);
        //Final das rotas autenticadas para o admin
    });
});
