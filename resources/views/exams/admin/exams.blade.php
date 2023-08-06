@extends('layouts.master-layout')
@section('active-page')
    Exam Registrations
@endsection
@section('title')
    Exam Registrations
@endsection
@section('extra-styles')

    <link href="/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
@endsection
@section('breadcrumb-action-btn')

    <a href="{{url()->previous()}}"  class="btn btn-primary btn-icon text-white">
        <span>
            <i class="fe fe-skip-back"></i>
        </span> Go Back
    </a>

@endsection

@section('main-content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if(session()->has('success'))
                        <div class="row">
                            <div class="col-md-12">
                                <p>{!! session()->get('success') !!}</p>
                            </div>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="data-table1" class="table table-striped table-bordered text-nowrap w-100">
                            <thead>
                            <tr>
                                <th class="">#</th>
                                <th class="wd-15p">Date</th>
                                <th class="wd-15p">Name</th>
                                <th class="wd-15p">Exam Type</th>
                                <th class="wd-25p">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $serial = 1; @endphp
                            @foreach($exams as $exam)
                                <tr>
                                    <td>{{ $serial++ }}</td>
                                    <td>{{ date('d M, Y', strtotime($exam->created_at)) }}</td>
                                    <td>{{ $exam->getUser->first_name ?? ''  }} {{ $exam->getUser->surname ?? ''  }}</td>
                                    <td>{{ $exam->getExamType->exam_name ?? '' }}</td>
                                    <td>
                                        <i data-toggle="modal" data-target="#itemModal_{{$exam->id}}" class="fe fe-eye text-warning" style=" cursor: pointer;"></i>
                                        <div class="modal" id="itemModal_{{$exam->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header ">
                                                        <h5 class="modal-title" id="exampleModalLabel">Exam Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true" class="text-white">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Exam Details</strong></p>
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered text-nowrap">
                                                                <tr>
                                                                    <td colspan="2" class="text-left">
                                                                        <strong>Exam:</strong>
                                                                    </td>
                                                                    <td>{{ $exam->getExamType->exam_name ?? '' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" class="text-left">
                                                                        <strong>Cost per paper:</strong>
                                                                    </td>
                                                                    <td>{{ number_format($exam->getExamType->cost_per_paper ?? 0 ) }}</td>
                                                                </tr>
                                                                <tr class="">
                                                                    <td colspan="2" class="text-left">
                                                                        <strong>Number of Papers:</strong>
                                                                    </td>
                                                                    <td>{{ number_format(count($exam->getExamCourses) ?? 0 ) }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" class="text-left">
                                                                        <strong>Amount:</strong>
                                                                    </td>
                                                                    <td>{{ number_format(($exam->total_amount - $exam->charge)  ?? 0 ) }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" class="text-left">
                                                                        <strong>Transaction Fee:</strong>
                                                                    </td>
                                                                    <td>{{ number_format($exam->charge ?? 0 ) }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" class="text-left">
                                                                        <strong>Total:</strong>
                                                                    </td>
                                                                    <td>{{ number_format( $exam->total_amount ?? 0 ) }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" class="text-left">
                                                                        <strong>Status:</strong>
                                                                    </td>
                                                                    <td>
                                                                        @if($exam->status == 0)
                                                                            <span class="badge rounded-pill bg-info text-white me-1 mb-1 mt-1">New</span>
                                                                        @elseif($exam->status == 1)
                                                                            <span class="badge rounded-pill bg-success text-white me-1 mb-1 mt-1">Verified</span>
                                                                        @elseif($exam->status == 2)
                                                                            <span class="badge rounded-pill text-white bg-danger me-1 mb-1 mt-1">Discarded</span>
                                                                        @endif

                                                                        @if($exam->status == 0)
                                                                                <p style="cursor: pointer;">
                                                                                    <span data-toggle="modal" data-target="#verifyPayment_{{$exam->id}}"><i class="fe fe-check-circle text-success" ></i> Verify Payment  &nbsp; &nbsp; &nbsp;</span> |
                                                                                    <span data-toggle="modal" data-target="#discardPayment_{{$exam->id}}">&nbsp; &nbsp; &nbsp;
                                                                            <i class="fe fe-x-circle text-danger" ></i> Discard Payment</span>
                                                                                </p>
                                                                                <div class="modal" id="verifyPayment_{{$exam->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                                                    <div class="modal-dialog" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title" id="exampleModalLongTitle">Are you sure?</h5>
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                    <span aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <div class="card-body">
                                                                                                    <form action="{{route('update-exam-status')}}" method="post">
                                                                                                        @csrf
                                                                                                        <p class="text-wrap"> This action cannot be undone. Are you sure you want to <b class="text-info">verify</b> this exam registration payment?</p>
                                                                                                        <div class="card-footer text-right">
                                                                                                            <input
                                                                                                                type="hidden" name="examId" value="{{$exam->id}}">
                                                                                                            <input
                                                                                                                type="hidden" name="type" value="1">
                                                                                                            <a href="#" data-dismiss="modal"  class="btn btn-danger">Cancel</a>
                                                                                                            <button type="submit" class="btn btn-primary">Yes</button>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal" id="discardPayment_{{$exam->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                                                    <div class="modal-dialog" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title" id="exampleModalLongTitle">Are you sure?</h5>
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                    <span aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <div class="card-body">
                                                                                                    <form action="{{route('update-exam-status')}}" method="post">
                                                                                                        @csrf
                                                                                                        <p class="text-wrap"> This action cannot be undone. Are you sure you want to <b class="text-danger">discard</b> this exam registration payment?</p>
                                                                                                        <div class="card-footer text-right">
                                                                                                            <input
                                                                                                                type="hidden" name="examId" value="{{$exam->id}}">
                                                                                                            <input
                                                                                                                type="hidden" name="type" value="2">
                                                                                                            <a href="#" data-dismiss="modal"  class="btn btn-danger">Cancel</a>
                                                                                                            <button type="submit" class="btn btn-primary">Yes</button>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        @endif


                                                                    </td>

                                                                </tr>
                                                            </table>
                                                            <p>List of registered courses</p>
                                                            <table id="data-table1" class="table table-striped table-bordered text-nowrap w-100">
                                                                <thead>
                                                                <tr>
                                                                    <th class="">#</th>
                                                                    <th class="wd-15p">Course</th>
                                                                </tr>
                                                                </thead>
                                                                <?php $index = 1; ?>
                                                                <tbody>
                                                                @foreach($exam->getExamCourses as $course)
                                                                    <tr>
                                                                        <td>{{ $index++ }}</td>
                                                                        <td>
                                                                            {{ $course->getCourse->course ?? ''  }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
