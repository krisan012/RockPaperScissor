<?php

namespace Tests\Unit;

use App\Enums\HandSign;
use App\Interfaces\PlayerInterface;
use App\Rules\RuleBook;
use App\Services\GameService;
use PHPUnit\Framework\TestCase;

class FakePlayer implements PlayerInterface
{
    private HandSign $handSign;

    public function __construct(HandSign $handSign)
    {
        $this->handSign = $handSign;
    }

    public function selectHandSign(): HandSign
    {
        return $this->handSign;
    }
}

class GameServiceTest extends TestCase
{

    public function test_player_2_wins(): void
    {
        //Player 2 chooses ROCK and FakePlayer returns SCISSORS.
        // According to our rules, rock beats scissors, so the expected result is "win".
        $fakePlayer = new FakePlayer(HandSign::SCISSORS);
        $gameRules = new RuleBook();
        $gameService = new GameService($fakePlayer, $gameRules);

        $result = $gameService->play(HandSign::ROCK);

        $this->assertEquals('win', $result['result']);
        $this->assertEquals(HandSign::ROCK->value, $result['player_2']);
        $this->assertEquals(HandSign::SCISSORS->value, $result['player_1']);
    }

    public function testPlayerLoses()
    {
        // Player 2 chooses ROCK and FakePlayer returns PAPER.
        // According to our rules, paper beats rock, so the expected result is "lose".
        $fakePlayer = new FakePlayer(HandSign::PAPER);
        $gameRules = new RuleBook();
        $gameService = new GameService($fakePlayer, $gameRules);

        $result = $gameService->play(HandSign::ROCK);

        $this->assertEquals('lose', $result['result']);
        $this->assertEquals(HandSign::ROCK->value, $result['player_2']);
        $this->assertEquals(HandSign::PAPER->value, $result['player_1']);
    }

    public function testDraw()
    {
        // Both the player and FakePlayer choose ROCK.
        // Expected result is "draw".
        $fakePlayer = new FakePlayer(HandSign::ROCK);
        $gameRules = new RuleBook();
        $gameService = new GameService($fakePlayer, $gameRules);

        $result = $gameService->play(HandSign::ROCK);

        $this->assertEquals('draw', $result['result']);
        $this->assertEquals(HandSign::ROCK->value, $result['player_2']);
        $this->assertEquals(HandSign::ROCK->value, $result['player_1']);
    }

}
