@extends('layouts.master-layout')
@section('active-page')
    Manage Members
@endsection
@section('title')
    Manage Members
@endsection
@section('extra-styles')

    <link href="/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
@endsection
@section('breadcrumb-action-btn')

    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-icon text-white">
        <span>
            <i class="fe fe-skip-back"></i>
        </span> Go Back
    </a>

@endsection

@section('main-content')
    <div class="row">

        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-1">
                        <div class="col">
                            <p class="mb-1">Members</p>
                            <h3 class="mb-0 number-font">{{number_format($users->where('user_type',0)->count())}}</h3>
                        </div>
                        <div class="col-auto mb-0">
                            <div class="dash-icon text-secondary1">
                                <i class="bx bxs-user"></i>
                            </div>
                        </div>
                    </div>
                    <span class="fs-12 text-muted"> <span class="text-muted fs-12 ml-0 mt-1">Total</span></span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-1">
                        <div class="col">
                            <p class="mb-1">Members</p>
                            <h3 class="mb-0 number-font">{{number_format($users->where('user_type',0)->where('account_status',0)->count())}}</h3>
                        </div>
                        <div class="col-auto mb-0">
                            <div class="dash-icon text-orange">
                                <i class="bx bxs-book-open"></i>
                            </div>
                        </div>
                    </div>
                    <span class="fs-12 text-muted"> <span class="text-muted fs-12 ml-0 mt-1">Incomplete</span></span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-1">
                        <div class="col">
                            <p class="mb-1">Members</p>
                            <h3 class="mb-0 number-font">{{number_format($users->where('user_type',0)->where('account_status',4)->count())}}</h3>
                        </div>
                        <div class="col-auto mb-0">
                            <div class="dash-icon text-secondary">
                                <i class="bx bxs-badge-dollar"></i>
                            </div>
                        </div>
                    </div>
                    <span class="fs-12 text-muted">  <span class="text-muted fs-12 ml-0 mt-1">Active</span></span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-1">
                        <div class="col">
                            <p class="mb-1">Members</p>
                            <h3 class="mb-0 number-font">{{number_format($users->where('user_type',0)->where('account_status',5)->count())}}</h3>
                        </div>
                        <div class="col-auto mb-0">
                            <div class="dash-icon text-warning">
                                <i class="bx bxs-calendar"></i>
                            </div>
                        </div>
                    </div>
                    <span class="fs-12 text-muted">  <span class="text-muted fs-12 ml-0 mt-1">Expired Subscription</span></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success mb-4">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Great!</strong>
                            <hr class="message-inner-separator">
                            <p>{!! session()->get('success') !!}</p>
                        </div>
                    @endif
                   <div class="table-responsive">
                            <table id="data-table1" class="table table-striped table-bordered text-nowrap w-100">
                                <thead>
                                <tr>
                                    <th class="">#</th>
                                    <th class="wd-15p">First name</th>
                                    <th class="wd-15p">Last name</th>
                                    <th class="wd-20p">Status</th>
                                    <th class="wd-20p">Category</th>
                                    <th class="wd-15p">Phone No.</th>
                                    <th class="wd-25p">E-mail</th>
                                    <th class="wd-25p">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $serial = 1; @endphp
                                @foreach($users->where('user_type',0)->where('account_status',3) as $user)
                                    <tr>
                                        <td>{{$serial++}}</td>
                                        <td>{{$user->first_name ?? '' }}</td>
                                        <td>{{$user->surname ?? '' }}</td>
                                        <td>
                                            @if($user->account_status == 1)
                                                <label for="" class="text-info ">Payment not verified </label>
                                            @elseif($user->account_status == 0)
                                                <label for="" class="text-secondary "> Incomplete</label>
                                            @elseif($user->account_status == 2)
                                                <label for="" class="text-warning ">  Pending approval</label>
                                            @elseif($user->account_status == 3)
                                                <label for="" class="text-primary ">  Active</label>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $user->getMembership->name ?? ''  }}
                                        </td>
                                        <td>{{$user->mobile_no ?? '' }}</td>
                                        <td>{{$user->email ?? '' }}</td>
                                        <td><a href="{{route('view-member-profile', ['account'=>$account, 'slug'=>$user->slug])}}" class="btn btn-info btn-sm"><i class="ti-eye mr-2"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script src="/assets/plugins/datatable/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatable/datatable.js"></script>
    <script src="/assets/plugins/datatable/dataTables.responsive.min.js"></script>
@endsection
