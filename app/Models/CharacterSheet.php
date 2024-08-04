<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $value
 * @property string $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|CharacterSheet newModelQuery()
 * @method static Builder|CharacterSheet newQuery()
 * @method static Builder|CharacterSheet query()
 * @method static Builder|CharacterSheet whereCreatedAt($value)
 * @method static Builder|CharacterSheet whereId($value)
 * @method static Builder|CharacterSheet whereName($value)
 * @method static Builder|CharacterSheet whereType($value)
 * @method static Builder|CharacterSheet whereUpdatedAt($value)
 * @method static Builder|CharacterSheet whereValue($value)
 * @mixin \Eloquent
 */
class CharacterSheet extends Model
{
    use HasFactory;

    protected $table = 'character_sheets';
    protected $fillable = ['name', 'value', 'type'];
}


