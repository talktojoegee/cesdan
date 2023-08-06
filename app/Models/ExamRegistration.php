<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamRegistration extends Model
{
    use HasFactory;


    public function getUser(){
        return $this->belongsTo(User::class, 'user_id');
    }


    public function getExamType(){
        return $this->belongsTo(ExamType::class, 'exam_type_id');
    }


    public function getExamCourses(){
        return $this->hasMany(ExamRegistrationCourse::class, 'course_id');
    }


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


        public function getExamByUserId($userId){
            return ExamRegistration::where('user_id', $userId)->orderBy('id', 'DESC')->get();
        }






}
