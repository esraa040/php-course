<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('id');

        return [
            "name" => "required|min:3|max:50|string",
            "email" => "required|email|unique:users,email," . $id,
            "role" => "required|in:user,admin",
            "password" => $id ? "nullable|min:6|confirmed" : "required|min:6|confirmed",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "name is required",
            "name.min" => "name must be at least 3 characters ",
            "email.required" => "email is required",
            "email.unique" => "email is already exist",
            "role.required" => "role is required",
            "role.in" => "role must be user or admin",
            "password.required" => "password is required",
            "password.min" => "password must be at least 6 characters ",
            "password.confirmed" => "password confirmation does not match",
        ];
    }
}
