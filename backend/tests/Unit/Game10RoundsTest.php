<?php

namespace Tests\Unit;

use Illuminate\Support\Str;
use Tests\TestCase;

class Game10RoundsTest extends TestCase
{
    /**
     * Test playing 10 rounds and then retrieving a summary.
     *
     * This test sends 10 POST requests to /api/play-round, simulating 10 rounds.
     * It then sends a GET request to /api/summary to ensure the summary reflects 10 rounds.
     */
    public function testTenRoundsAndSummary()
    {
        $sessionId = Str::uuid()->toString();
        // Play 10 rounds using the same session.
        for ($i = 0; $i < 10; $i++) {
            // For this test, I fix the player 2 move to "rock".
            $response = $this->postJson('/api/play-round', ['handSign' => 'rock', 'session_id' => $sessionId]);
            $response->assertStatus(200);
            $response->assertJsonStructure([
                'player_2', //player
                'player_1', //computer
                'result', // 'win', 'lose', or 'draw'
            ]);
        }

        // Retrieve the summary after 10 rounds.
        $summaryResponse = $this->getJson("/api/summary?session_id=$sessionId");
        $summaryResponse->assertStatus(200);
        $summaryResponse->assertJsonStructure([
            'total_rounds',
            'player_1_wins',
            'player_2_wins',
            'ties',
            'player_1_win_percentage',
            'player_2_win_percentage',
        ]);

        // Assert that the total rounds is 10.
        $this->assertEquals(10, $summaryResponse->json('total_rounds'));

        // Optional: Calculate the sum of wins and ties to be sure it totals 10.
        $totalRoundsCalculated =
            $summaryResponse->json('player_1_wins') +
            $summaryResponse->json('player_2_wins') +
            $summaryResponse->json('ties');

        $this->assertEquals(10, $totalRoundsCalculated);
    }
}
