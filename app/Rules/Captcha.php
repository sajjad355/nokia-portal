<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use ReCaptcha\ReCaptcha;

class Captcha implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $recaptcha = new ReCaptcha(env('RECAPTCHA_SECRET_KEY'));
        // echo '<pre>'; print_r($recaptcha);die;
        $response = $recaptcha->verify($value, $_SERVER['REMOTE_ADDR']);
        // echo '<pre>'; print_r($response);die;
        return $response->isSuccess();

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please complete the recaptcha to proceed';
    }
}
