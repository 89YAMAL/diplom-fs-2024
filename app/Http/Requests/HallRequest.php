<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HallRequest extends FormRequest
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
    public function rules() {
        return [
            'name'=>['required', 'string', 'unique:halls,name', 'min:1', 'max:10'], 
            // 'config'=>['exclude_unless: name, null', 'required', 'text'], // Поле будет проверятся, если name = null
            // 'vip_price'=>['c name, null', 'required', 'integer'], // Поле будет проверятся, если name  = null 
            // 'standart_price'=>['exclude_unless: name, null', 'required', 'integer'],
            // 'rows'=>['required', 'integer'], 
            // 'seats'=>['required', 'integer'], 
        ];
    }

    public function messages() {
      return [
        'name.min'=>'Поле должно содержать минимум 1 символ',
        'name.max'=>'Поле должно содержать максимум 10 символов',
        // 'config.required'=>'Поле "Конфигурация" - не заполнено, а должно быть заполнено',
        // 'vip_price.required'=>'Поле "Цена VIP" - не заполнено, а должно быть заполнено',
        // 'standart_pric.required'=>'Поле "Цена за стандартное место" - не заполнено, а должно быть заполнено',
        // 'rows.integer'=>'Поле "Ряды" - не заполнено, а должно быть заполнено',
        // 'seats.integer'=>'Поле "Ряды" - не заполнено, а должно быть заполнено',
      ]; 
    }
}
