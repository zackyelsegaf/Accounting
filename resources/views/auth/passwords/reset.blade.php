@extends('layouts.app')
@section('content')
    <div class="background-image">
        <div class="main-wrapper login-body">
            <div class="login-wrapper">
                <div class="container">
                    <div class="loginbox">
                        <div class="login-left">
                            <h3 style="color: #848484;"><small>Selamat Datang,</small></h3>
                            <div class="text-right">
                                <h4 style="color: #F76303;"><strong>Easy Accounting 7</strong></h4>
                                <h5 style="color: #F76303;"><em>WEB EDITION</em></h5>
                            </div>
                        </div>
                        <div class="login-right">
                            <div class="login-right-wrap">
                                <h1 class="mb-3">Reset Password</h1>
                                <form method="POST" action="/reset-password">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="form-group">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            placeholder="Enter Email" value="{{ old('email') }}" required
                                            autocomplete="email">
                                    </div>
                                    <div class="form-group">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            placeholder="Enter Password" required autocomplete="new-password">
                                    </div>
                                    <div class="form-group">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" placeholder="Confirm Password" required
                                            autocomplete="new-password">
                                    </div>
                                    <div class="form-group mb-0"> 
                                        <button class="btn btn-block btn-primary" style="border-radius: 10px; padding: 10px 0 10px 0" type="submit">Reset Password</button>
                                    </div>
                                </form>
                                {{-- <div class="login-or"> <span class="or-line"></span> <span class="span-or">or</span> </div>
                                <div class="social-login"> <span>Register with</span> <a href="#" class="facebook"><i
                                            class="fab fa-facebook-f"></i></a><a href="#" class="google"><i
                                            class="fab fa-google"></i></a> </div> --}}
                                <div class="text-center dont-have">Already have an account? <a
                                        href="{{ route('login') }}">Login</a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
