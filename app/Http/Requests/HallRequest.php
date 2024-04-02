<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HallRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules() 
    {
        return [
           'name'=>['required', 'string', 'unique:halls,name', 'min:1', 'max:10']
        ];
    }

    public function messages() 
    {
        return [
          'name.min'=>'Поле должно содержать минимум 1 символ',
          'name.max'=>'Поле должно содержать максимум 10 символов'
        ]; 
    }
}
