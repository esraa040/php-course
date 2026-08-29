<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            "order_id" => "required|exists:orders,id",
            "amount" => "required|numeric|min:0.01",
            "method" => "required|in:cash,card,wallet",
            "status" => "required|in:pending,paid,refunded",
            "paid_at" => "nullable|date",
        ];
    }

    public function messages(): array
    {
        return [
            "order_id.required" => "order is required",
            "order_id.exists" => "this order does not exist",
            "amount.required" => "amount is required",
            "amount.min" => "amount must be greater than zero",
            "method.in" => "method must be cash , card or wallet",
            "status.in" => "status must be pending , paid or refunded",
        ];
    }
}
