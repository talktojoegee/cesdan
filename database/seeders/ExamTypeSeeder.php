<?php

namespace Database\Seeders;

use App\Models\ExamType;
use Illuminate\Database\Seeder;

class ExamTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
          [
              'exam_name'=>'Foundation',
              'cost_per_paper'=>20000,
              'status'=>1,
          ], [
              'exam_name'=>'PE1',
              'cost_per_paper'=>25000,
              'status'=>1,
          ],[
              'exam_name'=>'PE2',
              'cost_per_paper'=>30000,
              'status'=>1,
          ],
        ];
        foreach($types as $type){
            ExamType::create($type);
        }
    }
}
