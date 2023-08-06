@extends('layouts.master-layout')
@section('active-page')
    Register Exams
@endsection
@section('title')
    Register Exams
@endsection
@section('extra-styles')

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
                    <form action="{{route('pay-for-exams')}}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="mb-0 card-title">Exam Registration</h3>
                                <p>Here's a preview of your chosen courses for this exam. You may choose to go back and make changes before making any financial commitment.</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Exam Type</label>
                                            <input type="text" readonly  value="{{ $exam->exam_name ?? '' }}" class="form-control">
                                            <input type="hidden"  name="examType" value="{{ $exam->id ?? '' }}" class="form-control">
                                            @error('examType') <i class="text-danger">{{$message}}</i>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="courseWrapper">
                                        @php $serial = 1; @endphp
                                        <div class="table-responsive">
                                            <table id="data-table1" class="table table-striped table-bordered text-nowrap w-100">
                                                <thead>
                                                <tr>
                                                    <th class="">#</th>
                                                    <th></th>
                                                    <th class="wd-15p">Course</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach($courses as $course)
                                                        <tr>
                                                            <td>{{ $serial++ }}</td>
                                                            <td><label class="colorinput">
                                                                    <input  name="course[]" checked readonly type="checkbox" value="{{ $course->id }}" class="colorinput-input" />
                                                                    <span class="colorinput-color bg-teal"></span>
                                                                </label>
                                                            </td>
                                                            <td>{{ $course->course ?? ''  }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <table class="table table-striped table-bordered text-nowrap w-100">
                                                <tr>
                                                    <td colspan="2" class="text-right">
                                                        <strong>Cost per paper:</strong>
                                                    </td>
                                                    <td>{{ number_format($exam->cost_per_paper ?? 0 ) }}</td>
                                                </tr>
                                                <tr class="">
                                                    <td colspan="2" class="text-right">
                                                        <strong>Number of Papers:</strong>
                                                    </td>
                                                    <td>{{ number_format(count($courses) ?? 0 ) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="text-right">
                                                        <strong>Amount:</strong>
                                                    </td>
                                                    <td>{{ number_format($total ?? 0 ) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="text-right">
                                                        <strong>Transaction Fee:</strong>
                                                    </td>
                                                    <td>{{ number_format($charge ?? 0 ) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="text-right">
                                                        <strong>Total:</strong>
                                                    </td>
                                                    <td>{{ number_format($charge + $total ?? 0 ) }}</td>
                                                    <input type="hidden" name="charge" value="{{$charge ?? 0 }}">
                                                    <input type="hidden" name="amount" value="{{$total ?? 0 }}">
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a href="{{ route('register-exams') }}" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-primary">Make Payment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('extra-scripts')

@endsection
