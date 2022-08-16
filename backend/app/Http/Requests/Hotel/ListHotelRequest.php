<?php

namespace App\Http\Requests\Hotel;

use App\Http\Requests\ResponseRequest; 

class ListHotelRequest extends ResponseRequest
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
            'search'           => ['nullable', 'string'],
            'sizePerPage'      => ['nullable', 'integer'],
            'showPage'         => ['nullable', 'integer'],
            'sortByColumn'     => ['nullable', 'string'],
            'sortDirection'    => ['nullable', 'string']
        ];
    }
}
