@extends('layouts.admin-layout')
@section('active-page')
    New Grant
@endsection
@section('title')
    New Grant
@endsection
@section('extra-styles')


@endsection
@section('breadcrumb-action-btn')
    <a href="{{route('show-trainings')}}" class="btn btn-primary btn-icon text-white mr-2">
        <span>
            <i class="ti-money"></i>
        </span> Manage Grants
    </a>

@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="">
                    @if(session()->has('success'))
                        <div class="alert alert-success mb-4">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Great!</strong>
                            <hr class="message-inner-separator">
                            <p>{!! session()->get('success') !!}</p>
                        </div>
                    @endif
                    <div class="card-body">
                        <form action="{{route('show-new-grant')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="mb-0 card-title">Add New Grant</h3>
                                </div>
                                <div class="card-alert alert alert-success mb-0">
                                    Details
                                </div>
                                <p class="mt-3 pl-3">Enter grant details below</p>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Title <span class="text-danger">*</span></label>
                                                <input type="text" placeholder="Title" value="{{old('title')}}" class="form-control" name="title">
                                                @error('title')
                                                <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="">Application Deadline <span class="text-danger">*</span></label>
                                                    <input type="date"  name="application_deadline" class="form-control">
                                                    @error('application_deadline')
                                                    <i class="text-danger">{{$message}}</i>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Sponsor <span class="text-danger">*</span></label>
                                                    <input type="text"  name="sponsor" class="form-control" placeholder="Sponsor Name">
                                                    @error('sponsor')
                                                    <i class="text-danger">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="">Grant Materials <small>(Optional)</small></label>
                                                    <input type="file" multiple name="attachments[]"  class="form-control-file">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Description <span class="text-danger">*</span></label>
                                                <textarea name="description" id="description" style="resize: none;" placeholder="Enter grant description here..."
                                                          class="form-control content">{{old('description')}}</textarea>
                                                @error('title')
                                                <i class="text-danger">{{$message}}</i>
                                                @enderror
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
    <script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="/assets/bower_components/tinymce.js"></script>
@endsection
