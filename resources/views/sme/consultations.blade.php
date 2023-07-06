@extends('layouts.master-layout')
@section('active-page')
    Consultations
@endsection
@section('title')
    Consultations
@endsection
@section('extra-styles')
    <link href="/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
@endsection
@section('breadcrumb-action-btn')
    <a href="{{url()->previous()}}" class="btn btn-secondary btn-icon text-white mr-2">
        <span>
            <i class="ti-back-left"></i>
        </span> Go Back
    </a>
    <a href="{{ route('show-consultation-form', ['account'=>$account]) }}" class="btn btn-primary btn-icon text-white mr-2">
        <span>
            <i class="ti-plus"></i>
        </span> New Request
    </a>
@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4>Consultations</h4>
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
                                <th class="wd-15p">Date</th>
                                <th class="wd-15p">Title</th>
                                <th class="wd-15p">Interest</th>
                                <th class="wd-15p">Status</th>
                                <th class="wd-15p">Responses</th>
                                <th class="wd-25p">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $serial = 1; @endphp
                            @foreach($consultations as $consult)
                                <tr>
                                    <td>{{$serial++}}</td>
                                    <td>{{ date('d M, Y', strtotime($consult->created_at)) }}</td>
                                    <td>{{$consult->subject ?? '' }}</td>
                                    <td>@foreach($consult->getConsultationInterests->take(3) as $interest) {!! $interest->getInterest->name.',' ?? ''  !!}  @endforeach</td>
                                    <td>
                                        @switch($consult->status)
                                            @case(0)
                                            <label for="" class="badge badge-warning">New</label>
                                            @break
                                            @case(1)
                                            <label for="" class="badge badge-primary">On-going</label>
                                            @break
                                            @case(2)
                                            <label for="" class="badge badge-success">Closed</label>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>
                                        {{$consult->getConsultationComments->count()}}
                                    </td>
                                    <td>
                                        <a href="{{route('view-consultation', ['slug'=>$consult->slug, 'account'=>$account])}}" class="btn btn-info btn-sm"><i class="ti-eye"></i></a>
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
