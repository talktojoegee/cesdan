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
    <title>{{config('app.name')}} – Register</title>
    <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/css/style.css" rel="stylesheet"/>
    <link href="/assets/css/skin-modes.css" rel="stylesheet"/>
    <link href="/assets/css/dark-style.css" rel="stylesheet"/>
    <link href="/assets/plugins/single-page/css/main.css" rel="stylesheet" type="text/css">
    <link href="/assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet"/>
    <link href="/assets/css/icons.css" rel="stylesheet"/>
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="/assets/colors/color1.css" />
</head>

<body class="app sidebar-mini">
<div class="login-img">
    <div class="page">
        <div class="">
            <div class="col col-login mx-auto">
                <div class="text-center">
                    @if(session()->has('success'))
                    <div class="alert alert-success mb-4">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Congratulations!</strong>
                        <hr class="message-inner-separator">
                        <p>{!! session()->get('success') !!}</p>
                    </div>
                    @endif
                    <a href="{{route('homepage')}}">
                        <img src="/assets/images/brand/cidsan-logo.png" class="header-brand-img" alt="logo">
                    </a>
                </div>
            </div>
            <div class="container-login100">
                <div class="row">
                    <div class="col-md-12">
                        <div class="wrap-login100 p-6">
                            <form class="login100-form validate-form" action="{{route('continue')}}" method="get" autocomplete="off">
                                @csrf
                                <span class="login100-form-title">
									Create An Account
								</span>
                                <p class="text-center">Take a minute or two to create an account. Ensure to <strong>COMPLETE </strong> your profile upon login.</p>
                                <div style="display: none;" class="wrap-input100 validate-input" data-validate = "Enter Registration Number">
                                    <input  readonly class="input100" type="text" name="registrationNo" value="{{ time() + rand(1000, 10000) }}" placeholder="Registration Number">
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                        <path d="M0 0h24v24H0V0z" fill="none"/><circle cx="12" cy="8" opacity=".3" r="2.1"/>
                                        <path d="M12 14.9c-2.97 0-6.1 1.46-6.1 2.1v1.1h12.2V17c0-.64-3.13-2.1-6.1-2.1z" opacity=".3"/>
                                        <path d="M12 13c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4zm6.1 5.1H5.9V17c0-.64 3.13-2.1 6.1-2.1s6.1 1.46 6.1 2.1v1.1zM12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0-6.1c1.16 0 2.1.94 2.1 2.1 0 1.16-.94 2.1-2.1 2.1S9.9 9.16 9.9 8c0-1.16.94-2.1 2.1-2.1z"/></svg>
                                    </span>
                                </div>
                                @error('registrationNo')<div><i class="text-danger">{{$message}}</i></div>@enderror
                                <div class="wrap-input100 validate-input" data-validate = "Enter surname">
                                    <input class="input100" type="text" name="surname" value="{{old('surname')}}" placeholder="Surname">
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><circle cx="12" cy="8" opacity=".3" r="2.1"/><path d="M12 14.9c-2.97 0-6.1 1.46-6.1 2.1v1.1h12.2V17c0-.64-3.13-2.1-6.1-2.1z" opacity=".3"/><path d="M12 13c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4zm6.1 5.1H5.9V17c0-.64 3.13-2.1 6.1-2.1s6.1 1.46 6.1 2.1v1.1zM12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0-6.1c1.16 0 2.1.94 2.1 2.1 0 1.16-.94 2.1-2.1 2.1S9.9 9.16 9.9 8c0-1.16.94-2.1 2.1-2.1z"/></svg>
                            </span>
                                </div>
                                @error('surname')<div><i class="text-danger">{{$message}}</i></div>@enderror
                                <div class="wrap-input100 validate-input" data-validate = "Enter mobile number">
                                    <input class="input100" type="number" name="mobileNo" value="{{old('mobileNo')}}" placeholder="Mobile number">
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none"/><circle cx="12" cy="8" opacity=".3" r="2.1"/>
                                    <path d="M12 14.9c-2.97 0-6.1 1.46-6.1 2.1v1.1h12.2V17c0-.64-3.13-2.1-6.1-2.1z" opacity=".3"/>
                                    <path d="M12 13c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4zm6.1 5.1H5.9V17c0-.64 3.13-2.1 6.1-2.1s6.1 1.46 6.1 2.1v1.1zM12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0-6.1c1.16 0 2.1.94 2.1 2.1 0 1.16-.94 2.1-2.1 2.1S9.9 9.16 9.9 8c0-1.16.94-2.1 2.1-2.1z"/>
                                </svg>
                            </span>
                                </div>
                                @error('mobileNo')<div><i class="text-danger">{{$message}}</i></div>@enderror
                                <div class="wrap-input100 validate-input" data-validate = "Enter a valid email address">
                                    <input class="input100" type="text" name="email" placeholder="Email Address" value="{{old('email')}}">
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/>
                                    <path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3"/>
                                    <path d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z"/>
                                </svg>
                            </span>
                                </div>
                                @error('email')<div><i class="text-danger">{{$message}}</i></div>@enderror
                                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                                    <input class="input100" type="password" name="password" placeholder="Choose Password">
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
										<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><g fill="none"><path d="M0 0h24v24H0V0z"/><path d="M0 0h24v24H0V0z" opacity=".87"/></g><path d="M6 20h12V10H6v10zm6-7c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z" opacity=".3"/><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"/></svg>
									</span>
                                </div>
                                @error('password')<div><i class="text-danger">{{$message}}</i></div>@enderror
                                <div class="wrap-input100 validate-input" data-validate = "Re-type password">
                                    <input class="input100" type="password" name="password_confirmation" placeholder="Re-type Password">
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><g fill="none"><path d="M0 0h24v24H0V0z"/><path d="M0 0h24v24H0V0z" opacity=".87"/></g><path d="M6 20h12V10H6v10zm6-7c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z" opacity=".3"/><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"/></svg>
                            </span>
                                </div>
                                <label style="display: none;" class="custom-control custom-checkbox mt-4">
                                    <input checked type="checkbox" class="custom-control-input" name="terms">
                                    <span class="custom-control-label">Agree the <a href="#">terms and policy</a></span>
                                </label>
                                @error('terms')<div><i class="text-danger">{{$message}}</i></div>@enderror
                                <div class="wrap-input100 validate-input" data-validate = "Re-type password">
                                    <label for="">Membership Category</label>
                                    <select name="membershipCategory" id="membershipCategory" class="form-control">
                                        <option disabled selected>-- Select category --</option>
                                        @foreach($category as $cat)
                                            <option value="{{$cat->id ?? 1 }}">{{$cat->name ?? '' }} - {{ env('APP_CURRENCY') }}{{number_format($cat->naira_amount,2)}}</option>
                                        @endforeach
                                    </select>
                                    @error('membershipCategory')<div><i class="text-danger">{{$message}}</i></div>@enderror
                                </div>
                                <div class="wrap-input100 validate-input" data-validate = "Re-type password">
                                    <label for="">Payment Method</label>
                                    <select name="payment_method" id="payment_method" class="form-control">
                                        <option disabled selected>-- Select payment method --</option>
                                        <option value="1">Online payment(Paystack)</option>
                                        <option value="2">Offline Payment(Bank)</option>
                                    </select>
                                    @error('payment_method')<div><i class="text-danger">{{$message}}</i></div>@enderror
                                </div>
                                <div class="wrap-input100 validate-input bg-light p-3" id="paymentMethod">
                                    <p> <strong class="text-danger">Note: </strong>Membership Registration Fees Payment should be made via direct transfer to the institutes account details as follows:</p>
                                    <p><strong>Bank Name:</strong> Zenith Bank</p>
                                    <p><strong>Account Name:</strong> Chartered Institute of Development Studies and Administration of Nigeria</p>
                                    <p><strong>Account Number:</strong> 1228772496</p>
                                    <p>Proof of Payment should be sent to <a href="mailto:info@cidsan.org">info@cidsan.org</a> for profile activation</p>
                                </div>

                                <div class="container-login100-form-btn">
                                    <button type="submit" id="handleSubmission" class="login100-form-btn btn-primary">
                                        Continue
                                    </button>
                                </div>
                                <div class="text-center pt-3">
                                    <p class="text-dark mb-0">Already have account?
                                        <a href="{{route('login')}}"  class="text-primary ml-1">Login</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/assets/js/jquery-3.4.1.min.js"></script>
<script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/plugins/bootstrap/js/popper.min.js"></script>
<script>
    $(document).ready(function(){
        $('#paymentMethod').hide();
        $('#payment_method').on('change', function(){
            let selection = $(this).val();
            if(parseInt(selection) === 2){
                $('#paymentMethod').show();
                $('#handleSubmission').text('Submit');
            }else{
                $('#paymentMethod').hide();
                $('#handleSubmission').text('Continue');
            }
        });
    });
</script>

</body>
</html>
