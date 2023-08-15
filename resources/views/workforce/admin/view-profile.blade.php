@extends('layouts.master-layout')
@section('active-page')
    Member Profile
@endsection
@section('title')
    Member Profile
@endsection
@section('extra-styles')
    <link href="/assets/plugins/formwizard/smart_wizard.css" rel="stylesheet">
    <link href="/assets/plugins/formwizard/smart_wizard_theme_arrows.css" rel="stylesheet">
    <link href="/assets/plugins/formwizard/smart_wizard_theme_circles.css"  rel="stylesheet">
    <link href="/assets/plugins/formwizard/smart_wizard_theme_dots.css" rel="stylesheet">
    <link href="/assets/plugins/forn-wizard/css/demo.css" rel="stylesheet">

@endsection
@section('breadcrumb-action-btn')
    <div class="btn-group">
        <a href="{{url()->previous()}}" class="btn btn-primary btn-icon text-white">
        <span>
            <i class="fe fe-skip-back"></i>
        </span> Go Back
        </a>
        @if($user->account_status == 1)
            @if($user->payment_method_verification == 0)
                <a data-toggle="modal" data-target="#verifyPaymentModal" href="#" class="btn btn-warning btn-icon text-white">
                    <span>
                        <i class="fe fe-check-circle"></i>
                    </span> Verify Payment
                </a>
            @endif
        <a data-toggle="modal" data-target="#deleteModal" href="#" class="btn btn-danger btn-icon text-white">
            <span>
                <i class="fe fe-trash"></i>
            </span> Delete Profile
        </a>
        @endif
        <a data-toggle="modal" data-target="#status-update" href="#" class="btn btn-info btn-icon text-white">
            <span>
                <i class="fe fe-check-circle"></i>
            </span> Approve Membership
        </a>
    </div>



@endsection

@section('main-content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="wideget-user text-center">
                        <div class="wideget-user-desc">
                            <div class="d-flex justify-content-between">
                                @if($user->account_status == 1)
                                    <label for="" class="badge badge-info ">Payment not verified </label>
                                @elseif($user->account_status == 0)
                                    <label for="" class="badge badge-secondary "> <i class="fe fe-clock"></i> Incomplete</label>
                                @elseif($user->account_status == 2)
                                    <label for="" class="badge badge-warning "> <i class="fe fe-loader"></i> Pending approval</label>
                                @elseif($user->account_status == 3)
                                    <label for="" class="badge badge-primary "> <i class="fe fe-check-circle"></i> Active</label>
                                @endif
                            </div>
                            <div class="wideget-user-img">
                                <img class="" src="/assets/drive/{{$user->avatar ?? "avatar.jpg"}}" alt="img">
                            </div>
                            <div class="user-wrap">
                                <h4 class="mb-1">{{$user->first_name ?? '' }} {{$user->surname ?? '' }}</h4>
                                <h6 class="text-muted mb-4"><b class="badge text-white rounded-pill bg-danger me-1 mb-1 mt-1">{{ $user->getMembership->name ?? ''  }}</b> </h6>
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
            @if(Auth::user()->user_type == 1 && $user->account_status > 0)
                <div class="card">
                    <div class="card-body">
                        <div class="media-heading">
                            <h5 style="border-bottom: 2px solid #3E4999; padding-bottom: 10px;"><strong class="text-info">Administrative Action</strong> </h5>
                        </div>
                        <div class="table-responsive ">
                            <table class="table row table-borderless">
                                <tbody class="col-lg-12 col-xl-12 p-0">
                                <tr>
                                    <td><strong>Approved by :</strong> {{$user->getApprovedBy->first_name ?? '' }} {{$user->getApprovedBy->surname ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Date Approved :</strong> {{ !is_null($user->date_approved)  ? date('d M, Y', strtotime($user->date_approved)) : '-'}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Payment Method :</strong> {{ $user->payment_method == 1 ? 'Online Payment' : 'Offline Payment(Bank)' }}</td>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            @endif
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
                                            <td><strong>Gender :</strong> {{$user->gender == 1 ? 'Female' : 'Male' }}</td>
                                        </tr>

                                        <tr>
                                            <td><strong>Nationality :</strong> {{$user->getCountryById($user->nationality)->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>LGA :</strong> {{$user->getLocalGovernment->local_name ?? ''}}</td>
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
                                            <td><strong>Date of Birth :</strong> {{ !is_null($user->birth_date) ? date('d M, Y', strtotime($user->birth_date)) : '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Marital Status :</strong> {{ $user->getMaritalStatus->name ?? ''  }} </td>
                                        </tr>

                                        <tr>
                                            <td><strong>State of Origin :</strong> {{$user->getStateById($user->state_origin)->state_name ?? '' }}</td>
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
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-warning" id="exampleModalLabel">Warning</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('delete-profile')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">This action cannot be undone. Are you sure you want to <span class="text-danger">delete</span> <strong>{{ $user->surname ?? '' }}'s</strong> profile?</label>
                                </div>
                            </div>
                            <input type="hidden" name="userId" value="{{ $user->id }}">
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

    <div class="modal fade" id="verifyPaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-warning" id="exampleModalLabel">Are you sure?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('verify-payment')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">This action cannot be undone. Are you sure you want to verify <strong>{{ $user->surname ?? '' }}'s</strong> payment?</label>
                                </div>
                            </div>
                            <input type="hidden" name="userId" value="{{ $user->id }}">
                            <input type="hidden" name="account_status" value="{{ $user->account_status }}">
                            <input type="hidden" name="membershipPlan" value="4"> <!-- Code for verification -->
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
                    <h5 class="modal-title text-warning" id="exampleModalLabel">  Membership Approval</h5>
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
                                    <input type="hidden" name="status" value="3">
                                </div>
                            </div>
                            @if($user->account_status > 0)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Membership Plan: <sup class="text-danger">*</sup></label>
                                        <select name="membershipPlan" id="membershipPlan" class="form-control">
                                            <option selected disabled>-- Select plan --</option>
                                            @foreach($plans as $p)
                                                <option value="{{ $p->id }}" {{ $user->membership_plan_id == $p->id ? 'selected' : ''  }}>{{$p->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                        @error('membershipPlan') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                    </div>
                                </div>
                            @endif
                            <input type="hidden" name="userId" value="{{ $user->id }}">
                            <input type="hidden" name="account_status" value="{{ $user->account_status }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group">
                            <button data-dismiss="modal" type="button" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i>Cancel</button>
                            <button type="submit" class="btn btn-primary btn-mini"><i class="ti-check mr-2"></i>Approve</button>
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
@endsection
