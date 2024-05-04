<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacterSheet extends Model
{
    use HasFactory;

    protected $table = 'character_sheets';
    protected $fillable = ['name', 'value', 'type'];
}


