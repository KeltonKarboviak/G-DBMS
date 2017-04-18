<?php namespace App\Http\Validators;

use \Illuminate\Validation\Validator;
use Hash;

/**
 * Found idea for this class on this website: http://teamnik.org/how-to-update-user-password-in-laravel5/
 */
class HashValidator extends Validator {

    public function validateHash($attribute, $value, $parameters) {
        return Hash::check($value, $parameters[0]);
    }
}