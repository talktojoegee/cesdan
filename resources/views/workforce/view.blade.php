@extends('layouts.master-layout')
@section('active-page')
    Profile
@endsection
@section('title')
    Profile
@endsection
@section('extra-styles')
    <link href="/assets/plugins/formwizard/smart_wizard.css" rel="stylesheet">
    <link href="/assets/plugins/formwizard/smart_wizard_theme_arrows.css" rel="stylesheet">
    <link href="/assets/plugins/formwizard/smart_wizard_theme_circles.css"  rel="stylesheet">
    <link href="/assets/plugins/formwizard/smart_wizard_theme_dots.css" rel="stylesheet">
    <link href="/assets/plugins/forn-wizard/css/demo.css" rel="stylesheet">

@endsection
@section('breadcrumb-action-btn')
    <a href="{{route('view-profile', Auth::user()->slug)}}" class="btn btn-primary btn-icon text-white">
        <span>
            <i class="fe fe-user"></i>
        </span> View Profile
    </a>
@endsection

@section('main-content')
    @if(Auth::user()->account_status == 0)
        <div class="row">
        <div class="col-lg-12">
            <div class="card accordion-wizard">
                <div class="card-header">
                    <h3 class="card-title">New Membership Registration</h3>
                </div>
                <div class="card-body">
                    <p>Take your time to complete your profile.</p>
                    <p><strong class="text-danger">Note:</strong> All fields marked <sup class="text-danger">*</sup> are compulsory</p>
                    @if(session()->has('success'))
                        <div class="alert alert-success mb-4">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Great!</strong>
                            <hr class="message-inner-separator">
                            <p>{!! session()->get('success') !!}</p>
                        </div>
                    @endif
                    <form id="form" action="{{ route('update-profile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="list-group">
                            <div class="list-group-item py-4" data-acc-step>
                                <h5 class="mb-0" data-acc-title><strong>Personal Info</strong></h5>
                                <div data-acc-content class="mt-4">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>Surname: <sup class="text-danger">*</sup></label>
                                                <input type="text" name="surname" placeholder="Surname" value="{{old('surname', Auth::user()->surname)}}"  class="form-control" />
                                                @error('surname') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>First Name: <sup class="text-danger">*</sup></label>
                                                <input type="text" value="{{old('firstName', Auth::user()->first_name)}}" placeholder="First Name" name="firstName" class="form-control" />
                                                @error('firstName') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>Middle Name:</label>
                                                <input type="text" value="{{old('middleName')}}" placeholder="Middle Name" name="middleName" class="form-control" />
                                                @error('middleName') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>Mobile No.: <sup class="text-danger">*</sup></label>
                                                <input type="text" name="mobileNo" placeholder="Mobile No." value="{{old('mobileNo', Auth::user()->mobile_no)}}"  class="form-control" />
                                                @error('mobileNo') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>Email Address: <sup class="text-danger">*</sup></label>
                                                <input type="text" readonly value="{{old('firstName', Auth::user()->email)}}" placeholder="Email Address" name="email" class="form-control" />
                                                @error('email') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>Passport Photo: <sup class="text-danger">*</sup></label>
                                                <input type="file"  placeholder="Middle Name" name="passportPhoto" class="form-control-file" />
                                                @error('passportPhoto') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>Gender: <sup class="text-danger">*</sup></label>
                                                <select name="gender" id="gender" class="form-control">
                                                    <option selected disabled>-- Select Gender --</option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                </select>
                                                @error('gender') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>Marital Status: <sup class="text-danger">*</sup></label>
                                                <select name="maritalStatus" id="maritalStatus" class="form-control">
                                                    <option selected disabled>-- Select marital status --</option>
                                                    <option value="1">Single</option>
                                                    <option value="2">Married</option>
                                                    <option value="3">Divorced</option>
                                                    <option value="4">Others</option>
                                                </select>
                                                @error('maritalStatus') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>Date of Birth: <sup class="text-danger">*</sup></label>
                                                <input type="date" value="{{date('dd-mm-yy', strtotime(now()))}}"  name="birthDate" class="form-control" />
                                                @error('birthDate') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>Nationality: <sup class="text-danger">*</sup></label>
                                                <select name="nationality" id="nationality" class="form-control">
                                                    <option selected disabled>-- Select country --</option>
                                                    <option value="156">Nigeria</option>

                                                </select>
                                                @error('nationality') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>State of Origin: <sup class="text-danger">*</sup></label>
                                                <select name="stateOfOrigin" id="stateOfOrigin" class="form-control">
                                                    <option selected disabled>-- Select State --</option>
                                                    @foreach($states as $state)
                                                        <option value="{{$state->id}}">{{ ucfirst($state->state_name) }}</option>
                                                    @endforeach
                                                </select>
                                                @error('stateOfOrigin') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>Local Govt. Area: <sup class="text-danger">*</sup></label>
                                                <div id="localGovtAreaWrapper"></div>
                                                @error('localGovtArea') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>Geopolitical Zone: <sup class="text-danger">*</sup></label>
                                                <select name="geopoliticalZone" id="geopoliticalZone" class="form-control">
                                                    <option selected disabled>-- Select zone --</option>
                                                    @foreach($geozones as $zone)
                                                        <option value="{{$zone->id}}">{{ ucfirst($zone->geo_name) }}</option>
                                                    @endforeach
                                                </select>
                                                @error('geopoliticalZone') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>Heard of CIDSAN from: <sup class="text-danger">*</sup></label>
                                                <select name="heardIcan" id="heardIcan" class="form-control">
                                                    <option selected disabled>-- Select option --</option>
                                                    <option value="1">Catch Them Young Programme</option>
                                                    <option value="2">NYSC Camp</option>
                                                    <option value="3">District Society</option>
                                                    <option value="4">Tutition House</option>
                                                    <option value="5">Others</option>
                                                </select>
                                                @error('heardIcan') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>Membership Plan: <sup class="text-danger">*</sup></label>
                                                <select name="membershipPlan" id="membershipPlan" class="form-control">
                                                    <option selected disabled>-- Select plan --</option>
                                                    @foreach($plans as $plan)
                                                    <option value="{{ $plan->id }}">{{$plan->name ?? '' }}</option>
                                                    @endforeach
                                                </select>
                                                @error('membershipPlan') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item py-4" data-acc-step>
                                <h5 class="mb-0" data-acc-title><strong>Address</strong></h5>
                                <div data-acc-content class="mt-4">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label>Residential Address: <sup class="text-danger">*</sup></label>
                                                <textarea placeholder="Residential Address" name="residentialAddress" id="residentialAddress" style="resize: none;"
                                                          class="form-control">{{ old('residentialAddress') }}</textarea>
                                                @error('residentialAddress') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label>Residential City: <sup class="text-danger">*</sup></label>
                                                <input type="text" value="{{ old('residentialCity') }}" placeholder="Residential City" name="residentialCity" class="form-control">
                                                @error('residentialCity') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label>Residential State: <sup class="text-danger">*</sup></label>
                                                <select name="residentialState" id="residentialState" class="form-control">
                                                    <option selected disabled>-- Select state --</option>
                                                    @foreach($states as $s)
                                                        <option value="{{$s->id}}">{{ ucfirst($s->state_name) }}</option>
                                                    @endforeach
                                                </select>
                                                @error('residentialState') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label>Residential Telephone: <sup class="text-danger">*</sup></label>
                                                <input type="text" value="{{ old('residentialTelephone') }}" placeholder="Residential Telephone" name="residentialTelephone" class="form-control">
                                                @error('residentialTelephone') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label>Office Address:</label>
                                                <textarea placeholder="Office Address" name="officeAddress" id="officeAddress" style="resize: none;"
                                                          class="form-control">{{ old('officeAddress') }}</textarea>
                                                @error('officeAddress') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label>Office City: </label>
                                                <input type="text" value="{{ old('officeCity') }}" placeholder="Office City" name="officeCity" class="form-control">
                                                @error('officeCity') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label>Office State: </label>
                                                <select name="officeState" id="officeState" class="form-control">
                                                    <option selected disabled>-- Select state --</option>
                                                    @foreach($states as $sta)
                                                        <option value="{{$sta->id}}">{{ ucfirst($sta->state_name) }}</option>
                                                    @endforeach
                                                </select>
                                                @error('officeState') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label>Office Telephone: </label>
                                                <input type="text" value="{{ old('officeTelephone') }}" placeholder="Office Telephone" name="officeTelephone" class="form-control">
                                                @error('officeTelephone') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item py-4" data-acc-step>
                                <h5 class="mb-0" data-acc-title><strong>Education</strong></h5>
                                <div data-acc-content class="mt-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card-header"> <strong class="text-info">Primary Education</strong></div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>School: <sup class="text-danger">*</sup></label>
                                                <input placeholder="School" name="primarySchool" id="primarySchool"
                                                          class="form-control" value="{{ old('primarySchool') }}"/>
                                                @error('primarySchool') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>Year of Graduation: <sup class="text-danger">*</sup></label>
                                                <input type="number" value="{{ old('graduationYear') }}" placeholder="Year of Graduation" name="graduationYear" class="form-control">
                                                @error('graduationYear') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>Pri. School Country: <sup class="text-danger">*</sup></label>
                                                <select name="primarySchoolCountry" id="primarySchoolCountry" class="form-control">
                                                    <option selected disabled>-- Select country --</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{$country->id}}">{{ ucfirst($country->name) }}</option>
                                                    @endforeach
                                                </select>
                                                @error('primarySchoolCountry') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card-header"> <strong class="text-info">Secondary Education</strong></div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>College: <sup class="text-danger">*</sup></label>
                                                <input placeholder="College"  name="collegeName" id="collegeName"
                                                       class="form-control" value="{{ old('collegeName') }}"/>
                                                @error('collegeName') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>Year of Graduation: <sup class="text-danger">*</sup></label>
                                                <input value="{{ old('secondaryGraduationYear') }}" type="number" placeholder="Year of Graduation" name="secondaryGraduationYear" class="form-control">
                                                @error('secondaryGraduationYear') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>Sec. School Country: <sup class="text-danger">*</sup></label>
                                                <select name="secondarySchoolCountry" id="secondarySchoolCountry" class="form-control">
                                                    <option selected disabled>-- Select country --</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{$country->id}}">{{ ucfirst($country->name) }}</option>
                                                    @endforeach
                                                </select>
                                                @error('secondarySchoolCountry') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="card-header"> <strong class="text-info">Graduate Qualification</strong></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3 col-lg-3">
                                                    <div class="form-group">
                                                        <label>Institution: </label>
                                                        <select name="graduateInstitution" id="graduateInstitution" class="form-control">
                                                            <option selected disabled>-- Select institution --</option>
                                                            @foreach($institutions as $inst)
                                                                <option value="{{$inst->id}}">{{ ucwords(strtolower($inst->institution_name)) }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('graduateInstitution') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-lg-3">
                                                    <div class="form-group">
                                                        <label>Qualification: </label>
                                                        <select name="graduateQualification" id="graduateQualification" class="form-control">
                                                            <option selected disabled>-- Select qualification --</option>
                                                            @foreach($qualifications as $qua)
                                                                <option value="{{$qua->id}}">{{ ucfirst($qua->qualification_name) }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('graduateQualification') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-lg-2">
                                                    <div class="form-group">
                                                        <label>Discipline: </label>
                                                        <select name="graduateDiscipline" id="graduateDiscipline" class="form-control">
                                                            <option selected disabled>-- Select discipline --</option>
                                                            @foreach($disciplines as $dis)
                                                                <option value="{{$dis->id}}">{{ ucfirst($dis->discipline_name) }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('graduateDiscipline') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-2 col-lg-2">
                                                    <div class="form-group">
                                                        <label>Year of Graduation: </label>
                                                        <input type="number" name="graduateGraduationYear" placeholder="Year of Graduation" value="{{old('graduateGraduationYear')}}" class="form-control">
                                                        @error('graduateGraduationYear') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-lg-2">
                                                    <div class="form-group">
                                                        <label>Institution Country: </label>
                                                        <select name="graduateInstitutionCountry" id="graduateInstitutionCountry" class="form-control">
                                                            <option selected disabled>-- Select country --</option>
                                                            @foreach($countries as $country)
                                                                <option value="{{$country->id}}">{{ ucfirst(strtolower($country->name)) }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('graduateInstitutionCountry') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="card-header"> <strong class="text-info">Post Graduate Qualification</strong></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3 col-lg-3">
                                                    <div class="form-group">
                                                        <label>Institution: </label>
                                                        <select name="postGraduateInstitution" id="postGraduateInstitution" class="form-control">
                                                            <option selected disabled>-- Select institution --</option>
                                                            @foreach($institutions as $institute)
                                                                <option value="{{$institute->id}}">{{ ucfirst($institute->institution_name) }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('postGraduateInstitution') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-lg-3">
                                                    <div class="form-group">
                                                        <label>Qualification: </label>
                                                        <select name="postGraduateQualification" id="postGraduateQualification" class="form-control">
                                                            <option selected disabled>-- Select qualification --</option>
                                                            @foreach($qualifications as $qualif)
                                                                <option value="{{$qualif->id}}">{{ ucfirst($qualif->qualification_name) }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('postGraduateQualification') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-lg-2">
                                                    <div class="form-group">
                                                        <label>Discipline: </label>
                                                        <select name="postGraduateDiscipline" id="postGraduateDiscipline" class="form-control">
                                                            <option selected disabled>-- Select discipline --</option>
                                                            @foreach($disciplines as $disci)
                                                                <option value="{{$disci->id}}">{{ ucfirst($disci->discipline_name) }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('postGraduateDiscipline') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-2 col-lg-2">
                                                    <div class="form-group">
                                                        <label>Year of Graduation: </label>
                                                        <input type="number" name="postGraduationYear" placeholder="Year of Graduation" value="{{old('postGraduationYear')}}" class="form-control">
                                                        @error('postGraduationYear') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-lg-2">
                                                    <div class="form-group">
                                                        <label>Institution Country: </label>
                                                        <select name="postGraduateInstitutionCountry" id="postGraduateInstitutionCountry" class="form-control">
                                                            <option selected disabled>-- Select country --</option>
                                                            @foreach($countries as $country)
                                                                <option value="{{$country->id}}">{{ ucfirst($country->name) }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('postGraduateInstitutionCountry') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="card-header"> <strong class="text-info">Professional Qualifications</strong></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3 col-lg-3">
                                                    <div class="form-group">
                                                        <label>1st Prof. Qualification: </label>
                                                        <input type="text" name="professionalQualification" placeholder="First Professional Qualification" value="{{old('professionalQualification')}}" class="form-control">
                                                        @error('professionalQualification') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-lg-3">
                                                    <div class="form-group">
                                                        <label>Year Qualified: </label>
                                                        <input type="number" name="professionalQualificationYear" placeholder="Year Qualified" value="{{old('professionalQualificationYear')}}" class="form-control">
                                                        @error('professionalQualificationYear') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-lg-3">
                                                    <div class="form-group">
                                                        <label>2nd Prof. Qualification: </label>
                                                        <input type="text" name="secondProfessionalQualification" placeholder="Second Professional Qualification" value="{{old('secondProfessionalQualification')}}" class="form-control">
                                                        @error('secondProfessionalQualification') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-lg-3">
                                                    <div class="form-group">
                                                        <label>Year Qualified: </label>
                                                        <input type="number" name="secondProfessionalQualificationYear" placeholder="Year Qualified" value="{{old('secondProfessionalQualificationYear')}}" class="form-control">
                                                        @error('secondProfessionalQualificationYear') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item py-4" data-acc-step>
                                <h5 class="mb-0" data-acc-title><strong>Work Experience</strong></h5>
                                <div data-acc-content class="mt-4">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="card-header"> <strong class="text-info">Work Experience (Current Job)</strong></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4 col-lg-4">
                                                    <div class="form-group">
                                                        <label>Company Name: </label>
                                                        <input type="text" name="companyName" placeholder="Company Name" value="{{old('companyName')}}" class="form-control">
                                                        @error('companyName') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-lg-4">
                                                    <div class="form-group">
                                                        <label>Department: </label>
                                                        <input type="text" name="department" placeholder="Department" value="{{old('department')}}" class="form-control">
                                                        @error('department') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-lg-4">
                                                    <div class="form-group">
                                                        <label>Position: </label>
                                                        <input type="text" name="position" placeholder="Position" value="{{old('position')}}" class="form-control">
                                                        @error('position') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4 col-lg-4">
                                                    <div class="form-group">
                                                        <label>Start Date: </label>
                                                        <input type="date" name="startDate" placeholder="Start Date" value="{{old('startDate')}}" class="form-control">
                                                        @error('startDate') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-lg-4">
                                                    <div class="form-group">
                                                        <label>Sector 1: </label>
                                                        <select name="sectorOne" id="sectorOne" class="form-control">
                                                            <option disabled selected>-- Select sector 1 --</option>
                                                            <option value="1">Federal Government</option>
                                                            <option value="2">State Government</option>
                                                            <option value="3">Local Government</option>
                                                            <option value="4">Private</option>
                                                        </select>
                                                        @error('sectorOne') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-lg-4">
                                                    <div class="form-group">
                                                        <label>Sector 2: </label>
                                                        <select name="sectorTwo" id="sectorTwo" class="form-control">
                                                            <option disabled selected>-- Select sector 2 --</option>
                                                            @foreach($sectortwo as $sector)
                                                                <option value="{{$sector->id}}">{{$sector->sector_name ?? '' }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('sectorTwo') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item py-4" data-acc-step>
                                <h5 class="mb-0" data-acc-title><strong>Supporting Documents</strong></h5>
                                <div data-acc-content class="mt-4">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label>Documents <small>(You can upload multiple documents at once)</small>: <sup class="text-danger">*</sup></label>
                                                <input type="file" name="supportingDocuments[]" multiple class="form-control-file">
                                                @error('supportingDocuments') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item py-4" data-acc-step>
                                <h5 class="mb-0" data-acc-title><strong>References</strong></h5>
                                <div data-acc-content class="mt-4">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="card-header"> <strong class="text-info">Reference 1</strong></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Referee 1 Name: </label>
                                                        <input type="text" name="refereeOneName" placeholder="Referee One Name" value="{{old('refereeOneName')}}" class="form-control">
                                                        @error('refereeOneName') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Referee 1 Membership Number: </label>
                                                        <input type="text" name="refereeOneMembershipNo" placeholder="Referee One MembershipNo" value="{{old('refereeOneMembershipNo')}}" class="form-control">
                                                        @error('refereeOneMembershipNo') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Referee 1 GSM Number: </label>
                                                        <input type="text" name="refereeOneGSM" placeholder="Referee One GSM" value="{{old('refereeOneGSM')}}" class="form-control">
                                                        @error('refereeOneGSM') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Sponsoring/Referee District Society: </label>
                                                        <select name="sponsoringDistrictSociety" id="sponsoringDistrictSociety" class="form-control">
                                                            <option selected disabled>-- Select district society --</option>
                                                            @foreach($districts as $district)
                                                                <option value="{{$district->id}}">{{ ucwords(strtolower($district->district_name)) }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('sponsoringDistrictSociety') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @elseif(Auth::user()->account_status == 1)
        <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="wideget-user text-center">
                        <div class="wideget-user-desc">
                            <div class="d-flex justify-content-between">
                                @if($user->account_status == 1)
                                    <label for="" class="badge badge-info ">Active</label>
                                @elseif($user->account_status == 0)
                                    <label for="" class="badge badge-secondary "> <i class="fe fe-clock"></i> Incomplete</label>
                                @elseif($user->account_status == 2)
                                    <label for="" class="badge badge-warning "> <i class="fe fe-loader"></i> Pending</label>
                                @elseif($user->account_status == 3)
                                    <label for="" class="badge badge-primary "> <i class="fe fe-clock"></i> Paid</label>
                                @elseif($user->account_status == 4)
                                    <label for="" class="badge badge-secondary "> <i class="fe fe-check"></i> Verified</label>
                                @endif

                                @if(Auth::user()->user_type == 1)

                                <label data-toggle="modal" data-target="#status-update" style="cursor: pointer;" for="" class="badge badge-info ">Update Status <i class="fe fe-edit"></i> </label>

                                @endif
                            </div>
                            <div class="wideget-user-img">
                                <img class="" src="/assets/drive/{{Auth::user()->avatar ?? "avatar.jpg"}}" alt="img">
                            </div>
                            <div class="user-wrap">
                                <h4 class="mb-1">{{$user->first_name ?? '' }} {{$user->surname ?? '' }}</h4>
                                <h6 class="text-muted mb-4"><span class="badge text-white rounded-pill bg-success me-1 mb-1 mt-1">{{ $user->getMembership->name ?? ''  }}</span> </h6>
                            </div>
                            <span> <i class="fe fa-pencil text-warning"></i> </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="media-heading">
                        <h5 style="border-bottom: 2px solid #3E4999; padding-bottom: 10px;"><strong class="text-info">Work Experience</strong> </h5>
                    </div>
                    <div class="table-responsive ">
                        <table class="table row table-borderless">
                            <tbody class="col-lg-12 col-xl-6 p-0">
                            <tr>
                                <td><strong>Company Name :</strong> {{$user->company_name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Position :</strong> {{$user->position ?? ''}}</td>
                            </tr>
                            <tr>
                                <td><strong>Sector 1 :</strong> {{$user->mobile_no ?? ''}}</td>
                            </tr>
                            </tbody>


                            <tbody class="col-lg-12 col-xl-6 p-0">
                            <tr>
                                <td><strong>Department :</strong> {{$user->department ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Start Date :</strong> {{ !is_null($user->start_date) ? date('d M, Y', strtotime($user->start_date)) : '' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Sector 2 :</strong> {{ $user->getSectorTwo->sector_name  ?? '' }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="media-heading">
                        <h5 style="border-bottom: 2px solid #3E4999; padding-bottom: 10px;"><strong class="text-info">References</strong> </h5>
                    </div>
                    <div class="table-responsive ">
                        <table class="table row table-borderless">
                            <tbody class="col-lg-12 col-xl-6 p-0">
                            <tr>
                                <td><strong>Referee 1 Name :</strong> {{$user->referee_name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Referee 1 GSM Number :</strong> {{$user->referee_mobile_no ?? ''}}</td>
                            </tr>
                            </tbody>


                            <tbody class="col-lg-12 col-xl-6 p-0">
                            <tr>
                                <td><strong>Referee 1 Membership Number :</strong> {{$user->referee_membership_no ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Sponsoring/Referee District Society :</strong> {{$user->getSponsoringDistrict->district_name ?? '' }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="wideget-user-tab">
                    <div class="tab-menu-heading">
                        <div class="tabs-menu1">
                            <ul class="nav">
                                <li class=""><a href="#tab-51" class="active show" data-toggle="tab">Profile</a></li>
                                <li><a href="#tab-62" data-toggle="tab" class="">Supporting Documents</a></li>

                                @if(Auth::user()->id == $user->id)
                                    <li><a href="#tab-61" data-toggle="tab" class="">Profile Picture</a></li>
                                    <li><a href="#tab-81" data-toggle="tab" class="">Change Password</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                @if(session()->has('success'))
                    <div class="alert alert-success mb-4">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Great!</strong>
                        <hr class="message-inner-separator">
                        <p>{!! session()->get('success') !!}</p>
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-warning mb-4">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Whoops!</strong>
                        <hr class="message-inner-separator">
                        <p>{!! session()->get('error') !!}</p>
                    </div>
                @endif
            </div>

            <div class="tab-content">
                <div class="tab-pane active show" id="tab-51">
                    <div class="card">
                        <div class="card-body">
                            <div id="profile-log-switch">
                                <div class="media-heading">
                                    <h5 style="border-bottom: 2px solid #3E4999; padding-bottom: 10px;"><strong class="text-info">Personal Information</strong></h5>
                                </div>
                                <div class="table-responsive ">
                                    <table class="table row table-borderless">
                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                            <td><strong>First Name :</strong> {{$user->first_name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Middle Name :</strong> {{$user->middle_name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Mobile No. :</strong> {{$user->mobile_no ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Gender :</strong> {{$user->gender == 1 ? 'Male' : 'Female' }}</td>
                                        </tr>

                                        <tr>
                                            <td><strong>Nationality :</strong> {{$user->getCountryById($user->nationality)->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>LGA :</strong> {{$user->getLocalGovernment->local_name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Contact City :</strong> {{$user->contact_city ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Contact Country :</strong> {{$user->getCountryById($user->contact_country)->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Heard of CIDSAN from :</strong> {{$user->getHeardFrom->name ?? ''  }}</td>
                                        </tr>


                                        </tbody>
                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                            <td><strong>Surname. :</strong> {{$user->surname ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email :</strong> {{$user->email ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Date of Birth :</strong> {{ date('d M, Y', strtotime($user->birth_date)) ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Marital Status :</strong> {{ $user->getMaritalStatus->name ?? ''  }} </td>
                                        </tr>

                                        <tr>
                                            <td><strong>State of Origin :</strong> {{$user->getStateById($user->state_origin)->state_name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Contact Address :</strong> {{$user->contact_address ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Contact State :</strong> {{$user->getStateById($user->contact_state)->state_name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Geo-political Zone :</strong> {{$user->getGeoZone->geo_name ?? '' }}</td>
                                        </tr>



                                        </tbody>
                                    </table>
                                </div>
                                <div class="media-heading">
                                    <h5 style="border-bottom: 2px solid #3E4999; padding-bottom: 10px;"><strong class="text-info">Address</strong> </h5>
                                </div>
                                <div class="table-responsive ">
                                    <table class="table row table-borderless">
                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                            <td><strong>Residential Address :</strong> {{$user->residential_address ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Residential State :</strong> {{$user->getStateById($user->residential_state)->state_name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Office Address :</strong> {{$user->office_address ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Office State :</strong> {{$user->getStateById($user->office_state)->state_name ?? ''  }}</td>
                                        </tr>



                                        </tbody>
                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                            <td><strong>Residential City. :</strong> {{$user->residential_city ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Residential Telephone :</strong> {{$user->residential_telephone ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Office City :</strong> {{ $user->office_city ?? ''  }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Office Telephone :</strong> {{ $user->office_telephone ?? ''  }}</td>
                                        </tr>





                                        </tbody>
                                    </table>
                                </div>
                                <div class="media-heading">
                                    <h5 style="border-bottom: 2px solid #3E4999; padding-bottom: 10px;"><strong class="text-info">Education</strong> </h5>
                                </div>
                                <h6 class="text-info"><li><strong>Primary</strong></li></h6>
                                <div class="table-responsive ">
                                    <table class="table row table-borderless">
                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                            <tr>
                                                <td><strong>School :</strong> {{$user->primary_school ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Country :</strong> {{$user->getCountryById($user->primary_school_country)->name ?? ''}}</td>
                                            </tr>
                                        </tbody>


                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                            <tr>
                                                <td><strong>Year of Graduation :</strong> {{$user->primary_graduate_year ?? '' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h6 class="text-info"><li><strong>Secondary</strong></li></h6>
                                <div class="table-responsive ">
                                    <table class="table row table-borderless">
                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                            <tr>
                                                <td><strong>College :</strong> {{$user->college_name ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Country :</strong> {{$user->getCountryById($user->secondary_school_country)->name ?? ''}}</td>
                                            </tr>
                                        </tbody>


                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                            <tr>
                                                <td><strong>Year of Graduation :</strong> {{$user->secondary_graduate_year ?? '' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h6 class="text-info"><li><strong>Graduate Qualification</strong></li></h6>
                                <div class="table-responsive ">
                                    <table class="table row table-borderless">
                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                            <td><strong>Institution :</strong> {{$user->getInstitution($user->graduate_institution)->institution_name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Discipline :</strong> {{$user->getDiscipline($user->graduate_discipline)->discipline_name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Institution Country :</strong> {{$user->getCountryById($user->graduate_institution_country)->name ?? ''}}</td>
                                        </tr>
                                        </tbody>


                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                            <td><strong>Qualification :</strong> {{$user->getQualification($user->graduate_qualification)->qualification_name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Year of Graduation :</strong> {{$user->graduate_graduation_year ?? '' }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <h6 class="text-info"><li><strong>Post Graduate Qualification</strong></li></h6>
                                <div class="table-responsive ">
                                    <table class="table row table-borderless">
                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                            <td><strong>Institution :</strong> {{$user->getInstitution($user->post_graduate_institution)->institution_name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Discipline :</strong> {{$user->getDiscipline($user->post_graduate_discipline)->discipline_name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Institution Country :</strong> {{$user->getCountryById($user->post_graduate_institution_country)->name ?? ''}}</td>
                                        </tr>
                                        </tbody>


                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                            <td><strong>Qualification :</strong> {{$user->getQualification($user->post_graduate_qualification)->qualification_name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Year of Graduation :</strong> {{$user->post_graduate_year ?? '' }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <h6 class="text-info">
                                    <li>
                                        <strong>Professional Qualification</strong>
                                    </li>
                                </h6>
                                <div class="table-responsive ">
                                    <table class="table row table-borderless">
                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                            <td><strong>1st Prof. Qualification :</strong> {{$user->getQualification($user->professional_qualification)->qualification_name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>2nd Prof. Qualification :</strong> {{$user->getQualification($user->second_professional_qualification)->qualification_name ?? ''}}</td>
                                        </tr>
                                        </tbody>


                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                            <td><strong>Year Qualified :</strong> {{$user->professional_qualification_year ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Year Qualified :</strong> {{$user->second_professional_qualification_year ?? '' }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>




                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-62">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($documents as $file)
                                    @switch(pathinfo($file->attachment, PATHINFO_EXTENSION))
                                        @case('pptx')
                                        <div class="col-md-4 mb-4">
                                            <a href="button" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}" style="cursor: pointer;">
                                                <img src="/assets/formats/ppt.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect" href="{{route('download-attachment',['slug'=>$file->attachment, 'account'=>$account])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect deleteFile"  data-toggle="modal" data-target="#deleteModal" data-directory="{{$file->attachment}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>

                                        @break
                                        @case('pdf')
                                        <div class="col-md-4 mb-4">
                                            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}" style="cursor: pointer;">
                                                <img src="/assets/formats/pdf.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"> <br>
                                                {{$file->name ?? '' }}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect" href="{{route('download-attachment',['slug'=>$file->attachment])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect deleteFile"  data-toggle="modal" data-target="#deleteModal" data-directory="{{$file->attachment}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('doc')
                                        <div class="col-md-4 mb-4">
                                            <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{$file->name ?? '' }}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect" href="{{route('download-attachment',['slug'=>$file->attachment])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <div class="dropdown-divider"></div>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('docx')
                                        <div class="col-md-4 mb-4">
                                            <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{$file->name ?? '' }}
                                            </a>
                                            <div class="dropdown-secondary dropdown ">
                                                <button style="margin-left: 50px;" class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect" href="{{route('download-attachment',['slug'=>$file->attachment])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <div class="dropdown-divider"></div>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('jpeg')
                                        <div class="col-md-4 mb-4">
                                            <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/jpg.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{$file->name ?? '' }}
                                            </a>
                                            <div class="dropdown-secondary dropdown ">
                                                <button style="margin-left: 50px;" class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"  type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect" href="{{route('download-attachment',['slug'=>$file->attachment])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <div class="dropdown-divider"></div>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('jpg')
                                        <div class="col-md-4 mb-4">
                                            <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/jpg.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{$file->name ?? '' }}
                                            </a>
                                            <div class="dropdown-secondary dropdown ">
                                                <button style="margin-left: 50px;" class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect" href="{{route('download-attachment',['slug'=>$file->attachment])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <div class="dropdown-divider"></div>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('png')
                                        <div class="col-md-4 mb-4">
                                            <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/png.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{$file->name ?? '' }}
                                            </a>
                                            <div class="dropdown-secondary dropdown ">
                                                <button style="margin-left: 50px;" class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect" href="{{route('download-attachment',['slug'=>$file->attachment])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <div class="dropdown-divider"></div>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                    @endswitch
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
                @if(Auth::user()->id == $user->id)
                <div class="tab-pane" id="tab-61">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('change-avatar', ['account'=>$account])}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="file" name="passportPhoto" class="form-control-file">
                                    @error('passportPhoto') <i class="text-danger">{{$message}}</i>@enderror
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <button class="btn btn-primary">Save Image</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-81">
                    <div class="row">
                        <form action="{{route('change-password', ['account'=>$account])}}" method="post">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Change Password</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputname">Current Password</label>
                                                <input type="password" class="form-control" placeholder="Current Password" name="current_password">
                                                @error('current_password') <i class="text-danger">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputname">New Password</label>
                                                <input type="password" class="form-control" placeholder="New Password" name="password">
                                                @error('password') <i class="text-danger">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputname">Re-type Password</label>
                                                <input type="password" class="form-control" placeholder="Re-type Password" name="password_confirmation">
                                                @error('password_confirmation') <i class="text-danger">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success mt-1">Change Password</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div><!-- COL-END -->
    </div>
    @elseif(Auth::user()->account_status == 2)
        <div class="row">
            <div class="col-lg-12">
                <div class="card accordion-wizard">
                    <div class="card-header">
                        <h3 class="card-title">Payment</h3>
                    </div>
                    <div class="card-body">
                        <p>Proceed to make payment</p>
                        @if(session()->has('success'))
                            <div class="alert alert-success mb-4">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <strong>Great!</strong>
                                <hr class="message-inner-separator">
                                <p>{!! session()->get('success') !!}</p>
                            </div>
                        @endif
                        <form id="form" action="{{ route('update-profile') }}" method="post">
                            @csrf
                            payment modalities
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-warning" id="exampleModalLabel">Warning</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('delete-file', ['account'=>$account])}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">This action cannot be undone. Are you sure you want to delete <strong id="file"></strong>?</label>
                                </div>
                            </div>
                            <input type="hidden" name="directory" id="directory">
                            <input type="hidden" name="key" id="key">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group">
                            <button data-dismiss="modal" type="button" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i>Cancel</button>
                            <button type="submit" class="btn btn-primary btn-mini"><i class="ti-check mr-2"></i>Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="status-update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-warning" id="exampleModalLabel"> Status Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('user-status-update')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                        <option value="4">Verified</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="userId" value="{{ $user->id }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group">
                            <button data-dismiss="modal" type="button" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i>Cancel</button>
                            <button type="submit" class="btn btn-primary btn-mini"><i class="ti-check mr-2"></i>Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script src="/assets/plugins/formwizard/jquery.smartWizard.js"></script>
    <script src="/assets/plugins/formwizard/fromwizard.js"></script>
    <script src="/assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js"></script>
    <script src="/assets/js/advancedform.js"></script>
    <script src="/vendor/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="/js/select2-init.js" type="text/javascript"></script>
    <script src="/js/axios.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#stateOfOrigin').on('change', function(e){
                e.preventDefault();
                axios.post('/load-local-governments', {stateOfOrigin:$(this).val()})
                    .then(response=>{
                        $('#localGovtAreaWrapper').html(response.data);
                        $('#localGovtArea').select2();
                    });
            });
        });
    </script>
@endsection
