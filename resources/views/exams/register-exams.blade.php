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

                    @if ($errors->any())
                        <div class="alert alert-warning mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                        <form action="{{route('preview-registration')}}" method="post">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="mb-0 card-title">Exam Registration</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Exam Type</label>
                                                <select name="examType" id="examType" class="form-control">
                                                    <option disabled selected>-- Select exam --</option>
                                                    @foreach($exams as $exam)
                                                        <option value="{{ $exam->id }}">{{ $exam->exam_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('examType') <i class="text-danger">{{$message}}</i>@enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12" id="courseWrapper">

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


@endsection

@section('extra-scripts')
    <script src="/js/axios.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#examType').on('change', function (){
                const route = "{{ route('get-courses') }}";
                axios.post(route,{exam:$(this).val()})
                .then(res=>{
                    $('#courseWrapper').html(res.data);
                });
            });
        });
    </script>
@endsection
