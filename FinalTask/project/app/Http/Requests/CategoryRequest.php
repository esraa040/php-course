<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $category = $this->route('category');
        $id = is_object($category) ? $category->id : $category;

        return [
            "name" => "required|min:3|max:40|string|unique:categories,name," . $id,
            "description" => "required|min:12|max:255|string",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "name is required",
            "name.min" => "name must be at least 3 characters ",
            "name.unique" => "name is already exist",
            "description.required" => "description is required",
            "description.min" => "description must be at least 12 characters ",
        ];
    }
}
