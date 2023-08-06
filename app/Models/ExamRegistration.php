<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamRegistration extends Model
{
    use HasFactory;

        public static function registerExam($userId, $examType, $amount, $charge){
                $exam = new ExamRegistration();
                $exam->user_id = $userId;
                $exam->exam_type_id = $examType;
                $exam->total_amount = $amount;
                $exam->charge = $charge;
                $exam->ref_code = substr(sha1(time()), 31,40);
                $exam->save();
                return $exam;
        }

        public function getExamRegistrations(){
            return ExamRegistration::orderBy('id', 'DESC')->get();
        }






}
