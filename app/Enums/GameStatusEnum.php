<?php
namespace App\Enums;

enum GameStatusEnum: string
{
    case Ongoing = 'ongoing';
    case Finished = 'finished';
    case Suspended = 'suspended';
}
