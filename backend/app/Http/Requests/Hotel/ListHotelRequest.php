<?php

namespace App\Http\Requests\Hotel;

use App\Http\Requests\ResponseRequest; 

use Illuminate\Support\Facades\Auth;

class ListHotelRequest extends ResponseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
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
