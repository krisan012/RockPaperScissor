<?php

namespace App\Players;

use App\Enums\HandSign;
use App\Interfaces\PlayerInterface;

Class SmartComputerPlayer implements PlayerInterface
{
    public function selectHandSign(): HandSign
    {
        return HandSign::ROCK;
    }
}
