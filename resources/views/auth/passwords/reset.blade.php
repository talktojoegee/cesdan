<!doctype html>
<html lang="en" dir="ltr">
<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="CISDAN portal">
    <meta name="author" content="CISDAN">
    <meta name="keywords" content="CISDAN">
    <link rel="shortcut icon" type="image/x-icon" href="http://akmaltechnology.com/template/yoha/assets/images/brand/favicon.ico" />
    <title>{{config('app.name')}} –  Reset Password </title>
    <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/css/style.css" rel="stylesheet"/>
    <link href="/assets/css/skin-modes.css" rel="stylesheet"/>
    <link href="/assets/css/dark-style.css" rel="stylesheet"/>
    <link href="/assets/plugins/single-page/css/main.css" rel="stylesheet" type="text/css">
    <link href="/assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet"/>
    <link href="/assets/css/icons.css" rel="stylesheet"/>
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="../assets/colors/color1.css" />

</head>

<body class="app sidebar-mini">

<!-- BACKGROUND-IMAGE -->
<div class="login-img">
    <!-- PAGE -->
    <div class="page">
        <div class="">
            <!-- CONTAINER OPEN -->
            <div class="col col-login mx-auto">
                <div class="text-center">
                    <a href="{{route('homepage')}}">
                        <img src="/assets/images/brand/cidsan-logo.png" class="header-brand-img" alt="logo">
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    @if(session()->has('error'))
                        <div class="alert alert-warning mb-4">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Whoops!</strong>
                            <hr class="message-inner-separator">
                            <p>{!! session()->get('error') !!}</p>
                        </div>
                    @endif
                    @if(session()->has('success'))
                        <div class="alert alert-success mb-4">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Great!</strong>
                            <hr class="message-inner-separator">
                            <p>{!! session()->get('success') !!}</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="container-login100">
                <div class="wrap-login100 p-6">
                    <form class="login100-form validate-form" action="{{ route('password.update') }}" method="post">
                        @csrf
                        <span class="login100-form-title">
                            Reset Password
                        </span>
                        @error('email') <div><i class="text-danger">{{$message}}</i></div>@enderror
                        <div class="wrap-input100 validate-input" data-validate = "Password is required">
                            <input class="input100"  type="password" name="password"  placeholder="Password">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><g fill="none"><path d="M0 0h24v24H0V0z"/><path d="M0 0h24v24H0V0z" opacity=".87"/></g><path d="M6 20h12V10H6v10zm6-7c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z" opacity=".3"/><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"/></svg>
                            </span>
                        </div>
                        @error('password') <div><i class="text-danger">{{$message}}</i></div>@enderror

                        <div class="wrap-input100 validate-input" data-validate = "Password is required">
                            <input class="input100"  type="password" name="password_confirmation"  placeholder="Re-type Password">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><g fill="none"><path d="M0 0h24v24H0V0z"/><path d="M0 0h24v24H0V0z" opacity=".87"/></g><path d="M6 20h12V10H6v10zm6-7c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z" opacity=".3"/><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"/></svg>
                            </span>
                        </div>
                        <div class="text-right pt-1">
                            <p class="mb-0"><a href="{{route('login')}}" class="text-primary ml-1">Login instead</a></p>
                        </div>
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="container-login100-form-btn">
                            <button type="submit" class="login100-form-btn btn-primary">
                                Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="/assets/js/jquery-3.4.1.min.js"></script>
<script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/custom.js"></script>

</body>
</html>
