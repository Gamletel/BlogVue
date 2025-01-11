<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'avatar' => 'sometimes|nullable|file|mimes:jpg,jpeg,png|max:2048',
            'name' => 'sometimes|nullable|string|min:5',
            'email' => 'sometimes|nullable|email|unique:users,email,' . $this->user()->id,
        ];
    }
}
