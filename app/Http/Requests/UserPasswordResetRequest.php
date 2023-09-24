<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserPasswordResetRequest extends FormRequest {
    const UNPROCESSABLE_ENTITY = 422;

    public function rules() {
        return [
            'email'      => 'required|email|exists:users',
          ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), self::UNPROCESSABLE_ENTITY));
    }
}
