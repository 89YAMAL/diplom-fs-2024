<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HallPriceRequest extends FormRequest
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
            'vip_price'=>['exclude_unless: name, null', 'required', 'integer'], 
            'standart_price'=>['exclude_unless: name, null', 'required', 'integer'],
        ];
    }

    // public function messages() {
    //     return [
    
    //       'vip_price.required'=>'Поле "Цена VIP" - не заполнено',
    //       'vip_price.integer'=>'Поле "Цена VIP" - должно содержать цифры',
    //       'standart_pric.required'=>'Поле "Цена за стандартное место" - не заполнено',
    //       'standart_pric.integer'=>'Поле "Цена за стандартное место" - должно содержать цифры',

    //     ]; 
    //   }
}
