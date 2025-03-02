<?php

use App\Http\Controllers\Api\GameController;
use Illuminate\Support\Facades\Route;

Route::post('/start', [GameController::class, 'startGame']);
Route::post('/play-round', [GameController::class, 'playRound']);
Route::get('/summary', [GameController::class, 'getSummary']);
Route::post('/reset', [GameController::class, 'resetGame']);
