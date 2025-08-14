<?php

use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\BookController;
use App\Http\Controllers\api\BorrowingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/user',[UserController::class,'index']);
Route::post('/user',[UserController::class,'store']);
Route::get('/user/{id}',[UserController::class,'show']);
Route::put('/user/{id}',[UserController::class,'update']);
Route::delete('/user/{id}',[UserController::class,'destroy']);
Route::post('/login',[UserController::class,'login']);

Route::get('/book',[BookController::class,'index']);
Route::get('/book/{id}',[BookController::class,'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/book',[BookController::class,'store']);
    Route::put('/book/{id}',[BookController::class,'update']);
    Route::delete('/book/{id}',[BookController::class,'destroy']);

    // Borrowing endpoints require an authenticated user
    Route::get('/borrowings', [BorrowingController::class, 'index']);
    Route::get('/my-borrowings', [BorrowingController::class, 'myBorrowings']);
    Route::post('/borrowings', [BorrowingController::class, 'store']);
    Route::put('/borrowings/{id}/return', [BorrowingController::class, 'returnBook']);
    Route::delete('/borrowings/{id}', [BorrowingController::class,'destroy']);
});

