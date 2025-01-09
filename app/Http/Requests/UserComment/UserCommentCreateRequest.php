<?php

namespace App\Http\Requests\UserComment;

use Illuminate\Foundation\Http\FormRequest;

class UserCommentCreateRequest extends FormRequest
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
            'user_id'=>'required|int',
            'post_id'=>'required|int',
            'rating'=>'required|int',
            'title'=>'nullable|string|max:128',
            'text'=>'nullable|string|max:1024',
        ];
    }
}
