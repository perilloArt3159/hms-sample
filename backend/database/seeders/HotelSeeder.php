<?php

namespace Database\Seeders;

use App\Models\Hotel;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //! Hardcoded for testing
        Hotel::create(
            [
                'name'    => 'Clark Marriott Hotel',
                'address' => '5398 Manuel A. Roxas Highway, Clark Freeport Zone, PH 2023'                
            ]
        ); 

        //! Randomly Generated 
        Hotel::factory(50)
            ->create(); 
    }
}
