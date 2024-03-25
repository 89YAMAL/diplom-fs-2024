<?php

namespace App\Rules;

use App\Models\Session;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\DataAwareRule;

class Timeduration implements ValidationRule, DataAwareRule 
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    protected $data =[];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (Session::where('hall_id', $this->data['id'])
            ->where('minute_start', '<=', $value)
            ->where('minute_finish', '>=', $value)
           ) {$fail('Всё очень плохо!!!!');}
    }

    public function setData(array $data) 
    {
        $this->data = $data;
    }
}
