<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ get_setting('website_name') }} | ADMIN LOGIN</title>
    <link
      rel="icon"
      href="{{asset('img/'.get_setting('site_logo'))}}"
      type="image/x-icon"
    />

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset('assets/login-content/fonts/material-icon/css/material-design-iconic-font.min.css')}}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('assets/login-content/css/login-style.css')}}">
</head>
<body>

    <div class="main" style="background-image: url('{{ asset('img/'.get_setting('login_bg_image')) }}'); background-size: cover;">

        <!-- Sign up form -->
        <section class="signup" style="display: none;">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="{{asset('assets/login-content/images/signup-image.jpg')}}" alt="sing up image"></figure>
                        <a href="#" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <!-- <figure><img src="{{asset('assets/login-content/images/signin-image.jpg')}}" alt="sing up image"></figure> -->
                        <!-- <a href="#" class="signup-image-link">Create an account</a> -->
                        <figure><img src="{{ asset('img/'.get_setting('login_page_image')) }}" alt="sing up image"></figure>

                    </div>

                    <div class="signin-form">
                        <div class="login-img">
                            <img src="{{asset('img/'.get_setting('system_logo_white'))}}" alt="login-img" height="20"/>
                        </div>
                        <div class="login-content">
                            <h3 class="form-title">Welcome To {{ get_setting('website_name') }}</h3>
                            <small>Happy to see you again</small>
                        </div>
                        
                        <!-- <img src="{{asset('assets/login-content/images/signin-image.jpg')}}" alt="sing up image"> -->
                        <form method="POST" class="register-form" action="{{route('admin.authenticate')}}" id="login-form">
                            @csrf
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="zmdi zmdi-email"></i>
                                    <input type="text" name="email" value="{{ old('email') }}" 
                                           placeholder="Your Email"
                                           class="form-control @error('email') is-invalid @enderror">
                                </div>
                                @error('email')
                                    <small class="invalid-feedback d-block">{{ $message }}</small>
                                @enderror
                                @if(Session::has('success'))
                                    <small>{{Session::get('success')}}</small>
                                @endif

                                @if(Session::has('error'))
                                    <small>{{Session::get('error')}}</small>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="zmdi zmdi-lock"></i>
                                    <input type="password" name="password" 
                                           placeholder="Your Password"
                                           class="form-control @error('password') is-invalid @enderror">
                                </div>
                                @error('password')
                                    <small class="invalid-feedback d-block">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group" style="text-align: center;margin-bottom:0px">
                                <!-- <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" /> -->
                                <small class="label-agree-term"><span><span></span></span>-- Have a Good Day --</small>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                        {{--<div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>--}}
                    </div>
                </div>
            </div>
        </section>

    </div>

</body>
</html>