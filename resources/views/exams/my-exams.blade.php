@extends('layouts.master-layout')
@section('active-page')
    My Exams
@endsection
@section('title')
    My Exams
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
                                                        <p>List of courses registered.</p>
                                                        <div class="table-responsive">
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
