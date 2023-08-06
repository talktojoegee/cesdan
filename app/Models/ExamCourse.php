<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExamCourse extends Model
{
    use HasFactory;

    public function getExamType(){
        return $this->belongsTo(ExamType::class, 'exam_type_id');
    }

    public function addExamCourse(Request  $request){
        $course = new ExamCourse();
        $course->exam_type_id = $request->examType;
        $course->course = $request->courseName ?? null;
        $course->slug = Str::slug($request->courseName).'-'.Str::random(8) ?? null;
        $course->save();
        return $course;
    }

    public function editExamCourse(Request  $request){
        $course =  ExamCourse::find($request->courseId);
        $course->exam_type_id = $request->examType;
        $course->course = $request->courseName ?? null;
        $course->slug = Str::slug($request->courseName).'-'.Str::random(8) ?? null;
        $course->save();
        return $course;
    }

    public function getExamCourses(){
        return ExamCourse::all();
    }

    public function getExamCourseByExamTypeId($id){
        return ExamCourse::where('exam_type_id', $id)->get();
    }
  /*  public function getSelectedCourses($ids){
        return ExamCourse::whereIn('id', $ids)->get();
    }  */
    public static function getSelectedCourses($ids){
        return ExamCourse::whereIn('id', $ids)->get();
    }
}
