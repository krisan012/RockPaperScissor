<?php

namespace App\Services;

use App\Enums\HandSign;
use App\Interfaces\PlayerInterface;
use App\Rules\RuleBook;

class GameService
{
    private PlayerInterface $randomComputerPlayer;
    private RuleBook $ruleBook;

    public function __construct(PlayerInterface $randomComputerPlayer, RuleBook $ruleBook)
    {
        $this->randomComputerPlayer = $randomComputerPlayer;
        $this->ruleBook = $ruleBook;
    }

    public function play(HandSign $playerHandSign): array
    {
        $computerHandSign = $this->randomComputerPlayer->selectHandSign();
        $result = $this->ruleBook->processWinner($playerHandSign, $computerHandSign);

        return [
            'player_2' => $playerHandSign->value, //player
            'player_1' => $computerHandSign->value, //computer
            'result' => $result  // 'win', 'lose', or 'draw'
        ];
    }
}
