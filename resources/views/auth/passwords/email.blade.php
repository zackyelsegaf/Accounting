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
                                <h1>Forgot Password?</h1>
                                <p class="account-subtitle">Enter your email to get a password reset link</p>
                                <form method="POST" action="/forget-password">
                                    @csrf
                                    <div class="form-group">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" placeholder=" Enter Email" required
                                            autocomplete="email" autofocus>
                                    </div>
                                    <div class="form-group mb-0">
                                        <button class="btn btn-block btn-primary"
                                            style="border-radius: 10px; padding: 10px 0 10px 0" type="submit">Reset
                                            Password</button>
                                    </div>
                                </form>
                                <div class="text-center dont-have">Remember your password? <a
                                        href="{{ route('login') }}">Login</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
