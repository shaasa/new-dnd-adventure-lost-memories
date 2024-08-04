<?php

namespace App\Domains\User\Requests;

use App\Domains\User\Data\UserCreateDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            [
                'name' => 'string|required|max:255',
                'game_id' => 'nullable|integer|exists:games,id', // 'character_id' => 'integer|exists:characters,id
                'discord_id' => 'required|integer|unique:App\Models\User,discord_id',
                'discord_name' => 'required|string|max:255',
                'is_admin' => 'nullable|boolean',
            ]
        ];
    }
}
