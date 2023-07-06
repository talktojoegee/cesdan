<?php

namespace Database\Seeders;

use App\Models\Qualification;
use Illuminate\Database\Seeder;

class QualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $qualifications = [
            ['qualification_name'=>'B.A'],
            ['qualification_name'=>'B.Agric'],
            ['qualification_name'=>'B.Arch'],
            ['qualification_name'=>'B.E.S'],
            ['qualification_name'=>'B.ED'],
            ['qualification_name'=>'B.Eng'],
            ['qualification_name'=>'B.L'],
            ['qualification_name'=>'B.Pharm'],
            ['qualification_name'=>'B.Phil'],
            ['qualification_name'=>'B.SC'],
            ['qualification_name'=>'B.SC(Ed)'],
            ['qualification_name'=>'BA(ed)'],
            ['qualification_name'=>'BDS'],
            ['qualification_name'=>'BLIS'],
            ['qualification_name'=>'BMLS'],
            ['qualification_name'=>'BTech'],
            ['qualification_name'=>'DVM'],
            ['qualification_name'=>'HND'],
            ['qualification_name'=>'LLB'],
            ['qualification_name'=>'M.P.P'],
            ['qualification_name'=>'M.Sc'],
            ['qualification_name'=>'MBA'],
            ['qualification_name'=>'MBBS'],
            ['qualification_name'=>'Milr'],
            ['qualification_name'=>'NCE'],
            ['qualification_name'=>'OND'],
            ['qualification_name'=>'Phd'],
            ['qualification_name'=>'others']
        ];
        foreach($qualifications as $qualification){
            Qualification::create($qualification);
        }
    }
}
