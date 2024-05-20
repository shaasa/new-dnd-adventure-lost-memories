<?php
namespace App\Enums;

enum TypeEnum: string
{
    case Skill = 'skill';
    case Spell = 'spell';
    case Characteristic = 'characteristic';
    case Equipment = 'equipment';
}
