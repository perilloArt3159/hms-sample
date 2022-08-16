<?php 

namespace App\Services;

use App\Services\BaseService; 
use App\Models\Hotel;
use App\Http\Resources\HotelCollection; 
use App\Http\Resources\HotelResource;

class HotelApiService extends BaseService
{
    /**
     * List Items
     * 
     * @param array $data 
     * 
     * @return HotelCollection
     */
    public function fetchItems(array $data): HotelCollection
    {
        $items  =   Hotel::query()
                        ->where(
                            function ($query) use ($data)
                            {
                                if (isset($data['search']))
                                {
                                    $search = "%{$data['search']}%";

                                    $query->where('name', 'like', $search);
                                }
                            }
                        )
                        ->when(
                            isset($data['sortByColumn']),
                            function ($query) use ($data)
                            {
                                $sortDirection = 'asc';
                                
                                if ($data['sortDirection'])
                                {
                                    $sortDirection = $data['sortDirection'];
                                }

                                $query->orderBy($data['sortByColumn'], $sortDirection);
                            }
                        )
                        ->paginate(
                            $perPage = $data['sizePerPage'] ?? 10,
                            $columns = ['*'],
                            $pageName = "page",
                            $page = $data['showPage'] ?? 1
                        );

        return new HotelCollection($items);
    }

    /**
     * Store Hotel
     * 
     * @param array $data
     * 
     * @return void
     */
    public function createItem(array $data): void
    {
        Hotel::create(
            [
                'name'    => $data['name'],
                'address' => $data['address'],
            ]
        );
    }

    /**
     * Fetch Item
     * 
     * @param string $slug 
     * 
     * @return HotelResource
     */
    public function fetchItem(string $slug): HotelResource
    {
        $item = Hotel::findBySlugOrFail($slug);

        return HotelResource::make($item);
    }

    /**
     * Update Hotel
     * 
     * @param array  $data
     * @param string $slug 
     * 
     * @return void
     */
    public function updateItem(array $data, string $slug): void
    {
        $item = Hotel::findBySlugOrFail($slug);

        $item->update(
            [
                'name'    => $data['name'],
                'address' => $data['address'],
            ]
        );
    }

    /**
     * Destroy Item
     * 
     * @param string $slug 
     * 
     * @return void
     */
    public function deleteItem(string $slug): void
    {
        $item = Hotel::findBySlugOrFail($slug);
        
        $item->delete();
    }
}