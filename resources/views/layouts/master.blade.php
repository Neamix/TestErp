<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    @include('layouts.head')
</head>

<body>
    
    {{-- Start Model --}}
    <div class="modal fade" id="avatarModal" tabindex="-1" role="dialog" aria-labelledby="avatarModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-wide" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="drag-zone active d-flex justify-content-center align-items-center flex-column">
                <h4 class="h4">{{__('system.drag&drop')}}</h4>
                <p>{{__('system.or')}}</p>
                <form class="">
                  <input type="file" placeholder="Browse Image" class="d-none" id="browseImage">
                  <button class="button browse" target="browseImage">{{ __('system.browse') }}</button>
                </form> 
                <p class="alert-danger mt-2" id="avatar_error"></p> 
            </div>
            <div class="image-preview d-none justify-content-center align-items-center w-100">
              <img src="" alt="profile">
            </div>
          </div>
          <div class="modal-footer d-none avatar-footer">
            <button type="button" class="button danger closeAvatarModel" data-dismiss="modal">{{ __('system.close') }}</button>
            <button type="button" class="button reset resetAvatar">{{__('system.reset')}}</button>
            <button type="button" class="button uploadAvatar">{{__('system.save_changes')}}</button>
          </div>
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="confirmPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body d-flex justify-content-center m-3 flex-column align-items-center">
            <img src="{{ asset('assets/images/alert.png') }}" alt="alert_icon" class="model-alert-image">
            <p class="mb-3 mt-3">{{__('system.please_confirm_your_password')}}</p>
            <form class="confirmPasswordForm w-100" action="" method="post" redirect="">
                @csrf
                <input class="form-control password-input w-100" placeholder="{{__('system.confirm_your_password')}}" name="password"/>
                <p class="fs-small text-danger mt-2 mb-2 confirm-error"></p>
                <button class="button mt-2 w-100">{{__('system.confirm')}}</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    {{-- End Models --}}
    <div class="wrapper">

        <!--=================================
 preloader -->

        <div id="pre-loader">
            <img src="/assets/images/pre-loader/loader-01.svg" alt="">
        </div>

        <!--=================================
 preloader -->

        @include('layouts.main-header')

        @include('layouts.main-sidebar')

        <!--=================================
 Main content -->
        <!-- main-content -->
        <div class="content-wrapper">

            @yield('page-header')

            @yield('content')

            <!--=================================
 wrapper -->

            <!--=================================
 footer -->

            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--=================================
 footer -->

    @include('layouts.footer-scripts')
</body>

</html>
