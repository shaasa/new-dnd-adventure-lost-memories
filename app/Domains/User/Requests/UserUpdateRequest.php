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
            'name' => 'required|string|max:255',
            'discord_id' => 'required|string|max:255',
            'discord_name' => 'required|string|max:255',
            'discord_private_channel_id' => 'nullable|string|max:255',
            'is_admin' => 'required|boolean',
        ];
    }
}