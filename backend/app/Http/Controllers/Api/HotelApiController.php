<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hotel\StoreHotelRequest; 
use App\Http\Requests\Hotel\UpdateHotelRequest; 
use App\Http\Requests\Hotel\ListHotelRequest;
use App\Services\HotelApiService; 

class HotelApiController extends Controller
{
    /**
     * List Hotels
     * 
     * @param  ListHotelRequest $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ListHotelRequest $request) : \Illuminate\Http\JsonResponse
    {
        $items  =   (new HotelApiService())->fetchItems(
            data : $request->only(
                'search',
                'sizePerPage',
                'showPage',
                'sortByColumn',
                'sortDirection'
            )
        );  

        return response()->json(
            data : 
            [
                'message' => 'LIST OF HOTELS',
                'data'    => $items
            ]
        ); 
    }

    /**
     * Store Hotel
     * 
     * @param StoreHotelRequest $request 
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreHotelRequest $request): \Illuminate\Http\JsonResponse
    {        
        (new HotelApiService())->createItem(
            data : $request->only('name', 'address')
        );

        return response()->json(
            data : 
            [
                'message' => 'HOTEL CREATED',
                'data'    => null
            ]
        );
    }

    /**
     * Read Hotel
     * 
     * @param string $slug 
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function read(string $slug): \Illuminate\Http\JsonResponse
    {
        $item = (new HotelApiService())->fetchItem(
            slug : $slug
        );

        return response()->json(
            data : 
            [
                'message' => 'HOTEL FOUND',
                'data'    => $item
            ]
        );
    }

    /**
     * Update Hotel
     * 
     * @param UpdateHotelRequest $request
     * @param string $slug 
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateHotelRequest $request, string $slug): \Illuminate\Http\JsonResponse
    {
        (new HotelApiService())->updateItem(
            data : $request->only('name', 'address'), 
            slug : $slug
        );

        return response()->json(
            data: 
            [
                'message' => 'HOTEL UPDATED',
                'data'    => null
            ]
        );
    }

    /**
     * Destroy Hotel
     * 
     * @param string $slug 
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $slug): \Illuminate\Http\JsonResponse
    {
        (new HotelApiService())->deleteItem(
            slug : $slug
        );

        return response()->json(
            data  :
            [
                'message' => 'HOTEL DELETED',
                'data'    => null,
            ]
        );
    }
}
