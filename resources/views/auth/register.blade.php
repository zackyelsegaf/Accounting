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
                                <h1 class="mb-3">Register</h1>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" placeholder="Enter Name" value="{{ old('name') }}" required
                                            autocomplete="name" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" placeholder="Enter Email" value="{{ old('email') }}" required
                                            autocomplete="off">
                                    </div>
                                    <div class="form-group" hidden>
                                        <input type="text" class="form-control @error('role_name') is-invalid @enderror"
                                            name="role_name" value="User Normal">
                                    </div>
                                    <div class="form-group" hidden>
                                        <input type="text"
                                            class="form-control @error('phone_number') is-invalid @enderror"
                                            name="phone_number" value="010">
                                    </div>
                                    <div class="form-group" hidden>
                                        <input type="text" class="form-control @error('position') is-invalid @enderror"
                                            name="position" value="Level One">
                                    </div>
                                    <div class="form-group" hidden>
                                        <input type="text" class="form-control @error('department') is-invalid @enderror"
                                            name="department" value="IT">
                                    </div>
                                    <div class="form-group" hidden>
                                        <input type="text" class="form-control @error('profile') is-invalid @enderror"
                                            name="profile">
                                    </div>
                                    <div class="form-group">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            placeholder="Enter Password" required autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password_confirmation"
                                            placeholder="Confirm Password" required autocomplete="off">
                                    </div>
                                    <div class="form-group mb-0">
                                        <button class="btn btn-block btn-primary"
                                            style="border-radius: 10px; padding: 10px 0 10px 0"
                                            type="submit">Register</button>
                                    </div>
                                </form>
                                <div class="text-center dont-have">Already have an account?
                                    <a href="{{ route('login') }}">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
