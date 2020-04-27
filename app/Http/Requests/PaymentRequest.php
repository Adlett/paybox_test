<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'card' => [
                'required',
                'digits:16',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/^(6\d\d4){4}$/', $value)) {
                        $fail('Не совпадает маска карты (первые 6, последние 4)');
                    }
                }
            ],
            'month' => [
                'required',
                'integer',
                'min:1',
                'max:12',
                'digits:2'
            ],
            'year' => [
                'required',
                'integer',
                'digits:2'
            ],
            'cvv' => 'required|digits:3',
            'phone' => 'required',
            'email' => 'required|email',
        ];
    }
}
