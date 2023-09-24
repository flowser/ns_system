<?php

namespace App\Http\Requests;

use App\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRegisterRequest extends FormRequest {
    const UNPROCESSABLE_ENTITY = 422;

    public function rules() {
        return [
            'first_name'              =>'required',
            'last_name'               =>'required',
            'phone'                   => ['required', new PhoneRule, 'unique:users'],
            'email'                   =>'required|email|unique:users',
            'password'                =>'required|confirmed|min:6',
            'password_confirmation'   =>'required',
          ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), self::UNPROCESSABLE_ENTITY));
    }
}
