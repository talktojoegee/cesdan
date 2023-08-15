<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeNewUserMail;
use App\Models\AdminNotification;
use App\Models\Tenant;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Newsletter\NewsletterFacade as Newsletter;
use Yabacon\Paystack;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->user = new User();
        $this->tenant = new Tenant();
        $this->adminnotification = new AdminNotification();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function continue(Request $request){
        $this->validate($request,[
            'registrationNo'=>'required',
            'surname'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|confirmed',
            'terms'=>'required',
            'mobileNo'=>'required',
            'payment_method'=>'required',
        ],[
            'registrationNo.required'=>'Registration Number is required',
            'surname.required'=>'Enter your surname in the field provided',
            'email.required'=>'Enter a valid email address',
            'email.email'=>'Enter a valid email address',
            'email.unique'=>'Whoops! Another account exists with this email',
            'password.required'=>'Choose a password',
            'password.confirmed'=>'Your chosen password does not match re-type password',
            'terms.required'=>'Accept our terms & conditions to continue with this registration',
            'mobileNo.required'=>'Enter a functional mobile phone number',
            'payment_method.required'=>'Choose payment method',
        ]);
        if($request->payment_method == 2){
             User::handlePaidRegistration($request->surname, $request->password, $request->email, $request->mobileNo, $request->registrationNo, 0, 2,0);
            try{
                //\Mail::to($user)->send(new WelcomeNewUserMail($user) );
                session()->flash("success", "We are yet to verify your payment; you will be contacted shortly.");
                return redirect()->route('login');
            }catch (\Exception $exception){
                abort(404);
            }
        }else{
            $amount = 25000;
            $amountCharge = number_format(($amount * 100)/98.5,2, ".","");
            $charge = $amountCharge - $amount;
            if($amount >= 2500){
                $charge = ($charge + 1.5)+100;
            }
            $charge = $charge + 0.03;
            if($charge > 2000){
                $charge = 2000;
            }
            return view('auth.continue',['request'=>$request, 'charge'=>$charge]);
        }


    }
    public function register(Request $request){
        $this->validate($request,[
            'registrationNo'=>'required',
            'surname'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required',
            //'terms'=>'required',
            'mobileNo'=>'required',
        ],[
            'registrationNo.required'=>'Registration Number is required',
            'surname.required'=>'Enter your surname in the field provided',
            'email.required'=>'Enter a valid email address',
            'email.email'=>'Enter a valid email address',
            'email.unique'=>'Whoops! Another account exists with this email',
            'password.required'=>'Choose a password',
            //'password.confirmed'=>'Your chosen password does not match re-type password',
            //'terms.required'=>'Accept our terms & conditions to continue with this registration',
            'mobileNo.required'=>'Enter a functional mobile phone number',
        ]);
            try{
                $paystack = new Paystack(env('PAYSTACK_SECRET_KEY'));
                $amount = 25000; //$request->amount;

                $amountCharge = number_format(($amount * 100)/98.5,2, ".",""); //Amount plus charge
                $charge = $amountCharge - $amount;
                if($amount >= 2500){
                    $charge = ($charge + 1.5)+100;
                }
                $charge = $charge + 0.03;
                if($charge > 2000){
                    $charge = 2000;
                }

                $builder = new Paystack\MetadataBuilder();
                $builder->withRegistration($request->registrationNo);
                $builder->withSurname($request->surname);
                $builder->withPassword($request->password);
                $builder->withMobile($request->mobileNo);
                $builder->withEmail($request->email);
                $builder->withTransaction(3);
                $metadata = $builder->build();
                $tranx = $paystack->transaction->initialize([
                    'amount'=>($amount+$charge)*100,       // in kobo
                    'email'=>$request->email,         // unique to customers
                    //'reference'=>sha1(time()), // unique to transactions
                    'metadata'=>$metadata
                ]);
                return redirect()->to($tranx->data->authorization_url)->send();
            }catch (Paystack\Exception\ApiException $exception){
                session()->flash("error", "Whoops! Something went wrong. Try again.");
                return back(); //https://members.cidsan.org/process/payment
            }
    }





}
