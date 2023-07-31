<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

    public function register(Request $request){
        $this->validate($request,[
            'registrationNo'=>'required',
            'surname'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|confirmed',
            'terms'=>'required',
            'mobileNo'=>'required',
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
        ]);
            try{
                $paystack = new Paystack(env('PAYSTACK_SECRET_KEY'));
                $amount = 20000; //$request->amount;
                $builder = new Paystack\MetadataBuilder();
                $builder->withRegistration($request->registrationNo);
                $builder->withSurname($request->surname);
                $builder->withPassword($request->password);
                $builder->withMobile($request->mobileNo);
                $builder->withEmail($request->email);
                $builder->withTransaction(3);
                $metadata = $builder->build();
                //$charge = ceil($cost*1.5)/100;
                $tranx = $paystack->transaction->initialize([
                    'amount'=>$amount*100,       // in kobo
                    'email'=>$request->email,         // unique to customers
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





        //$user = $this->user->setNewUser($request);
        #Notification
        $subject = "New registration";
        $body = $request->surname." just registered on ".env("APP_NAME");
        $this->adminnotification->setNewAdminNotification($subject, $body, 'view-user-profile', $user->slug, 1, 0);
        #Mailchimp welcome email
        /*try {
            if ( ! Newsletter::isSubscribed($request->email) ) {
                Newsletter::subscribe($request->email);
                Newsletter::subscribe($request->email, ['FNAME'=>$request->first_name]);
            }
        }catch (\Exception $exception){

        }*/

        session()->flash("success", "Your registration was successful. However, you'll have to complete your profile when you do login. <a href='".route('login')."'>Click here</a> to login.");
        return back();
    }
}
