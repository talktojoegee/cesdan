@extends('layouts.master-layout')
@section('active-page')
    Training Details
@endsection
@section('title')
    Training Details
@endsection
@section('extra-styles')

    <link href="/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
@endsection

@section('breadcrumb-action-btn')
    <div class="btn-group">
        <a href="{{url()->previous()}}" class="btn btn-secondary btn-icon text-white mr-2">
        <span>
            <i class="ti-back-left"></i>
        </span> Go Back
        </a>
    </div>
@endsection

@section('main-content')
    <div class="row">
        <div class="col-lg-8">
            @if(session()->has('success'))
                <div class="alert alert-success mb-4">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>Great!</strong>
                    <hr class="message-inner-separator">
                    <p>{!! session()->get('success') !!}</p>
                </div>
            @endif
            <div class="card">
                <div class="wideget-user-tab">
                    <div class="tab-menu-heading">
                        <div class="tabs-menu1">
                            <ul class="nav">
                                <li class=""><a href="#tab-51" class="active show" data-toggle="tab">Training Details</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content">
                <div class="tab-pane active show" id="tab-51">
                    <div class="card">
                        <div class="card-body">
                            <div class="mg-t-15 profile-footer">

                                <button class="btn btn-sm btn-default me-2 mb-1"><i class="fe fe-calendar mr-3"></i>{{date('d M, Y', strtotime($training->created_at))}}</button>
                                <button class="btn btn-sm btn-default me-2 mb-1"><i class="fe fe-user mr-3"></i> {{$training->getTrainingAuthor->full_name ?? '' }}</button>
                            </div>
                            <div id="profile-log-switch">
                                <h3 class="card-title">{{$training->title ?? '' }}</h3>
                                {!! $training->description ?? '' !!}
                                <div>
                                    @foreach($training->getTrainingCategories as $bCat)
                                        <span class="badge rounded-pill bg-success text-white mt-2">{{$bCat->getBusinessCategory->category_name ?? '' }}</span>

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Conversations</div>
                        </div>
                        <div class="card-body pb-0">
                            @if(count($training->getTrainingComments) > 0)
                                @foreach($training->getTrainingComments as $comment)
                                    <div class="media mb-5 overflow-visible d-block d-sm-flex">
                                        <div class="media-body overflow-visible">
                                            <div class="border mb-5 p-4 br-5">
                                                <h5 class="mt-0">{{$comment->user_level == 1 ? $comment->getCommentedByAdmin->full_name : $comment->getCommentedByUser->first_name }}
                                                    <sup>
                                                        <label for="" class="badge rounded-pill bg-success-gradient text-white">{{$comment->user_level == 1 ? 'Admin' : 'Business' }}
                                                        </label>
                                                    </sup>
                                                </h5>
                                                {!! $comment->comment ?? '' !!}
                                                @foreach($comment->getTrainingFeedbackReply as $reply)
                                                    <div class="media mb-5 overflow-visible d-block d-sm-flex ml-5">
                                                        <div class="media-body border p-4 overflow-visible br-5">
                                                            <h5 class="mt-0">{{$reply->user_level == 1 ? $reply->getCommentedByAdmin->full_name : $reply->getCommentedByUser->first_name }}
                                                                <sup>
                                                                    <label for="" class="badge rounded-pill bg-success-gradient text-white">{{$reply->user_level == 1 ? 'Admin' : 'Business' }}
                                                                    </label>
                                                                </sup>
                                                            </h5>
                                                            {!! $reply->feedback_reply ?? '' !!}
                                                            <div>
                                                                <a class="like" href="javascript:;">
                                                    <span class="btn btn-sm btn-danger-light">
                                                        <i class="fe fe-calendar mr-3"></i>{{date('d M, Y h:ia', strtotime($reply->created_at))}}
                                                    </span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="card-body">
                                                    <form action="{{route('business-reply-comment-training',['account'=>$account])}}" method="post">
                                                        @csrf
                                                        <div class="form-group">
                                                            <input type="hidden" name="innerTrainingId" value="{{$training->id}}">
                                                            <input type="hidden" name="innerCommentId" value="{{$comment->id}}">
                                                            <input type="hidden" name="userLevel" value="2">
                                                            <textarea placeholder="Type reply here..." name="innerConversation" style="resize: none;"
                                                                      class="form-control">{{old('innerConversation')}}</textarea>
                                                        </div>
                                                        <div class="form-group d-flex justify-content-end">
                                                            <button type="submit" class="btn btn-primary">Reply</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h5 class="text-center p-4">Be the first to start a conversation!</h5>
                            @endif

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Leave a Comment</div>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal  m-t-20" method="post" action="{{route('business-comment-training',[ 'account'=>$account])}}" autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <input class="form-control" type="text" readonly value="{{Auth::user()->first_name ?? '' }} {{Auth::user()->surname ?? '' }}" placeholder="Username" data-slug-id="username" data-category="user-data">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="userLevel" value="2">
                                    <input type="hidden" name="commentTrainingId" value="{{$training->id}}">
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <textarea class="form-control content" name="comment" placeholder="Leave a comment here..." data-slug-id="your-comment" data-category="user-data">{{old('comment')}}</textarea>
                                        @error('comment')
                                            <i class="text-danger">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-primary btn-rounded  waves-effect waves-light">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="wideget-user">
                        <div class="card">
                            <div class="card-header bg-primary br-tr-3 br-tl-3">
                                <h3 class="card-title text-white">Training Materials</h3>
                                <div class="card-options ">
                                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up text-white"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($training->getTrainingMaterials  as $file)
                                        @switch(pathinfo($file->attachment, PATHINFO_EXTENSION))
                                            @case('pptx')
                                            <div class="col-md-6">
                                                <a href="button" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'Training Material'}}" data-original-title="{{$file->name ?? 'Training Material'}}" style="cursor: pointer;">
                                                    <img src="/assets/formats/ppt.png" height="64" width="64" alt="{{$file->name ?? 'Training Material'}}"><br>
                                                    {{strlen($file->name ?? 'Training Material') > 10 ? substr($file->name ?? 'Training Material',0,7).'...' : $file->name ?? 'Training Material'}}
                                                </a>
                                            </div>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect" href="{{route('download-training-material',['attachment'=>$file->attachment, 'account'=>$account])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                </div>
                                            </div>

                                            @break
                                            @case('pdf')
                                            <div class="col-md-6 mb-4">
                                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'Training Material'}}" data-original-title="{{$file->name ?? 'Training Material'}}" style="cursor: pointer;">
                                                    <img src="/assets/formats/pdf.png" height="64" width="64" alt="{{$file->name ?? 'Training Material'}}"> <br>
                                                    {{strlen($file->name ?? 'Training Material') > 10 ? substr($file->name ?? 'Training Material',0,7).'...' : $file->name ?? 'Training Material'}}
                                                </a>
                                                <div class="dropdown-secondary dropdown float-right">
                                                    <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item waves-light waves-effect" href="{{route('download-training-material',['attachment'=>$file->attachment, 'account'=>$account])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @break

                                            @case('csv')
                                            <div class="col-md-6">
                                                <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'Training Material'}}" data-original-title="{{$file->name ?? 'Training Material'}}">
                                                    <img src="/assets/formats/csv.png" height="64" width="64" alt="{{$file->name ?? 'Training Material'}}"><br>
                                                    {{strlen($file->name ?? 'Training Material') > 10 ? substr($file->name ?? 'Training Material',0,7).'...' : $file->name ?? 'Training Material'}}
                                                </a>
                                                <div class="dropdown-secondary dropdown float-right">
                                                    <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item waves-light waves-effect" href="{{route('download-training-material',['attachment'=>$file->attachment, 'account'=>$account])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item waves-light waves-effect deleteFile"  data-toggle="modal" data-target="#deleteModal" data-directory="{{$file->attachment}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @break
                                            @case('xls')
                                            <div class="col-md-6">
                                                <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'Training Material'}}" data-original-title="{{$file->name ?? 'Training Material'}}">
                                                    <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$file->name ?? 'Training Material'}}"><br>
                                                    {{strlen($file->name ?? 'Training Material') > 10 ? substr($file->name ?? 'Training Material',0,7).'...' : $file->name ?? 'Training Material'}}
                                                </a>
                                                <div class="dropdown-secondary dropdown float-right">
                                                    <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item waves-light waves-effect" href="{{route('download-training-material',['attachment'=>$file->attachment, 'account'=>$account])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item waves-light waves-effect deleteFile"  data-toggle="modal" data-target="#deleteModal" data-directory="{{$file->attachment}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @break
                                            @case('xlsx')
                                            <div class="col-md-6">
                                                <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'Training Material'}}" data-original-title="{{$file->name ?? 'Training Material'}}">
                                                    <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$file->name ?? 'Training Material'}}"><br>
                                                    {{strlen($file->name ?? 'Training Material') > 10 ? substr($file->name ?? 'Training Material',0,7).'...' : $file->name ?? 'Training Material'}}
                                                </a>
                                                <div class="dropdown-secondary dropdown float-right">
                                                    <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item waves-light waves-effect" href="{{route('download-training-material',['attachment'=>$file->attachment, 'account'=>$account])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item waves-light waves-effect deleteFile"  data-toggle="modal" data-target="#deleteModal" data-directory="{{$file->attachment}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @break
                                            @case('doc')
                                            <div class="col-md-12">
                                                <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'Training Material'}}" data-original-title="{{$file->name ?? 'Training Material'}}">
                                                    <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$file->name ?? 'Training Material'}}"><br>
                                                    {{strlen($file->name ?? 'Training Material') > 10 ? substr($file->name ?? 'Training Material',0,7).'...' : $file->name ?? 'Training Material'}}
                                                </a>
                                                <div class="dropdown-secondary dropdown float-right">
                                                    <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item waves-light waves-effect" href="{{route('download-training-material',['attachment'=>$file->attachment, 'account'=>$account])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @break
                                            @case('docx')
                                            <div class="col-md-6">
                                                <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'Training Material'}}" data-original-title="{{$file->name ?? 'Training Material'}}">
                                                    <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$file->name ?? 'Training Material'}}"><br>
                                                    {{strlen($file->name ?? 'Training Material') > 10 ? substr($file->name ?? 'Training Material',0,7).'...' : $file->name ?? 'Training Material'}}
                                                </a>
                                                <div class="dropdown-secondary dropdown float-right">
                                                    <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item waves-light waves-effect" href="{{route('download-training-material',['attachment'=>$file->attachment, 'account'=>$account])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @break
                                            @case('jpeg')
                                            <div class="col-md-6">
                                                <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'Training Material'}}" data-original-title="{{$file->name ?? 'Training Material'}}">
                                                    <img src="/assets/formats/jpg.png" height="64" width="64" alt="{{$file->name ?? 'Training Material'}}"><br>
                                                    {{strlen($file->name ?? 'Training Material') > 10 ? substr($file->name ?? 'Training Material',0,7).'...' : $file->name ?? 'Training Material'}}
                                                </a>
                                                <div class="dropdown-secondary dropdown float-right">
                                                    <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item waves-light waves-effect" href="{{route('download-training-material',['attachment'=>$file->attachment, 'account'=>$account])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item waves-light waves-effect deleteFile"  data-toggle="modal" data-target="#deleteModal" data-directory="{{$file->attachment}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @break
                                            @case('jpg')
                                            <div class="col-md-6">
                                                <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'Training Material'}}" data-original-title="{{$file->name ?? 'Training Material'}}">
                                                    <img src="/assets/formats/jpg.png" height="64" width="64" alt="{{$file->name ?? 'Training Material'}}"><br>
                                                    {{strlen($file->name ?? 'Training Material') > 10 ? substr($file->name ?? 'Training Material',0,7).'...' : $file->name ?? 'Training Material'}}
                                                </a>
                                                <div class="dropdown-secondary dropdown float-right">
                                                    <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item waves-light waves-effect" href="{{route('download-training-material',['attachment'=>$file->attachment, 'account'=>$account])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item waves-light waves-effect deleteFile"  data-toggle="modal" data-target="#deleteModal" data-directory="{{$file->attachment}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @break
                                            @case('png')
                                            <div class="col-md-6">
                                                <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'Training Material'}}" data-original-title="{{$file->name ?? 'Training Material'}}">
                                                    <img src="/assets/formats/png.png" height="64" width="64" alt="{{$file->name ?? 'Training Material'}}"><br>
                                                    {{strlen($file->name ?? 'Training Material') > 10 ? substr($file->name ?? 'Training Material',0,7).'...' : $file->name ?? 'Training Material'}}
                                                </a>
                                                <div class="dropdown-secondary dropdown float-right">
                                                    <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item waves-light waves-effect" href="{{route('download-training-material',['attachment'=>$file->attachment, 'account'=>$account])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item waves-light waves-effect deleteFile"  data-toggle="modal" data-target="#deleteModal" data-directory="{{$file->attachment}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @break
                                            @case('gif')
                                            <div class="col-md-6">
                                                <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'Training Material'}}" data-original-title="{{$file->name ?? 'Training Material'}}">
                                                    <img src="/assets/formats/gif.png" height="64" width="64" alt="{{$file->name ?? 'Training Material'}}"><br>
                                                    {{strlen($file->name ?? 'Training Material') > 10 ? substr($file->name ?? 'Training Material',0,7).'...' : $file->name ?? 'Training Material'}}
                                                </a>
                                                <div class="dropdown-secondary dropdown float-right">
                                                    <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item waves-light waves-effect" href="{{route('download-training-material',['attachment'=>$file->attachment, 'account'=>$account])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item waves-light waves-effect deleteFile"  data-toggle="modal" data-target="#deleteModal" data-directory="{{$file->attachment}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @break
                                            @case('ppt')
                                            <div class="col-md-6">
                                                <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'Training Material'}}" data-original-title="{{$file->name ?? 'Training Material'}}">
                                                    <img src="/assets/formats/ppt.png" height="64" width="64" alt="{{$file->name ?? 'Training Material'}}"><br>
                                                    {{strlen($file->name ?? 'Training Material') > 10 ? substr($file->name ?? 'Training Material',0,7).'...' : $file->name ?? 'Training Material'}}
                                                </a>
                                                <div class="dropdown-secondary dropdown float-right">
                                                    <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item waves-light waves-effect" href="{{route('download-training-material',['attachment'=>$file->attachment, 'account'=>$account])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item waves-light waves-effect deleteFile"  data-toggle="modal" data-target="#deleteModal" data-directory="{{$file->attachment}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @break
                                            @case('txt')
                                            <div class="col-md-6">
                                                <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'Training Material'}}" data-original-title="{{$file->name ?? 'Training Material'}}">
                                                    <img src="/assets/formats/txt.png" height="64" width="64" alt="{{$file->name ?? 'Training Material'}}"><br>
                                                    {{strlen($file->name ?? 'Training Material') > 10 ? substr($file->name ?? 'Training Material',0,7).'...' : $file->name ?? 'Training Material'}}
                                                </a>
                                                <div class="dropdown-secondary dropdown float-right">
                                                    <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item waves-light waves-effect" href="{{route('download-training-material',['attachment'=>$file->attachment, 'account'=>$account])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item waves-light waves-effect deleteFile"  data-toggle="modal" data-target="#deleteModal" data-directory="{{$file->attachment}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @break
                                            @case('css')
                                            <div class="col-md-6">
                                                <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'Training Material'}}" data-original-title="{{$file->name ?? 'Training Material'}}">
                                                    <img src="/assets/formats/css.png" height="64" width="64" alt="{{$file->name ?? 'Training Material'}}"> <br>
                                                    {{strlen($file->name ?? 'Training Material') > 10 ? substr($file->name ?? 'Training Material',0,7).'...' : $file->name ?? 'Training Material'}}
                                                </a>
                                                <div class="dropdown-secondary dropdown float-right">
                                                    <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item waves-light waves-effect" href="{{route('download-training-material',['attachment'=>$file->attachment, 'account'=>$account])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item waves-light waves-effect deleteFile"  data-toggle="modal" data-target="#deleteModal" data-directory="{{$file->attachment}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @break
                                            @case('mp3')
                                            <div class="col-md-6">
                                                <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'Training Material'}}" data-original-title="{{$file->name ?? 'Training Material'}}">
                                                    <img src="/assets/formats/mp3.png" height="64" width="64" alt=""><br>
                                                    {{strlen($file->name ?? 'Training Material') > 10 ? substr($file->name ?? 'Training Material',0,7).'...' : $file->name ?? 'Training Material'}}
                                                </a>
                                                <div class="dropdown-secondary dropdown float-right">
                                                    <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item waves-light waves-effect" href="{{route('download-training-material',['attachment'=>$file->attachment, 'account'=>$account])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item waves-light waves-effect deleteFile"  data-toggle="modal" data-target="#deleteModal" data-directory="{{$file->attachment}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @break
                                            @case('mp4')
                                            <div class="col-md-6">
                                                <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'Training Material'}}" data-original-title="{{$file->name ?? 'Training Material'}}">
                                                    <img src="/assets/formats/mp4.png" height="64" width="64" alt="{{$file->name ?? 'Training Material'}}"><br>
                                                    {{strlen($file->name ?? 'Training Material') > 10 ? substr($file->name ?? 'Training Material',0,7).'...' : $file->name ?? 'Training Material'}}
                                                </a>
                                                <div class="dropdown-secondary dropdown float-right">
                                                    <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item waves-light waves-effect" href="{{route('download-training-material',['attachment'=>$file->attachment, 'account'=>$account])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item waves-light waves-effect deleteFile"  data-toggle="modal" data-target="#deleteModal" data-directory="{{$file->attachment}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @break
                                            @case('svg')
                                            <div class="col-md-6">
                                                <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'Training Material'}}" data-original-title="{{$file->name ?? 'Training Material'}}">
                                                    <img src="/assets/formats/svg.png" height="64" width="64" alt="{{$file->name ?? 'Training Material'}}"><br>
                                                    {{strlen($file->name ?? 'Training Material') > 10 ? substr($file->name ?? 'Training Material',0,7).'...' : $file->name ?? 'Training Material'}}
                                                </a>
                                                <div class="dropdown-secondary dropdown float-right">
                                                    <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item waves-light waves-effect" href="{{route('download-training-material',['attachment'=>$file->attachment, 'account'=>$account])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item waves-light waves-effect deleteFile"  data-toggle="modal" data-target="#deleteModal" data-directory="{{$file->attachment}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @break
                                            @case('xml')
                                            <div class="col-md-6">
                                                <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'Training Material'}}" data-original-title="{{$file->name ?? 'Training Material'}}">
                                                    <img src="/assets/formats/xml.png" height="64" width="64" alt="{{$file->name ?? 'Training Material'}}"><br>
                                                    {{strlen($file->name ?? 'Training Material') > 10 ? substr($file->name ?? 'Training Material',0,7).'...' : $file->name ?? 'Training Material'}}
                                                </a>
                                                <div class="dropdown-secondary dropdown float-right">
                                                    <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item waves-light waves-effect" href="{{route('download-training-material',['attachment'=>$file->attachment, 'account'=>$account])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item waves-light waves-effect deleteFile"  data-toggle="modal" data-target="#deleteModal" data-directory="{{$file->attachment}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @break
                                            @case('zip')
                                            <div class="col-md-6">
                                                <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'Training Material'}}" data-original-title="{{$file->name ?? 'Training Material'}}">
                                                    <img src="/assets/formats/zip.png" height="64" width="64" alt="{{$file->name ?? 'Training Material'}}"><br>
                                                    {{strlen($file->name ?? 'Training Material') > 10 ? substr($file->name ?? 'Training Material',0,7).'...' : $file->name ?? 'Training Material'}}
                                                </a>
                                                <div class="dropdown-secondary dropdown float-right">
                                                    <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item waves-light waves-effect" href="{{route('download-training-material',['attachment'=>$file->attachment, 'account'=>$account])}}"><i class="ti-download text-success mr-2"></i> Download</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item waves-light waves-effect deleteFile"  data-toggle="modal" data-target="#deleteModal" data-directory="{{$file->attachment}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @break
                                        @endswitch
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-header bg-primary br-tr-3 br-tl-3 mt-3">
                                <h3 class="card-title text-white">Project/Assessment</h3>
                                <div class="card-options ">
                                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up text-white"></i></a>
                                </div>
                            </div>
                        </div>
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
