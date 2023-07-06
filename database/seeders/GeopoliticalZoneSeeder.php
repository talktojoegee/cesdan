<?php

namespace Database\Seeders;

use App\Models\GeopoliticalZone;
use Illuminate\Database\Seeder;

class GeopoliticalZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            [
                "geo_name"=>"North Central (NC)",
            ],
            [
                "geo_name"=>"North East (NE)",
            ],
            [
                "geo_name"=>"North West (NW)",
            ],
            [
                "geo_name"=>"South East (SE)",
            ],
            [
                "geo_name"=>"South South (SS)",
            ],
            [
                "geo_name"=>"South West (SW)",
            ],
            [
                "geo_name"=>"Not Applicable (NA)",
            ],
        ];
        foreach($names as $name){
            GeopoliticalZone::create($name);
        }
    }
}
