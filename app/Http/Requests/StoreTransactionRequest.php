<?php

namespace App\Http\Requests;

use App\Rules\IranBankCardNumber;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'source_card_number' => ['required', 'numeric', 'digits:16', new IranBankCardNumber()],
            'destination_card_number' => ['required', 'numeric', 'digits:16', new IranBankCardNumber()],
            'amount' => ['required', 'numeric', 'min:10000', 'max:500000000'],

        ];
    }
}
