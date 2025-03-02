<?php

use App\Http\Controllers\Api\GameController;
use Illuminate\Support\Facades\Route;

Route::post('/play-round', [GameController::class, 'playRound']);
