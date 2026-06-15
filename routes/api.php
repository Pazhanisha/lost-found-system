<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LostItemController;

Route::get('/items', [LostItemController::class, 'apiIndex']);
Route::post('/items', [LostItemController::class, 'apiStore']);
Route::put('/items/{id}', [LostItemController::class, 'apiUpdate']);
Route::delete('/items/{id}', [LostItemController::class, 'apiDelete']);