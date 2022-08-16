<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * use App\Http\Requests\ResponseRequest
 * Extend this to your Requests instead of FormRequest in order to use
 */

abstract class ResponseRequest extends FormRequest
{
    /**
     * If validator fails return the exception in json form
     * @param Validator $validator
     * @return array
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    'message' => "Form values did not pass validation!",
                    'data'    => [$validator->errors()],
                ],
                422
            )
        );
    }

    abstract public function rules();
}
