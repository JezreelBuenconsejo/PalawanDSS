<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Anhskohbo\NoCaptcha\Facades\NoCaptcha;

class RecaptchaRule implements Rule
{
    public function passes($attribute, $value)
    {
        return NoCaptcha::verifyResponse($value);
    }

    public function message()
    {
        return 'The :attribute field is invalid.';
    }
}
