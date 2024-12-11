<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetsController;
use Illuminate\Support\Facades\Route;

Route::post('/signup', [AuthController::class, 'register']);
Route::post('/signin', [AuthController::class, 'login']);

Route::get('/hello-world', function () {
   return response()->json([
       'message' => 'OK',
       'data' => [
           'name' => 'Alejandro Alvarez Botero'
       ]
   ]);
});

Route::prefix('pets')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/{pet}', [PetsController::class, 'show'])->name('show');
        Route::post('/', [PetsController::class, 'store'])->name('store');
        Route::patch('/{pet}', [PetsController::class, 'update'])->name('update');
        Route::delete('/{pet}', [PetsController::class, 'destroy'])->name('delete');
    });

    Route::get('/', [PetsController::class, 'index'])->name('index');
});
