<?php

namespace Database\Seeders;

use App\Models\SectorTwo;
use Illuminate\Database\Seeder;

class SectorTwoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       $sectors = [
           ['sector_name'=>'Agro-Alied']
           ,['sector_name'=>'Auto-mobile']
           ,['sector_name'=>'Aviation']
           ,['sector_name'=>'Banking']
           ,['sector_name'=>'Brewery']
           ,['sector_name'=>'Building Material']
           ,['sector_name'=>'Chemical']
           ,['sector_name'=>'Conglomerate']
           ,['sector_name'=>'Construction']
           ,['sector_name'=>'Eng. Tech']
           ,['sector_name'=>'Food Beverage']
           ,['sector_name'=>'Foot Wear']
           ,['sector_name'=>'Health']
           ,['sector_name'=>'IndProduct']
           ,['sector_name'=>'InfoTech']
           ,['sector_name'=>'Insurance']
           ,['sector_name'=>'Leasing']
           ,['sector_name'=>'Manufacturing']
           ,['sector_name'=>'Maritime']
           ,['sector_name'=>'Mortgage']
           ,['sector_name'=>'Others']
           ,['sector_name'=>'Packaging']
           ,['sector_name'=>'Petroleum']
           ,['sector_name'=>'Printing Publishing']
           ,['sector_name'=>'Real Estate']
           ,['sector_name'=>'Road Transport']
           ,['sector_name'=>'Textiles']
       ];
       foreach($sectors as $sector){
           SectorTwo::create($sector);
       }
    }
}
