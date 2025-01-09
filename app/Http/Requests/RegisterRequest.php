<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:5|max:32|unique:users',
            'email' => 'nullable|email|unique:users',
            'password' => 'required|confirmed|min:5',
//            'avatar'=>'nullable|file|size:512'
            'remember' => 'nullable|boolean',
        ];
    }
}
