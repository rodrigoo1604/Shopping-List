<?php

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;

Route::get('/articles', [ArticleController::class, 'index'])->name('apihome');
Route::delete('/articles/destroy/{id}', [ArticleController::class, 'destroy'])->name('apidestroy');
Route::post('/articles/store', [ArticleController::class, 'store'])->name('apistore');
Route::put('/articles/update/{id}', [ArticleController::class, 'update'])->name('apiupdate');
Route::get('/articles/truncate',[ArticleController::class, 'truncate'])->name('apitruncate');