@extends('layouts.master-layout')
@section('active-page')
    Payment Report
@endsection
@section('title')
    Payment Report
@endsection
@section('extra-styles')
    <link href="/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
@endsection
@section('breadcrumb-action-btn')
    @include('bills-n-payment.partials._bill-menu')
@endsection

@section('main-content')
    @if(session()->has('success'))
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-success mb-4">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Great!</strong>
                            <hr class="message-inner-separator">
                            <p>{!! session()->get('success') !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class="card bg-secondary img-card box-secondary-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{number_format($bills->sum('paid_amount'),2)}}</h2>
                            <p class="text-white mb-0">Bill</p>
                        </div>
                        <div class="ml-auto"> <i class="ti-wallet text-white fs-30 mr-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class="card  bg-success img-card box-success-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{number_format($payments->sum('amount'),2)}}</h2>
                            <p class="text-white mb-0">Payment</p>
                        </div>
                        <div class="ml-auto"> <i class="ti-wallet text-white fs-30 mr-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12 col-sm-12">
                        <h4>Filter</h4>
                        <form action="{{route('filter-payment-report', ['account'=>$account])}}" class="form-inline" method="get">
                            @csrf
                            <div class="form-group">
                                <label for="">From</label>
                                <input type="date" name="from" class="form-control ml-2" placeholder="From">
                            </div>
                            <div class="ml-2 form-group">
                                <label for="">To</label>
                                <input type="date" class="form-control ml-2" placeholder="To" name="to">
                            </div>
                            <div class="form-group">
                                <button class="btn-primary btn " type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 mt-4">
                        <h5 class="text-uppercase mt-4 "> <strong>Payment Report</strong> <small>(Outflow)</small>
                            <label for="" class=""> <span class="label label-primary">From: </span> {{date('d F, Y', strtotime($from))}}</label>
                            <label for="" class=""> <span class="label label-danger">To: </span> {{date('d F, Y', strtotime($to))}}</label>
                        </h5>
                    </div>

                    <div class="table-responsive">
                        <table id="data-table1" class="table table-striped table-bordered text-nowrap w-100">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Contact</th>
                                <th>Ref. No.</th>
                                <th>Amount</th>
                                <th>Bank</th>
                                <th>Payment Method</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $n = 1; @endphp
                            @foreach ($payments as $receipt)
                                <tr>
                                    <td>{{$n++}}</td>
                                    <td>{{date('d M, Y', strtotime($receipt->payment_date))}}</td>
                                    <td>{{$receipt->getVendor->company_name ?? ''}}</td>
                                    <td>{{$receipt->ref_no ?? ''}}</td>
                                    <td class="text-right">{{ number_format($receipt->amount,2) }}</td>
                                    <td>{{$receipt->getBank->bank ?? ''}} - {{$receipt->getBank->account_no ?? ''}}</td>
                                    <td>
                                        @if ($receipt->payment_type == 1)
                                            <label class="label label-primary">Cash</label>
                                        @elseif($receipt->payment_type == 2)
                                            <label class="label label-primary">Bank Transfer</label>
                                        @else
                                            <label class="label label-primary">Cheque</label>
                                        @endif
                                    </td>
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
