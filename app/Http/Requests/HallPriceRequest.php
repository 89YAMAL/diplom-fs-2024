<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HallPriceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'vip_price'=>['exclude_unless: name, null', 'required', 'integer'], 
            'standart_price'=>['exclude_unless: name, null', 'required', 'integer'],
        ];
    }
}
