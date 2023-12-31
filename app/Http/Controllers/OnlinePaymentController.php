<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeNewUserMail;
use App\Models\AdminNotification;
use App\Models\Bank;
use App\Models\BulkSmsAccount;
use App\Models\EmailLog;
use App\Models\ExamCourse;
use App\Models\ExamRegistration;
use App\Models\ExamRegistrationCourse;
use App\Models\ExamType;
use App\Models\InvoiceMaster;
use App\Models\Pricing;
use App\Models\ReceiptMaster;
use App\Models\Subscription;
use App\Models\Survey;
use App\Models\SurveyResponse;
use App\Models\Tenant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yabacon\Paystack;

class OnlinePaymentController extends Controller
{


    public function __construct()
    {
        $this->bulksmsaccount = new BulkSmsAccount();
        $this->subscription = new Subscription();
        $this->pricing = new Pricing();
        $this->user = new User();
        $this->tenant = new Tenant();
        $this->invoice = new InvoiceMaster();
        $this->receipt = new ReceiptMaster();
        $this->bank = new Bank();
        $this->survey = new Survey();
        $this->surveyresponse = new SurveyResponse();
        $this->adminnotification = new AdminNotification();
        $this->examtype = new ExamType();
    }

    public function initializePaystack(){

    }
    public function processOnlinePayment(Request $request){
        /*
         * Transaction Type (Transaction):
         *  3 = Invoice Payment | New Registration
         *  4 = SMS Top-up
         */

        $reference = isset($request->reference) ? $request->reference : '';
        if(!$reference){
            die('No reference supplied');
        }
        $paystack = new Paystack( env('PAYSTACK_SECRET_KEY'));
        try {
            // verify using the library
            $tranx = $paystack->transaction->verify([
                'reference'=>$reference,
            ]);
            if ('success' === $tranx->data->status) {
                try {

                    $transaction_type = $tranx->data->metadata->transaction ;
                    $user = null;
                    switch ($transaction_type){
                        case 3:
                            $registrationNo = $tranx->data->metadata->registration;
                            $membership = $tranx->data->metadata->membership;
                            $surname = $tranx->data->metadata->surname;
                            $password = $tranx->data->metadata->password;
                            $mobileNo = $tranx->data->metadata->mobile;
                            $email = $tranx->data->metadata->email;
                            $amount = $tranx->data->amount;
                            $user = User::handlePaidRegistration($surname, $password, $email, $mobileNo, $registrationNo, $amount, 1, 1, $membership);
                            $subject = "New registration";
                            $body = $tranx->data->metadata->surname." just registered on ".env("APP_NAME");
                            $this->adminnotification->setNewAdminNotification($subject, $body, 'view-user-profile', $user->slug, 1, 0);
                            #Send welcome email

                            //\Mail::to($user)->send(new WelcomeNewUserMail($user) );
                            EmailLog::logEmail($user->id, 1, null, null);
                            session()->flash("success", "Your payment was successful, However, you'll have to complete your registration.  <a href='".route('login')."'>Login </a> now with your credentials to complete your registration ");
                            return redirect()->route('login');
                        case 4: //exam registration
                            $courseIds = $tranx->data->metadata->courses;
                            $userId = $tranx->data->metadata->user;
                            $examId = $tranx->data->metadata->exam;
                            $charge = $tranx->data->metadata->charge;
                            $amount = $tranx->data->amount/100;
                            $examType = $this->examtype->getExamById($examId);
                            if(!empty($examType)){
                                $courses = ExamCourse::getSelectedCourses($courseIds);
                                $examReg = ExamRegistration::registerExam($userId, $examId, $amount, $charge);
                                if(count($courses) > 0 ){
                                    foreach($courses as $course){
                                        ExamRegistrationCourse::registerExamCourses($examReg->id, $course);
                                    }
                                }
                                session()->flash("success", "Your exam registration was successful.");
                                return redirect()->route('register-exams');
                            }else{
                                abort(404);
                            }



                    }
                }catch (Paystack\Exception\ApiException $ex){
                    session()->flash("error", "Whoops! Something went wrong.");
                    return redirect()->route('register');
                }

            }
        }catch (Paystack\Exception\ApiException $exception){
            session()->flash("error", "Whoops! Something went wrong.");
            return redirect()->route('register');
        }


    }

