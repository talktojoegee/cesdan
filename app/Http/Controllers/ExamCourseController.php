<?php

namespace App\Http\Controllers;

use App\Models\ExamCourse;
use App\Models\ExamRegistration;
use App\Models\ExamType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yabacon\Paystack;

class ExamCourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->examcourse = new  ExamCourse();
        $this->examtype = new ExamType();
        $this->examregistration = new ExamRegistration();
    }

    public function manageExamCourses(){
        if(Auth::user()->user_type != 1){
            return back();
        }
        return view('exams.admin.courses',[
            'courses'=>$this->examcourse->getExamCourses()
        ]);
    }

    public function addCourse(Request  $request){
        $this->validate($request,[
            'courseName'=>'required',
            'examType'=>'required'
        ],[
            'courseName.required'=>"Enter the name of the course",
            'examType.required'=>"Choose the exam type",
        ]);
        $this->examcourse->addExamCourse($request);
        session()->flash('success', "Success! New exam course added.");
        return back();
    }
    public function editExamCourse(Request  $request){
        $this->validate($request,[
            'courseName'=>'required',
            'examType'=>'required',
            'courseId'=>'required',
        ],[
            'courseName.required'=>"Enter the name of the course",
            'examType.required'=>"Choose the exam type",
        ]);
        $this->examcourse->editExamCourse($request);
        session()->flash('success', "Success! Your changes were saved.");
        return back();
    }


    public function showRegistrations(){
        return view('exams.admin.registrations');
    }


    public function showRegisterExams(){
        return view('exams.register-exams',[
            'exams'=>$this->examtype->getAllExams()
        ]);
    }


    public function showExamRegistrationPreview(Request $request){
        $this->validate($request,[
            'examType'=>'required',
            'course'=>'required|array',
            'course.*'=>'required',
        ],[
            'examType.required'=>'Choose an exam',
            'course.*'=>'Choose at least one course to register'
        ]);
        $courseIds = [];
        foreach ($request->course as $course){
            array_push($courseIds, $course);
        }
        $exam = $this->examtype->getExamById($request->examType);
        if(!empty($exam)){
            $cost = count($courseIds) * $exam->cost_per_paper;
            $amount = $cost;

            $amountCharge = number_format(($amount * 100)/98.5,2, ".","");
            $charge = $amountCharge - $amount;
            if($amount >= 2500){
                $charge = ($charge + 1.5)+100;
            }
            $charge = $charge + 0.03;
            if($charge > 2000){
                $charge = 2000;
            }
            return view('exams.register-exams-preview',[
                'exam'=>$exam,
                'courses'=>ExamCourse::getSelectedCourses($courseIds),
                'total'=>$amount,
                'charge'=>$charge
            ]);
        }
        abort(404);

    }

    public function getCourses(Request $request){
        $this->validate($request,[
            'exam'
        ]);
        $exam = $this->examtype->getExamById($request->exam);
        $courses = $this->examcourse->getExamCourseByExamTypeId($request->exam);
        return view('exams.partials._courses',['courses'=>$courses, 'exam'=>$exam]);
    }

    public function makePayment(Request $request){
        $this->validate($request,[
            'examType'=>'required',
            'course'=>'required|array',
            'course.*'=>'required',
            'amount'=>'required',
            'charge'=>'required',
        ],[
            'examType.required'=>'Exam type is missing',
            'course.required'=>'Course is missing',
            'amount.required'=>'Amount is requird',
            'charge.email'=>'Charge is required',
        ]);
        try{
            $userId = Auth::user()->id;
            $email = Auth::user()->email;
            $paystack = new Paystack(env('PAYSTACK_SECRET_KEY'));
            $amount = $request->amount;

            $amountCharge = number_format(($amount * 100)/98.5,2, ".","");
            $charge = $amountCharge - $amount;
            if($amount >= 2500){
                $charge = ($charge + 1.5)+100;
            }
            $charge = $charge + 0.03;
            if($charge > 2000){
                $charge = 2000;
            }
            $courses = [];
            foreach ($request->course as $course){
                array_push($courses, $course);
            }

            $builder = new Paystack\MetadataBuilder();
            $builder->withUser($userId);
            $builder->withCharge($charge);
            $builder->withCourses($courses);
            $builder->withExam($request->examType);
            $builder->withTransaction(4); //exam registration
            $metadata = $builder->build();
            $tranx = $paystack->transaction->initialize([
                'amount'=>($amount+$charge)*100,       // in kobo
                'email'=>$email,         // unique to customers
                'metadata'=>$metadata
            ]);
            return redirect()->to($tranx->data->authorization_url)->send();
        }catch (Paystack\Exception\ApiException $exception){
            session()->flash("error", "Whoops! Something went wrong. Try again.");
            return back();
        }
    }

    public function showMyExams(){

        return view('exams.my-exams',[
            'exams'=>$this->examregistration->getExamByUserId(Auth::user()->id)
        ]);
    }


    public function manageExams(){
        if(Auth::user()->user_type != 1){
            return back();
        }
        return view('exams.admin.exams',[
            'exams'=>$this->examregistration->getExamRegistrations()
        ]);
    }


}
