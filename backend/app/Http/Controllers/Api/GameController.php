<?php

namespace App\Http\Controllers\Api;

use App\Enums\HandSign;
use App\Http\Controllers\Controller;
use App\Services\GameService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class GameController extends Controller
{
    private GameService $gameService;

    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    public function startGame(): \Illuminate\Http\JsonResponse
    {
        // Generate a unique session ID (UUID)
        $sessionId = Str::uuid()->toString();

        return response()->json([
            'message' => 'Game session started',
            'session_id' => $sessionId
        ]);
    }

    public function playRound(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'session_id' => ['required', 'string'],
            'handSign' => ['required', 'string', Rule::in(array_map(fn($handSign) => $handSign->value, HandSign::cases()))]
        ]);

        $playerHandSign = HandSign::from($validated['handSign']);
        $sessionId = $validated['session_id'];
        $roundResult = $this->gameService->play($playerHandSign);

        $cacheKey = "game_rounds_{$sessionId}";
        $rounds = Cache::get($cacheKey, []);

        // Store the new round
        $rounds[] = $roundResult;

        // Save rounds in cache for this session (1 hour expiration)
        Cache::put($cacheKey, $rounds, 3600);

        return response()->json([...$roundResult, 'session_id' => $sessionId]);
    }

    public function getSummary(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'session_id' => ['required', 'string']
        ]);

        $sessionId = $validated['session_id'];
        $cacheKey = "game_rounds_{$sessionId}";
        $rounds = Cache::get($cacheKey, []);

        if (count($rounds) < 10) {
            return response()->json([
                'message' => 'Game is still in progress. Play all 10 rounds first.',
                'rounds_played' => count($rounds)
            ], 400);
        }

        // Compute statistics
        $totalRounds = count($rounds);
        $player1Wins = count(array_filter($rounds, fn($r) => $r['result'] === 'lose'));
        $player2Wins = count(array_filter($rounds, fn($r) => $r['result'] === 'win'));
        $ties = count(array_filter($rounds, fn($r) => $r['result'] === 'draw'));

        $player1WinRate = round(($player1Wins / $totalRounds) * 100, 2) . '%';
        $player2WinRate = round(($player2Wins / $totalRounds) * 100, 2) . '%';

        // Clear session cache after summary
        Cache::forget($cacheKey);

        return response()->json([
            'total_rounds' => $totalRounds,
            'player_1_wins' => $player1Wins,
            'player_2_wins' => $player2Wins,
            'ties' => $ties,
            'player_1_win_percentage' => $player1WinRate,
            'player_2_win_percentage' => $player2WinRate
        ]);
    }

    public function resetGame(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'session_id' => ['required', 'string']
        ]);

        $sessionId = $validated['session_id'];
        $cacheKey = "game_rounds_{$sessionId}";

        Cache::forget($cacheKey);

        return response()->json(['message' => 'Game reset!', 'session_id' => $sessionId]);
    }
}
