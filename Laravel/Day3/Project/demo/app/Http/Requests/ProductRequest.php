<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        return [
            "name" => "required|min:3|max:200|string",
            "description" => "nullable|string|max:1000",
            "price" => "required|numeric|min:0|max:9999.99",
            "quantity" => "required|integer|min:0",
            "category_id" => "required|exists:categories,id",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "name is required",
            "name.min" => "name must be at least 3 characters ",
            "price.required" => "price is required",
            "price.numeric" => "price must be a number",
            "quantity.integer" => "quantity must be a number",
            "category_id.required" => "category is required",
            "category_id.exists" => "this category does not exist",
        ];
    }
}
