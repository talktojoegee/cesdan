<?php

namespace Database\Seeders;

use App\Models\Discipline;
use Illuminate\Database\Seeder;

class DisciplineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       $disciplines = [
           ['discipline_name'=>'Accounting']
           ,['discipline_name'=>'Agric. Economics']
           ,['discipline_name'=>'Agricultural science']
           ,['discipline_name'=>'Architecture']
           ,['discipline_name'=>'Banking/finance']
           ,['discipline_name'=>'Biochemistry']
           ,['discipline_name'=>'Biochemistry']
           ,['discipline_name'=>'Biology']
           ,['discipline_name'=>'Botany']
           ,['discipline_name'=>'Business admin']
           ,['discipline_name'=>'Chem. Eng']
           ,['discipline_name'=>'Chemistry']
           ,['discipline_name'=>'Commerce']
           ,['discipline_name'=>'Computer engineering']
           ,['discipline_name'=>'Computer science']
           ,['discipline_name'=>'Economics']
           ,['discipline_name'=>'Education']
           ,['discipline_name'=>'Elect. Eng']
           ,['discipline_name'=>'English']
           ,['discipline_name'=>'Estate mgt']
           ,['discipline_name'=>'Fine Arts/Design']
           ,['discipline_name'=>'French']
           ,['discipline_name'=>'Geography']
           ,['discipline_name'=>'Geology']
           ,['discipline_name'=>'Global Finance']
           ,['discipline_name'=>'History']
           ,['discipline_name'=>'Human Resources']
           ,['discipline_name'=>'Inter. relation']
           ,['discipline_name'=>'Law']
           ,['discipline_name'=>'Linguistics']
           ,['discipline_name'=>'Literature']
           ,['discipline_name'=>'Marketing']
           ,['discipline_name'=>'Mass comm']
           ,['discipline_name'=>'Mathematics']
           ,['discipline_name'=>'Mech. Eng']
           ,['discipline_name'=>'Medicine']
           ,['discipline_name'=>'Others']
           ,['discipline_name'=>'Petro. Eng']
           ,['discipline_name'=>'Philosophy']
           ,['discipline_name'=>'Physics']
           ,['discipline_name'=>'Physiology']
           ,['discipline_name'=>'Prod. Eng']
           ,['discipline_name'=>'Public Finance']
           ,['discipline_name'=>'Quantity surv']
           ,['discipline_name'=>'Sociology']
           ,['discipline_name'=>'Statistics']
           ,['discipline_name'=>'Theater Arts']
           ,['discipline_name'=>'Zoology']
       ];
       foreach($disciplines as $discipline){
           Discipline::create($discipline);
       }
    }
}
