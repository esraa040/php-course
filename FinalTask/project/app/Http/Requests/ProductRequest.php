<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $product = $this->route('product');
        $id = is_object($product) ? $product->id : $product;

        return [
            "name" => "required|min:3|max:60|string|unique:products,name," . $id,
            "description" => "required|min:12|max:255|string",
            "price" => "required|numeric|min:0",
            "quantity" => "required|integer|min:0",
            "category_id" => "required|exists:categories,id",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "name is required",
            "name.min" => "name must be at least 3 characters ",
            "name.unique" => "a product with this name already exists",
            "description.required" => "description is required",
            "description.min" => "description must be at least 12 characters ",
            "price.required" => "price is required",
            "quantity.required" => "stock is required",
            "quantity.integer" => "stock must be a whole number",
            "category_id.required" => "please choose a category",
        ];
    }
}
