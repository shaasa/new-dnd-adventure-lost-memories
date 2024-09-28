<?php

namespace App\Domains\User\Actions;


use Illuminate\Support\Str;


class GenerateToken
{
    public function execute(): string
    {
        return hash('sha256', Str::random(32));
    }

}
