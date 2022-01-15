@extends('layouts.auth')
<!--=================================
login-->
@section('title')
    Forget Password
@endsection
    @section('content')
    <section class="height-100vh d-flex align-items-center page-section-ptb login"
        style="background-image: url('{{ asset('assets/images/sativa.png')}}');">
        <div class="container">
            <div class="row justify-content-center no-gutters vertical-align">
                <div class="col-lg-4 col-md-6 bg-white">
                    <div class="login-fancy pb-40 clearfix">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="section-field mb-20">
                                <label class="mb-10" for="name">Email Address</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="section-field mb-20">
                                <label class="mb-10" for="Password">Password </label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <div class="section-field mb-20">
                                <label class="mb-10" for="Password">Password Confirmation</label>
                                <input id="password-confirm" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password_confirmation"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <button class="button"><span>Send Reset Key</span><i class="fa fa-check"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection

    <!--=================================
login-->

</div>