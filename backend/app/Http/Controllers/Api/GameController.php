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

        // Retrieve the current rounds from session
//        $rounds = Session::get('rounds', []);
//        $rounds[] = $roundResult;
//        Session::put('rounds', $rounds);
//        $roundResult['round'] = 1;
        return response()->json($roundResult);
    }

    public function GameSummary(): \Illuminate\Http\JsonResponse
    {
        $rounds = Session::get('rounds', []);

        if (count($rounds) < 10)
        {
            return response()->json(['error' => 'Not yet 10 rounds'], 400);
        }

        $summary = [
            'total_rounds' => count($rounds),
            'player_1_wins' => 0, //computer wins
            'player_2_wins' => 0, //player wins
            'ties' => 0
        ];

        //according to rule book
        // - "win" when the player's hand sing (player 2) beats the computer (player 1) hand sign
        // - "lose" when computer (player 1) beats player 2
        // - "draw" when they're the same.
        foreach ($rounds as $round)
        {
            if($round['result'] === 'win') {
                $summary['player_2_wins']++;
            } elseif ($round['result'] === 'lose') {
                $summary['player_1_wins']++;
            } elseif ($round['result'] === 'draw') {
                $summary['ties']++;
            }
        }

        // percentages
        $summary['player_1_win_percentage'] = ($summary['player_1_wins'] / $summary['total_rounds']) * 100;
        $summary['player_2_win_percentage'] = ($summary['player_2_wins'] / $summary['total_rounds']) * 100;

        return response()->json($summary);
    }
}
