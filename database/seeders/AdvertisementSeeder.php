<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use App\Models\ImageLink;
use Illuminate\Database\Seeder;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Advertisement::factory()
            ->has(ImageLink::factory()->count(3))->count(30)->create();
    
    }
}
