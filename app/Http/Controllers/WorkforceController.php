<?php

namespace App\Http\Controllers;

use App\Mail\ProfileUpdateMail;
use App\Models\Country;
use App\Models\Discipline;
use App\Models\GeopoliticalZone;
use App\Models\Institution;
use App\Models\LocalGovernment;
use App\Models\Qualification;
use App\Models\SectorTwo;
use App\Models\SponsoringDistrict;
use App\Models\State;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WorkforceController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
        $this->user = new User();
        $this->tenant = new Tenant();
        $this->localgovernment = new LocalGovernment();
        $this->discipline = new Discipline();
        $this->qualification = new Qualification();
        $this->sponsoringdistrict = new SponsoringDistrict();
        $this->country = new Country();
        $this->state = new State();
        $this->institution = new Institution();
        $this->geopoliticalzone = new GeopoliticalZone();
        $this->sectortwo = new SectorTwo();
    }

    public function manageWorkforce(){
        return view('workforce.index',['users'=>$this->user->getAllTenantUsersByTenantId(Auth::user()->tenant_id)]);
    }

    public function viewProfile(Request $request){
        $user = $this->user->getUserBySlug($request->slug);
        if(!empty($user)){
            return view('workforce.view',[
                'user'=>$user,
                'countries'=>$this->country->getAllCountries(),
                'states'=>$this->state->getAllStates(),
                'districts'=>$this->sponsoringdistrict->getAllSponsoringDistricts(),
                'qualifications'=>$this->qualification->getAllQualifications(),
                'disciplines'=>$this->discipline->getAllDisciplines(),
                'institutions'=>$this->institution->getAllInstitutions(),
                'geozones'=>$this->geopoliticalzone->getAllGeopoliticalZones(),
                'sectortwo'=>$this->sectortwo->getAllSectorTwo(),

            ]);
        }else{
            session()->flash("error", "No record found");
            return back();
        }
    }

    public function showNewTeamMemberForm(){
        return view('workforce.add-new-team-member');
    }

    public function saveNewTeamMember(Request $request){
        $this->validate($request,[
            'first_name'=>'required',
            'last_name'=>'required',
            'phone_no'=>'required',
            'email'=>'required|email|unique:users,email',
            'gender'=>'required',
        ],[
            'last_name.required'=>'Enter your surname',
            'first_name.required'=>'Enter your first name',
            'email.required'=>'Enter a valid email address',
            'email.email'=>'Enter a valid email address',
            'email.unique'=>'Whoops! Another account exists with this email',
            'gender.required'=>'Select gender',
            'phone_no.required'=>'Enter mobile number'
        ]);
        $this->user->setNewTeamMember($request);
        session()->flash("success", "A new team member was added to your workforce successfully.");
        return back();
    }

    public function updateProfile(Request $request){

        $this->validate($request,
            [
           'firstName'=>'required',
           'surname'=>'required',
            'mobileNo'=>'required',
            'passportPhoto'=>'required',
            'gender'=>'required',
            'maritalStatus'=>'required',
            'birthDate'=>'required',
            'nationality'=>'required',
            'stateOfOrigin'=>'required',
            //'contactAddress'=>'required',
            //'contactCity'=>'required',
            //'contactState'=>'required',
            //'contactCountry'=>'required',
            'geopoliticalZone'=>'required',
            'heardIcan'=>'required',
            'residentialAddress'=>'required',
            'residentialCity'=>'required',
            'residentialState'=>'required',
            'residentialTelephone'=>'required',
            //'officeAddress'=>'required',
            //'officeCity'=>'required',
            //'officeState'=>'required',
            //'officeTelephone'=>'required',
            'primarySchool'=>'required',
            'graduationYear'=>'required',
            'primarySchoolCountry'=>'required',
            'collegeName'=>'required',
            'secondaryGraduationYear'=>'required',
            'secondarySchoolCountry'=>'required',
            //'graduateInstitution'=>'required',
            //'graduateQualification'=>'required',
            //'graduateDiscipline'=>'required',
            //'graduateGraduationYear'=>'required',
            //'graduateInstitutionCountry'=>'required',
            //'postGraduateInstitution'=>'required',
            //'postGraduateQualification'=>'required',
            //'postGraduateDiscipline'=>'required',
            //'postGraduationYear'=>'required',
            //'postGraduateInstitutionCountry'=>'required',
            //'professionalQualification'=>'required',
            //'professionalQualificationYear'=>'required',
            //'secondProfessionalQualification'=>'required',
            //'secondProfessionalQualificationYear'=>'required',
            //'examinationNumber'=>'required',
            //'examinationYear'=>'required',
            //'companyName'=>'required',
            //'department'=>'required',
            //'position'=>'required',
            //'startDate'=>'required',
            //'sectorOne'=>'required',
            //'sectorTwo'=>'required',
            'refereeOneName'=>'required',
            'refereeOneMembershipNo'=>'required',
            'refereeOneGSM'=>'required',
            'sponsoringDistrictSociety'=>'required',
        ],
            [
            'firstName.required'=>'Enter your first name',
            'surname.required'=>'Enter your surname',
            'mobileNo.required'=>'Enter your mobile number',
            'passportPhoto.required'=>'Choose passport photo to upload',
            'gender.required'=>'Select your gender',
            'maritalStatus.required'=>"What's your marital status?",
            'birthDate.required'=>"When were you born?",
            'nationality.required'=>"What's your nationality?",
            'stateOfOrigin.required'=>"What is your state of origin?",
            //'contactAddress.required'=>"Enter your contact address in the field provided",
            //'contactCity.required'=>"Enter contact city here",
            //'contactState.required'=>"Select state from the options provided",
            //'contactCountry.required'=>"Select country from the options provided",
            'geopoliticalZone.required'=>"Select your geopolitical zone",
            'heardIcan.required'=>"How did you hear about ICAN?",
            'residentialAddress.required'=>"What is your residential address",
            'residentialCity.required'=>"In which city do you live?",
            'residentialState.required'=>"What's the name of the state in which you live?",
            'residentialTelephone.required'=>"Enter your telephone number",
            //'officeAddress.required'=>"What's your office address?",
            //'officeCity.required'=>"In which city is your office located?",
            //'officeState.required'=>"What's the name of the state in which your office is located?",
            //'officeTelephone.required'=>"Enter your office telephone number",
            'primarySchool.required'=>"What's the name of the primary school you attended?",
            'graduationYear.required'=>"In which year did you graduate from this primary school?",
            'primarySchoolCountry.required'=>"In which country is this primary school situated?",
            'collegeName.required'=>"What is the name of the college you attended?",
            'secondaryGraduationYear.required'=>"In which year did you graduate from this college?",
            'secondarySchoolCountry.required'=>"What's the name of the country in which this college is situated?",
            //'graduateInstitution.required'=>"Enter the name of the institution you attended",
            //'graduateQualification.required'=>"What qualification did you obtain from this institution?",
            //'graduateDiscipline.required'=>"What's the discipline?",
            //'graduateGraduationYear.required'=>"In which year did you graduate?",
            //'graduateInstitutionCountry.required'=>"What's the name of the country in which this institution is situated?",
            //'postGraduateInstitution.required'=>"Enter the name of the post graduate institution you attended",
            //'postGraduateQualification.required'=>"Post graduate qualification is required",
            //'postGraduateDiscipline.required'=>"Post graduate discipline is required",
            //'postGraduationYear.required'=>"In which year did you graduate?",
            //'postGraduateInstitutionCountry.required'=>"Select the country in which this institution is situated in.",
            //'professionalQualification.required'=>"Enter qualification",
            //'professionalQualificationYear.required'=>'Enter year',
            //'secondProfessionalQualification.required'=>'Enter second professional qualification',
            //'secondProfessionalQualificationYear.required'=>'Enter second professional qualification year',
            //'examinationNumber.required'=>'Enter examination number',
            //'examinationYear.required'=>'Enter examination year',
            //'companyName.required'=>'Enter the name of the company',
            //'department.required'=>'Enter the name of the department',
            //'position.required'=>'Enter the position you occupied',
            //'startDate.required'=>'When did you start work?',
            //'sectorOne.required'=>'Select sector one',
            //'sectorTwo.required'=>'Select sector two',
            'refereeOneName.required'=>'Enter referee name',
            'refereeOneMembershipNo.required'=>'Enter referee membership number',
            'refereeOneGSM.required'=>'Enter referee mobile number',
            'sponsoringDistrictSociety.required'=>'Select sponsoring district society',
        ]);
        $user = $this->user->updateProfile($request);
        #Send welcome email
        try{
            \Mail::to($user)->send(new ProfileUpdateMail($user) );

        }catch (\Exception $ex){
            session()->flash("error", "We had trouble sending you a mail. Though your account was created.");
            return back();
        }
        session()->flash("success", "Your changes were saved successfully");
        return back();
    }

    public function changeAvatar(Request $request){
        $this->validate($request,[
            'passportPhoto'=>'required'
        ],[
            'passportPhoto.required'=>'Choose profile picture to upload.'
        ]);
        if($request->hasFile('passportPhoto')){
            $this->user->updateAvatar($request);
        }
        session()->flash("success", "Your profile picture was changed.");
        return back();
    }

    public function changePassword(Request $request){
        $this->validate($request,[
            'current_password'=>'required',
            'password'=>'required|confirmed',
            'password_confirmation'=>'required'
        ],[
            'current_password.required'=>'Enter your current password for this account.',
            'password.required'=>'Choose a new password.',
            'password.confirmed'=>'New password does not match with confirm/re-type password.',
            'password_confirmation.required'=>'Re-type password'
        ]);
        if (Hash::check($request->current_password, Auth::user()->password)) {
            Auth::user()->password = bcrypt($request->password);
            Auth::user()->save();
            session()->flash("success", "<strong>Congratulations!</strong> You've successfully changed your password.");
            return back();
        }else{
            session()->flash("error", "<strong>Whoops!</strong> The password you entered does not match our record.");
            return back();
        }
    }


}
