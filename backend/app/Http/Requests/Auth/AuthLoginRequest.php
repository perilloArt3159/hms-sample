<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ResponseRequest; 

use Illuminate\Support\Facades\Auth;

class AuthLoginRequest extends ResponseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email'     => ['required', 'email', 'string'],
            'password'  => ['required', 'string'],
        ];
    }
}
