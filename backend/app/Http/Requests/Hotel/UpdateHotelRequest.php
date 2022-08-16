<?php

namespace App\Http\Requests\Hotel;

use App\Http\Requests\ResponseRequest; 

use Illuminate\Foundation\Http\FormRequest;

class UpdateHotelRequest extends ResponseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'    => ['required', 'string'],
            'address' => ['required', 'string'],
        ];
    }
}
