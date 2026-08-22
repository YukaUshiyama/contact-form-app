<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
});

Route::get('/', [ContactController::class, 'index']);
Route::post('/contacts/confirm', [ContactController::class, 'confirm']);
Route::post('/contacts',[ContactController::class, 'store']);
Route::get('/thanks', [ContactController::class, 'thanks']);