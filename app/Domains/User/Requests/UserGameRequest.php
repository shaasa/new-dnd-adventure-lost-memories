<?php

namespace App\Domains\User\Requests;

use App\Domains\User\Data\UserCreateDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserGameRequest extends FormRequest
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
                'user_id' => 'required|integer|exists:users,id',
                'game_id' => 'required|integer|exists:games,id'
            ]
        ];
    }
}