<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PasswordResetRequest extends FormRequest {
    const UNPROCESSABLE_ENTITY = 422;

    public function rules() {
        return [
            'id'                    => 'required|exists:users',
            'password'              => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
          ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), self::UNPROCESSABLE_ENTITY));
    }
}
