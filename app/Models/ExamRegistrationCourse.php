<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamRegistrationCourse extends Model
{
    use HasFactory;


    public function getCourse(){
        return $this->belongsTo(ExamCourse::class, 'course_id');
    }
    public static function registerExamCourses($examId, $courseId){
        $course = new ExamRegistrationCourse();
        $course->exam_reg_id = $examId;
        $course->course_id = $courseId;
        $course->save();
        return $course;
    }





}
