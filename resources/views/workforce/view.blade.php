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
    @include('contacts.partials._menu')
@endsection

@section('main-content')
    @if(Auth::user()->account_status == 0)
        <div class="row">
        <div class="col-lg-12">
            <div class="card accordion-wizard">
                <div class="card-header">
                    <h3 class="card-title">New Professional Student Registration</h3>
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
                    <form id="form" action="{{ route('update-profile') }}" method="post">
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
                                                <label>Office Address: <sup class="text-danger">*</sup></label>
                                                <textarea placeholder="Office Address" name="officeAddress" id="officeAddress" style="resize: none;"
                                                          class="form-control">{{ old('officeAddress') }}</textarea>
                                                @error('officeAddress') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label>Office City: <sup class="text-danger">*</sup></label>
                                                <input type="text" value="{{ old('officeCity') }}" placeholder="Office City" name="officeCity" class="form-control">
                                                @error('officeCity') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label>Office State: <sup class="text-danger">*</sup></label>
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
                                                <label>Office Telephone: <sup class="text-danger">*</sup></label>
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
                                                        <label>Institution: <sup class="text-danger">*</sup></label>
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
                                                        <label>Qualification: <sup class="text-danger">*</sup></label>
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
                                                        <label>Discipline: <sup class="text-danger">*</sup></label>
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
                                                        <label>Year of Graduation: <sup class="text-danger">*</sup></label>
                                                        <input type="number" name="graduateGraduationYear" placeholder="Year of Graduation" value="{{old('graduateGraduationYear')}}" class="form-control">
                                                        @error('graduateGraduationYear') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-lg-2">
                                                    <div class="form-group">
                                                        <label>Institution Country: <sup class="text-danger">*</sup></label>
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
                                                        <label>Institution: <sup class="text-danger">*</sup></label>
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
                                                        <label>Qualification: <sup class="text-danger">*</sup></label>
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
                                                        <label>Discipline: <sup class="text-danger">*</sup></label>
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
                                                        <label>Year of Graduation: <sup class="text-danger">*</sup></label>
                                                        <input type="number" name="postGraduationYear" placeholder="Year of Graduation" value="{{old('postGraduationYear')}}" class="form-control">
                                                        @error('postGraduationYear') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-lg-2">
                                                    <div class="form-group">
                                                        <label>Institution Country: <sup class="text-danger">*</sup></label>
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
                                                        <label>1st Prof. Qualification: <sup class="text-danger">*</sup></label>
                                                        <input type="text" name="professionalQualification" placeholder="First Professional Qualification" value="{{old('professionalQualification')}}" class="form-control">
                                                        @error('professionalQualification') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-lg-3">
                                                    <div class="form-group">
                                                        <label>Year Qualified: <sup class="text-danger">*</sup></label>
                                                        <input type="number" name="professionalQualificationYear" placeholder="Year Qualified" value="{{old('professionalQualificationYear')}}" class="form-control">
                                                        @error('professionalQualificationYear') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-lg-3">
                                                    <div class="form-group">
                                                        <label>2nd Prof. Qualification: <sup class="text-danger">*</sup></label>
                                                        <input type="text" name="secondProfessionalQualification" placeholder="Second Professional Qualification" value="{{old('secondProfessionalQualification')}}" class="form-control">
                                                        @error('secondProfessionalQualification') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-lg-3">
                                                    <div class="form-group">
                                                        <label>Year Qualified: <sup class="text-danger">*</sup></label>
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
                                                        <label>Company Name: <sup class="text-danger">*</sup></label>
                                                        <input type="text" name="companyName" placeholder="Company Name" value="{{old('companyName')}}" class="form-control">
                                                        @error('companyName') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-lg-4">
                                                    <div class="form-group">
                                                        <label>Department: <sup class="text-danger">*</sup></label>
                                                        <input type="text" name="department" placeholder="Department" value="{{old('department')}}" class="form-control">
                                                        @error('department') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-lg-4">
                                                    <div class="form-group">
                                                        <label>Position: <sup class="text-danger">*</sup></label>
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
                                                        <label>Start Date: <sup class="text-danger">*</sup></label>
                                                        <input type="date" name="startDate" placeholder="Start Date" value="{{old('startDate')}}" class="form-control">
                                                        @error('startDate') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-lg-4">
                                                    <div class="form-group">
                                                        <label>Sector 1: <sup class="text-danger">*</sup></label>
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
                                                        <label>Sector 2: <sup class="text-danger">*</sup></label>
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
                                                        <label>Referee 1 Name: <sup class="text-danger">*</sup></label>
                                                        <input type="text" name="refereeOneName" placeholder="Referee One Name" value="{{old('refereeOneName')}}" class="form-control">
                                                        @error('refereeOneName') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Referee 1 Membership Number: <sup class="text-danger">*</sup></label>
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
                                                        <label>Referee 1 GSM Number: <sup class="text-danger">*</sup></label>
                                                        <input type="text" name="refereeOneGSM" placeholder="Referee One GSM" value="{{old('refereeOneGSM')}}" class="form-control">
                                                        @error('refereeOneGSM') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Sponsoring/Referee District Society: <sup class="text-danger">*</sup></label>
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
                            <div class="wideget-user-img">
                                <img class="" src="/assets/drive/{{Auth::user()->avatar ?? "avatar.jpg"}}" alt="img">
                            </div>
                            <div class="user-wrap">
                                <h4 class="mb-1">{{$user->first_name ?? '' }} {{$user->surname ?? '' }}</h4>
                                <h6 class="text-muted mb-4">Member Since: {{date('d M, Y', strtotime($user->created_at))}}</h6>
                            </div>
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
                                <td><strong>Start Date :</strong> {{ date('d M, Y', strtotime($user->start_date)) }}</td>
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
                                    <h5 style="border-bottom: 2px solid #3E4999; padding-bottom: 10px;"><strong class="text-info">Personal Information</strong> <sup>{!! $user->account_status == 1 ? "<span class='text-success'>Active</span>" : "<span class='text-warning'>Inactive</span>"  !!}</sup></h5>
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
                                            <td><strong>Heard of CIDSAN from :</strong> {{$user->gender == 1 ? 'Male' : 'Female' }}</td>
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
                                            <td><strong>Marital Status :</strong> </td>
                                        </tr>

                                        <tr>
                                            <td><strong>State of Origin :</strong> {{$user->getStateById($user->contact_state)->state_name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Contact Address :</strong> {{$user->middle_name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Contact State :</strong> {{$user->mobile_no ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Geo-political Zone :</strong> {{$user->gender == 1 ? 'Male' : 'Female' }}</td>
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
                                            <td><strong>Residential Address :</strong> {{$user->first_name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Residential State :</strong> {{$user->middle_name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Office Address :</strong> {{$user->mobile_no ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Office State :</strong> {{$user->gender == 1 ? 'Male' : 'Female' }}</td>
                                        </tr>



                                        </tbody>
                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                            <td><strong>Residential City. :</strong> {{$user->surname ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Residential Telephone :</strong> {{$user->email ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Office City :</strong> {{ date('d M, Y', strtotime($user->birth_date)) ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Office Telephone :</strong> </td>
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
                                                <td><strong>School :</strong> {{$user->first_name ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Country :</strong> {{$user->middle_name ?? ''}}</td>
                                            </tr>
                                        </tbody>


                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                            <tr>
                                                <td><strong>Year of Graduation :</strong> {{$user->surname ?? '' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h6 class="text-info"><li><strong>Secondary</strong></li></h6>
                                <div class="table-responsive ">
                                    <table class="table row table-borderless">
                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                            <tr>
                                                <td><strong>College :</strong> {{$user->first_name ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Country :</strong> {{$user->middle_name ?? ''}}</td>
                                            </tr>
                                        </tbody>


                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                            <tr>
                                                <td><strong>Year of Graduation :</strong> {{$user->surname ?? '' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h6 class="text-info"><li><strong>Graduate Qualification</strong></li></h6>
                                <div class="table-responsive ">
                                    <table class="table row table-borderless">
                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                            <td><strong>Institution :</strong> {{$user->first_name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Discipline :</strong> {{$user->middle_name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Institution Country :</strong> {{$user->middle_name ?? ''}}</td>
                                        </tr>
                                        </tbody>


                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                            <td><strong>Qualification :</strong> {{$user->surname ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Year of Graduation :</strong> {{$user->surname ?? '' }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <h6 class="text-info"><li><strong>Post Graduate Qualification</strong></li></h6>
                                <div class="table-responsive ">
                                    <table class="table row table-borderless">
                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                            <td><strong>Institution :</strong> {{$user->first_name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Discipline :</strong> {{$user->middle_name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Institution Country :</strong> {{$user->middle_name ?? ''}}</td>
                                        </tr>
                                        </tbody>


                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                            <td><strong>Qualification :</strong> {{$user->surname ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Year of Graduation :</strong> {{$user->surname ?? '' }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <h6 class="text-info"><li><strong>Professional Qualification</strong></li></h6>
                                <div class="table-responsive ">
                                    <table class="table row table-borderless">
                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                            <td><strong>1st Prof. Qualification :</strong> {{$user->first_name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>2nd Prof. Qualification :</strong> {{$user->middle_name ?? ''}}</td>
                                        </tr>
                                        </tbody>


                                        <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                            <td><strong>Year Qualified :</strong> {{$user->surname ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Year Qualified :</strong> {{$user->surname ?? '' }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>




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
