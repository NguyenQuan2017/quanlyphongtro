<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class Request extends FormRequest
{
    use ApiResponse;

    public function response(array $errors)
    {
        return new JsonResponse($errors, 422);
    }

    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator) {
        $errors = $validator->errors();
        $format_message = [];
        foreach ($errors->messages() as $name => $message) {
            if(!empty($message[0])) {
                $format_message[] = $message[0];
            }
        }
        throw new HttpResponseException($this->errorResponse($format_message));
    }
}
