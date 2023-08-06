@extends('layouts.master-layout')
@section('active-page')
    Manage Courses
@endsection
@section('title')
    Manage Courses
@endsection
@section('extra-styles')

    <link href="/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
@endsection
@section('breadcrumb-action-btn')

    <a href="javascript:void(0);" data-toggle="modal" data-target="#addNewCourse" class="btn btn-primary btn-icon text-white">
        <span>
            <i class="fe fe-plus"></i>
        </span> Add New Course
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
                                <th class="wd-15p">Exam Type</th>
                                <th class="wd-15p">Course</th>
                                <th class="wd-25p">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $serial = 1; @endphp
                            @foreach($courses as $course)
                                <tr>
                                    <td>{{$serial++}}</td>
                                    <td>{{ $course->getExamType->exam_name ?? ''  }}</td>
                                    <td>{{ $course->course ?? ''  }}</td>
                                    <td>
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#course_{{$course->id}}"> <i class="fe fe-edit text-warning"></i> </a>
                                        <div class="modal" id="course_{{$course->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="card-body">
                                                            <form action="{{route('edit-exam-course')}}" method="post">
                                                                @csrf
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <h3 class="mb-0 card-title">Edit Exam Course</h3>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label class="form-label">Course Name</label>
                                                                                    <textarea name="courseName" style="resize: none"
                                                                                              class="form-control">{{old('courseName', $course->course) }}</textarea>
                                                                                    <input type="hidden" name="courseId" value="{{$course->id}}"
                                                                                           class="form-control">
                                                                                    @error('courseName') <i class="text-danger">{{$message}}</i>@enderror
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="form-label">Exam Type</label>
                                                                                    <select name="examType" id="examType" class="form-control">
                                                                                        <option disabled selected>--Select exam type --</option>
                                                                                        <option value="1">Foundation</option>
                                                                                        <option value="2">PE 1</option>
                                                                                        <option value="3">PE 2</option>
                                                                                    </select>
                                                                                    @error('examType') <i class="text-danger">{{$message}}</i>@enderror
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="card-footer text-right">
                                                                        <a href="{{url()->previous()}}" class="btn btn-danger">Cancel</a>
                                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
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

    <div class="modal" id="addNewCourse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card-body">
                        <form action="{{route('add-exam-course')}}" method="post">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="mb-0 card-title">Add New Exam Course</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Course Name</label>
                                                <textarea placeholder="Type course name here..." name="courseName" style="resize: none"
                                                          class="form-control">{{old('courseName') }}</textarea>
                                                @error('courseName') <i class="text-danger">{{$message}}</i>@enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Exam Type</label>
                                                <select name="examType" id="examType" class="form-control">
                                                    <option disabled selected>--Select exam type --</option>
                                                    <option value="1">Foundation</option>
                                                    <option value="2">PE 1</option>
                                                    <option value="3">PE 2</option>
                                                </select>
                                                @error('examType') <i class="text-danger">{{$message}}</i>@enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <a href="{{url()->previous()}}" class="btn btn-danger">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
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
