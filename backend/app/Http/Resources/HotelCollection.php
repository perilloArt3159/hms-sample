<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class HotelCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'items'         => $this->collection,
            'pagination'    =>
            [
                'size'      => $this->perPage() ?? null,
                'total'     => $this->total() ?? null,
                'current'   => $this->currentPage() ?? null,
            ],
        ];
    }
}
