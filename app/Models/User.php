<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PHPUnit\Framework\Constraint\Count;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getTenant(){
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function getMaritalStatus(){
        return $this->belongsTo(MaritalStatus::class, 'marital_status');
    }
    public function getHeardFrom(){
        return $this->belongsTo(HeardFrom::class, 'heard_ican');
    }

    public function getTenantMailchimpSettings(){
        return $this->hasMany(MailchimpSettings::class, 'tenant_id', 'tenant_id');
    }

    public function getTenantBanks(){
        return $this->hasMany(Bank::class, 'tenant_id', 'tenant_id');
    }

    public function getTenantContacts(){
        return $this->hasMany(Contact::class, 'tenant_id', 'tenant_id')->orderBy('id', 'DESC');
    }

    public function getTenantNotifications(){
        return $this->hasMany(TenantNotification::class, 'tenant_id');
    }

    public function getSectorTwo(){
        return $this->belongsTo(SectorTwo::class, 'sector_two');
    }
    public function getSponsoringDistrict(){
        return $this->belongsTo(SponsoringDistrict::class, 'sponsoring_district');
    }
     public function getContactState(){
        return $this->belongsTo(State::class, 'contact_state');
    }

   public function getContactCountry(){
        return $this->belongsTo(Country::class, 'contact_country');
    }

    public function getGeoZone(){
        return $this->belongsTo(GeopoliticalZone::class, 'geo_zone');
    }

    public function getLocalGovernment(){
        return $this->belongsTo(LocalGovernment::class, 'lga');
    }

    public function getUserSupportingDocuments(){
        return $this->hasMany(UserSupportingDocument::class, 'user_id');
    }

    public function getMembership(){
        return $this->belongsTo(SubscriptionPlan::class, 'membership_plan_id');
    }



    /*
     * Use-case methods
     */
    public function setNewUser(Request $request){
        $user = new User();
        $user->first_name = 'First Name';
        $user->surname = $request->surname ?? '' ;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->mobile_no = $request->mobileNo ?? null;
        $user->start_date = now();
        $user->end_date = now();
        $user->tenant_id = 1;
        $user->account_status = 0;
        $user->active_sub_key = $request->registrationNo ?? null; //active_sub_key holds the registration number
        $user->slug = Str::slug($request->surname).'-'.substr(sha1(time()),32,40);
        $user->save();
        return $user;
    }

    public static function handlePaidRegistration($surname, $password, $email, $mobileNo, $registrationNo){
        $user = new User();
        $user->first_name = null;
        $user->surname = $surname ?? '' ;
        $user->password = bcrypt($password);
        $user->email = $email;
        $user->mobile_no = $mobileNo ?? null;
        $user->start_date = now();
        $user->end_date = now();
        $user->tenant_id = 1;
        $user->account_status = 0;
        $user->active_sub_key = $registrationNo ?? null; //active_sub_key holds the registration number
        $user->slug = Str::slug($surname).'-'.substr(sha1(time()),32,40);
        $user->save();
        return $user;
    }

    public function setNewTeamMember(Request $request){
        $user = new User();
        $user->first_name = $request->first_name ;
        $user->surname = $request->last_name  ?? '';
        $user->mobile_no = $request->phone_no ?? '' ;
        $user->password = bcrypt('password123');
        $user->email = $request->email ?? '' ;
        $user->start_date = Auth::user()->start_date;
        $user->end_date = Auth::user()->end_date;
        $user->tenant_id = Auth::user()->tenant_id;
        $user->active_sub_key = Auth::user()->active_sub_key;
        $user->slug = Str::slug($request->first_name).'-'.substr(sha1(time()),32,40);
        $user->address = $request->address ?? '';
        $user->save();
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->first_name = $request->firstName ?? Auth::user()->first_name;
        $user->surname = $request->surname ?? Auth::user()->surname;
        $user->mobile_no = $request->mobileNo ?? Auth::user()->mobile_no;
        $user->gender = $request->gender ?? Auth::user()->gender;
        $user->avatar =  $request->hasFile('passportPhoto') ? $this->updateAvatar($request) : 'avatar.jpg';
        $user->marital_status = $request->maritalStatus ?? null;
        $user->birth_date = $request->birthDate ?? null;
        $user->nationality = $request->nationality ?? null;
        $user->state_origin = $request->stateOfOrigin ?? null;
        $user->lga = $request->localGovtArea ?? null;
        $user->membership_plan_id = $request->membershipPlan ?? null;
        //$user->contact_address = $request->contactAddress ?? null;
        //$user->contact_city = $request->contactCity ?? null;
        //$user->contact_state = $request->contactState ?? null;
        //$user->contact_country = $request->contactCountry ?? null;
        $user->geo_zone = $request->geopoliticalZone ?? null;
        $user->heard_ican = $request->heardIcan ?? null;
        $user->residential_address = $request->residentialAddress ?? null;
        $user->residential_city = $request->residentialCity ?? null;
        $user->residential_state = $request->residentialState ?? null;
        $user->residential_telephone = $request->residentialTelephone ?? null ;
        $user->office_address = $request->officeAddress ?? null ;
        $user->office_city = $request->officeCity ?? null;
        $user->office_state = $request->officeState ?? null ;
        $user->office_telephone = $request->officeTelephone ?? null;
        $user->primary_school = $request->primarySchool ?? null;
        $user->primary_graduate_year = $request->graduationYear ?? null;
        $user->primary_school_country = $request->primarySchoolCountry ?? null;
        $user->college_name = $request->collegeName ?? null;
        $user->secondary_graduate_year = $request->secondaryGraduationYear ?? null;
        $user->secondary_school_country = $request->secondarySchoolCountry ?? null;
        $user->graduate_institution = $request->graduateInstitution ?? null;
        $user->graduate_qualification = $request->graduateQualification ?? null;
        $user->graduate_discipline = $request->graduateDiscipline ?? null;
        $user->graduate_graduation_year = $request->graduateGraduationYear ?? null;
        $user->graduate_institution_country = $request->graduateInstitutionCountry ?? null;
        $user->post_graduate_institution = $request->postGraduateInstitution ?? null;
        $user->post_graduate_qualification = $request->postGraduateQualification ?? null;
        $user->post_graduate_discipline = $request->postGraduateDiscipline ?? null;
        $user->post_graduate_year = $request->postGraduationYear ?? null;
        $user->post_graduate_institution_country = $request->postGraduateInstitutionCountry ?? null;
        $user->professional_qualification = $request->professionalQualification ?? null;
        $user->professional_qualification_year = $request->professionalQualificationYear ?? null;
        $user->second_professional_qualification = $request->secondProfessionalQualification ?? null;
        $user->second_professional_qualification_year = $request->secondProfessionalQualificationYear ?? null;
        //$user->examination_no = $request->examinationNumber ?? null;
        //$user->examination_year = $request->examinationYear ?? null;
        $user->company_name = $request->companyName ?? null;
        $user->department = $request->department ?? null;
        $user->position = $request->position ?? null;
        $user->start_date = $request->startDate ?? null;
        $user->sector_one = $request->sectorOne ?? null;
        $user->sector_two = $request->sectorTwo ?? null;
        $user->referee_name = $request->refereeOneName ?? null;
        $user->referee_membership_no = $request->refereeOneMembershipNo ?? null;
        $user->referee_mobile_no = $request->refereeOneGSM ?? null;
        $user->sponsoring_district = $request->sponsoringDistrictSociety ?? null;
        $user->account_status = 1;
        $user->save();
        return $user;
    }
    public function updateAvatar(Request $request){
        if($request->hasFile('passportPhoto'))
        {
            $extension = $request->passportPhoto->getClientOriginalExtension();
            $filename = Str::slug(Auth::user()->first_name).'_' . uniqid(). '.' . $extension;
            $dir = 'assets/drive/';
            $request->passportPhoto->move(public_path($dir), $filename);
            $user = User::find(Auth::user()->id);
            $user->avatar = $filename;
            $user->save();
            return $filename;
        }
    }
    /*  public function updateAvatar(Request $request){
        if($request->hasFile('avatar'))
        {
            $extension = $request->avatar->getClientOriginalExtension();
            $filename = Str::slug(Auth::user()->first_name).'_' . uniqid(). '.' . $extension;
            $dir = 'assets/drive/';
            $request->avatar->move(public_path($dir), $filename);
            $avatar = User::find(Auth::user()->id);
            $avatar->avatar = $filename;
            $avatar->save();
        }
    }*/

    public function getUserById($id){
        return User::find($id);
    }

    public function getUserByEmail($email){
        return User::where('email', $email)->first();
    }

    public function getAllTenantUsersByTenantId($tenant_id){
        return User::where('tenant_id', $tenant_id)->get();
    }

    public function getUserBySlug($slug){
        return User::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
    }

    public function getUserBySlugnTenantId($slug,$tenant_id){
        return User::where('slug', $slug)->where('tenant_id', $tenant_id)->first();
    }

    public function updateTenantActiveKey($tenant_id, $active_key, $start, $end){
        $users = User::where('tenant_id', $tenant_id)->get();
        if(!empty($tenants)){
            foreach ($users as $user){
                $user->active_sub_key = $active_key;
                $user->account_status = 1;
                $user->start_date = $start;
                $user->end_date = $end;
                $user->save();
            }
        }
    }
    public function getOwnerByTenantId($tenantId){
        return User::where('tenant_id', $tenantId)->first();
    }

    public function getStateById($id){
        return State::find($id);
    }

    public function getCountryById($id){
        return Country::find($id);
    }

    public function getQualification($id){
        return Qualification::find($id);
    }

    public function getDiscipline($id){
        return Discipline::find($id);
    }

    public function getInstitution($id){
        return Institution::find($id);
    }




}
