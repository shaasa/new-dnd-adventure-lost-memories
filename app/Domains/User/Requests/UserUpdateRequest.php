<?php

namespace App\Domains\User\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
                'discord_id' => 'required|integer',
                'discord_name' => 'required|string|max:255',
                'token' => 'required|string|max:255',
                'is_admin' => 'required|boolean',
            ]
        ];
    }
}