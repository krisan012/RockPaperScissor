<?php

namespace App\Enums;

enum HandSign: string
{
    case ROCK = 'rock';
    case PAPER = 'paper';
    case SCISSORS = 'scissors';

    // can easily add other hand sign
    // case GUN = 'gun';
}
