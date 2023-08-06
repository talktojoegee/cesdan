<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ExamType extends Model
{
    use HasFactory;
    protected $fillable = [
        'exam_name',
        'cost_per_paper',
        'status'
    ];


    public function getAllExams(){
        return ExamType::all();
    }

    public function addExam(Request $request){
        $exam = new ExamType();
        $exam->exam_name = $request->examName ?? null;
        $exam->cost_per_paper = $request->costPerPaper ?? 0;
        $exam->status = $request->status ?? 1;
        $exam->save();
        return $exam;
    }
    public function editExam(Request $request){
        $exam = ExamType::find($request->examId);
        $exam->exam_name = $request->examName ?? null;
        $exam->cost_per_paper = $request->costPerPaper ?? 0;
        $exam->status = $request->status ?? 1;
        $exam->save();
        return $exam;
    }

    public function getExamById($examId){
        return ExamType::find($examId);
    }
}
