<?php

use App\Http\Controllers\EmojiController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/emojis', [EmojiController::class, 'index'])->name('emojis.index');
Route::get('/emojis/{category}/{name}', [EmojiController::class, 'show'])->name('emojis.show');
Route::post('/emojis/{id}/favorite', [EmojiController::class, 'toggleFavorite'])->name('emojis.favorite');
