<?php

namespace App\Players;

use App\Enums\HandSign;
use App\Interfaces\PlayerInterface;

Class RandomComputerPlayer implements PlayerInterface
{
    public function selectHandSign(): HandSign
    {
        $handSign = HandSign::cases();

        return $handSign[array_rand($handSign)];
    }
}
