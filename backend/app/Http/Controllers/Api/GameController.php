<?php

namespace App\Http\Controllers\Api;

use App\Enums\HandSign;
use App\Http\Controllers\Controller;
use App\Services\GameService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class GameController extends Controller
{
    private GameService $gameService;

    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    public function playRound(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'handSign' => ['required', 'string', Rule::in(array_map(fn($handSign) => $handSign->value, HandSign::cases()))]
        ]);

        $playerHandSign = HandSign::from($validated['handSign']);
        $roundResult = $this->gameService->play($playerHandSign);

        return response()->json($roundResult);
    }
}