    /*
    * process online payment
    */
    public function onlinePayment($slug){
        $invoice = $this->invoice->getInvoiceBySlug($slug);
        if(!empty($invoice)){
            $settings = $this->tenant->getTenantPaymentGatewaySettings($invoice->tenant_id);
            //if(!empty($settings->secret_key) && !empty($settings->public_key)){
            if(!empty($settings->secret_key) && !empty($settings->public_key)){
                //$paystack = new Paystack($settings->secret_key);
                //$paystack = new Paystack(config('app.paystack_secret_key'));
                #Public key
                //$this->setEnv('PAYSTACK_PUBLIC_KEY', $company_payment_int->ps_public_key);
                #Secret key
                //$this->setEnv('PAYSTACK_SECRET_KEY', $company_payment_int->ps_secret_key);
                return view('sales-n-invoice.online-payment',['invoice'=>$invoice]);
            }else{
                session()->flash("error", "<h3 class='text-center'>Whoops! Kindly contact Admin. Something went wrong.</h3> ");
                return back();
            }

        }else{
            abort(404, 'Resource not found.');
        }
    }

    /*public function onlinePayment($slug){
        $invoice = $this->invoice->getInvoiceBySlug($slug);
        if(!empty($invoice)){
            $settings = $this->tenant->getTenantPaymentGatewaySettings();
            //if(!empty($settings->secret_key) && !empty($settings->public_key)){
            if(!empty($settings->secret_key) && !empty($settings->public_key)){
                $paystack = new Paystack($settings->secret_key);
                //$paystack = new Paystack(config('app.paystack_secret_key'));
                #Public key
                //$this->setEnv('PAYSTACK_PUBLIC_KEY', $company_payment_int->ps_public_key);
                #Secret key
                //$this->setEnv('PAYSTACK_SECRET_KEY', $company_payment_int->ps_secret_key);
                return view('sales-n-invoice.online-payment',['invoice'=>$invoice]);
            }else{
                session()->flash("error", "<h3 class='text-center'>Whoops! Kindly contact Admin. Something went wrong.</h3> ");
                return back();
            }

        }else{
            abort(404, 'Resource not found.');
        }
    }*/


    /*
     * Charge invoice online
     */
    public function chargeInvoiceOnline(Request $request){
        $this->validate($request,[
            'amount'=>'required',
            'invoice'=>'required'
        ],[
            'units.required'=>"Enter the amount you wish to pay"
        ]);

        $invoice = $this->invoice->getInvoiceById($request->invoice);
        if(!empty($invoice)){
            $bank = $this->bank->getFirstBankByTenantId($invoice->tenant_id);
            if(empty($bank)){
                abort(404, 'Something went wrong');
            }
            $settings = $this->tenant->getTenantPaymentGatewaySettings($invoice->tenant_id);
            if(!empty($settings->secret_key) && !empty($settings->public_key)){
            try{
                $paystack = new Paystack(config($settings->secret_key));
                $amount = $request->amount;
                $builder = new Paystack\MetadataBuilder();
                $builder->withInvoice($request->invoice);
                $builder->withBank($bank->id);
                /*
                 * Transaction Type:
                 *  1 = New tenant subscription
                 *  2 = Subscription Renewal
                 *  3 = Invoice Payment
                 *  4 = SMS Top-up
                 */
                $builder->withTransaction(3);
                $metadata = $builder->build();
                //$charge = ceil($cost*1.5)/100;
                $tranx = $paystack->transaction->initialize([
                    'amount'=>$amount*100,       // in kobo
                    'email'=>$invoice->getContact->email,         // unique to customers
                    'reference'=>substr(sha1(time()),23,40), // unique to transactions
                    'metadata'=>$metadata
                ]);
                return redirect()->to($tranx->data->authorization_url)->send();
            }catch (Paystack\Exception\ApiException $exception){
                //print_r($exception->getResponseObject());
                //die($exception->getMessage());
                session()->flash("error", "Whoops! Something went wrong. Try again.");
                return back();
            }
            }else{
                abort(404, 'Something went wrong. Contact seller.');
            }
        }else{
            abort(404, 'Resource not found.');
        }

    }

    public function sharedSurvey($slug){
        $survey = $this->survey->getSurveyBySlug($slug);
        if(!empty($survey)){
            return view('shared-survey', ['survey'=>$survey]);
        }else{
            abort(404);
        }

    }

    public function processSharedSurvey(Request $request){
        $this->validate($request,[
            'tenantId'=>'required',
            'surveyId'=>'required',
            'rating'=>'required|array',
            'rating.*'=>'required',
            'questions'=>'required|array',
            'questions.*'=>'required'
        ]);

        for($i = 0; $i<count($request->questions); $i++){
            $this->surveyresponse->publishSurveyResponse($request->surveyId,
                $request->questions[$i], $request->tenantId, $request->rating[$i]);
        }
        return redirect()->route('survey-thank-you');
    }

    public function surveyThankYou(){
        return view('survey-thank-you-page');
    }
}
