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
                                <h1>Login</h1>
                                <p class="account-subtitle">Access to our dashboard</p>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input class="form-control  @error('email') is-invalid @enderror" type="text"
                                            name="email" placeholder="Enter Email" value="{{ old('email') }}" required
                                            autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control  @error('password') is-invalid @enderror" type="password"
                                            name="password" placeholder="Enter Password" value="{{ old('password') }}"
                                            required autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-block btn-primary"
                                            style="border-radius: 10px; padding: 10px 0 10px 0"
                                            type="submit">Login</button>
                                    </div>
                                </form>
                                <div class="text-center font-weight-bold forgotpass">
                                    <a href="{{ route('forget-password') }}">Forgot Password?</a>
                                </div>
                                {{-- <div class="text-center dont-have">Don’t have an account?
                                    <a href="{{ route('register') }}">Register</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
