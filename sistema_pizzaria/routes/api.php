<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/cadastrar', [UserController::class, 'store']);

Route::prefix('/user')->group(function (){
    Route::get('/', [UserController::class, 'index']);
    Route::put('/att/{id}', [UserController::class, 'update']);
    Route::delete('/del/{id}', [UserController::class, 'destroy']);
});
