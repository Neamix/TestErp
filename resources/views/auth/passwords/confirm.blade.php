@extends('layouts.auth')
<!--=================================
login-->
    @section('content')
    <section class="height-100vh d-flex align-items-center page-section-ptb login"
        style="background-image: url('{{ asset('assets/images/sativa.png')}}');">
        <div class="container">
            <div class="row justify-content-center no-gutters vertical-align">
                <div class="col-lg-4 col-md-6 bg-white">
                    <div class="login-fancy pb-40 clearfix">
                        <div class="w-100 logo d-flex justify-content-center align-items-center mb-4">
                            <img src="{{ asset('/assets/images/logo-dark.png') }}" alt="logo" class="login-logo">
                        </div>
                        <form method="POST" action="{{route('password.confirm')}}">
                            @csrf

                            <div class="section-field mb-20">
                                <label class="mb-10" for="name">{{ __('system.password_confirm') }}</label>
                               <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <button class="button"><span>{{ __('system.password_confirm') }}</span><i class="fa fa-check"></i></button>
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


