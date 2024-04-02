<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules() 
    {
        return [
            'title'=>['required', 'string','unique:films,title', 'min:3', 'max:255'], 
            'duration'=>['required', 'integer'], 
            'description'=>['required'], 
            'country'=>['required'], 
            'image'=>['required', 'mimes:jpg,jpeg,png'], 
        ];
    }

    public function messages() 
    {
      return [
        'title.min'=>'Поле должно содержать минимум 3 символа',
        'title.max'=>'Поле должно содержать ммаксимум 255 символов',
        'duration.integer'=>'Поле должно содержать целые числа',
        'image.mimes'=>'Поддерживаются только форматы jpg,jpeg,png',
      ]; 
    }
}
