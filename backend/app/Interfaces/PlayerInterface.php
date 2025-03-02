<?php

namespace App\Interfaces;

use App\Enums\HandSign;

interface PlayerInterface
{
    public function selectHandSign(): HandSign;
}
