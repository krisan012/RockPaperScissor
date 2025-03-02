<?php

namespace App\Rules;

use App\Enums\HandSign;

class RuleBook
{
    private array $winningHandSign = [
        HandSign::ROCK->value => HandSign::SCISSORS->value,
        HandSign::PAPER->value => HandSign::ROCK->value,
        HandSign::SCISSORS->value => HandSign::PAPER->value
    ];

    public function processWinner(HandSign $playerHandSign, HandSign $computerHandSign): string
    {
        if($playerHandSign === $computerHandSign)
        {
            return 'draw';
        }

        return $this->winningHandSign[$playerHandSign->value] === $computerHandSign->value ? 'win' : 'lose';
    }
}
