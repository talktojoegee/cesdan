@extends('layouts.master-layout')
@section('active-page')
    Dashboard
@endsection

@section('breadcrumb-action-btn')

@endsection

@section('main-content')
    <!-- Row -->
    <div class="row">

        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-1">
                        <div class="col">
                            <p class="mb-1">Members</p>
                            <h3 class="mb-0 number-font">{{number_format($users->where('user_type', 0)->where('account_status',3)->count() )}}</h3>
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
                            <p class="mb-1">Examinations</p>
                            <h3 class="mb-0 number-font">{{'₦'.number_format($payments->where('posted',1)->sum('amount'))}}</h3>
                        </div>
                        <div class="col-auto mb-0">
                            <div class="dash-icon text-orange">
                                <i class="bx bxs-book-open"></i>
                            </div>
                        </div>
                    </div>
                    <span class="fs-12 text-muted"> <span class="text-muted fs-12 ml-0 mt-1">This Year</span></span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-1">
                        <div class="col">
                            <p class="mb-1">Registrations</p>
                            <h3 class="mb-0 number-font">{{'₦'.number_format(($invoices->where('posted',1)->sum('total')) - ($invoices->where('posted',1)->sum('paid_amount')))}}</h3>
                        </div>
                        <div class="col-auto mb-0">
                            <div class="dash-icon text-secondary">
                                <i class="bx bxs-badge-dollar"></i>
                            </div>
                        </div>
                    </div>
                    <span class="fs-12 text-muted">  <span class="text-muted fs-12 ml-0 mt-1">This Year</span></span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-1">
                        <div class="col">
                            <p class="mb-1">Subscription</p>
                            <h3 class="mb-0 number-font">{{'₦'.number_format(($bills->where('posted',1)->sum('bill_amount')) - ($bills->where('posted',1)->sum('paid_amount')))}}</h3>
                        </div>
                        <div class="col-auto mb-0">
                            <div class="dash-icon text-warning">
                                <i class="bx bxs-credit-card-front"></i>
                            </div>
                        </div>
                    </div>
                    <span class="fs-12 text-muted">  <span class="text-muted fs-12 ml-0 mt-1">This Year</span></span>
                </div>
            </div>
        </div>
    </div>
    <!-- Row-1 End -->

    <!-- ROW-4 -->
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Members</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table1" class="table table-striped table-bordered text-nowrap w-100">
                            <thead>
                            <tr>
                                <th class="">#</th>
                                <th class="wd-15p">First name</th>
                                <th class="wd-15p">Last name</th>
                                <th class="wd-15p">Phone No.</th>
                                <th class="wd-25p">E-mail</th>
                                <th class="wd-20p">Status</th>
                                <th class="wd-20p">Category</th>
                                <th class="wd-20p">Payment Method</th>
                                <th class="wd-25p">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $serial = 1; @endphp
                            @foreach($users->where('user_type', 0)->where('account_status',3)->take(10) as $user)
                                <tr>
                                    <td>{{$serial++}}</td>
                                    <td>{{$user->first_name ?? '' }}</td>
                                    <td>{{$user->surname ?? '' }}</td>
                                    <td>{{$user->mobile_no ?? '' }}</td>
                                    <td>{{$user->email ?? '' }}</td>
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
                                    <td>{{ $user->payment_method == 1 ? 'Online Payment' : 'Offline Payment(Bank)' }}</td>
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

@endsection
