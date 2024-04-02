<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HallConfigRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'rows'=>['required', 'integer'], 
            'seats'=>['required', 'integer'], 
        ];
    }
}
