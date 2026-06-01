<?php

namespace App\Rules;

use App\Services\ContactImageCaptcha;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ContactCaptchaRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $captcha = app(ContactImageCaptcha::class);
        $token = request()->input('captcha_token');
        $token = is_string($token) ? $token : null;

        if (! $captcha->verify(is_string($value) ? $value : null, $token)) {
            $captcha->clear($token);
            $fail('The security code does not match the image. Please try again.');
        }
    }
}
