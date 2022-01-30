@extends('emails.email')

@section('content')
@if($data['title'] == 'Verify Account')
<h2>{{ __('email.welcome_to_ebtkar') }}</h2>
<p class="mt-1" >{{ __('email.you_have_been_added_to_Ibtkr_platform_as')}}{{__('system.'.$data['type'])}}</p>
<p class="mt-1 mb-5">{{__('email.to_verify_your_account_and_add_password_click_on_the_btn_below')}}</p>
@else
<h2>{{ __('email.welcome_name',['name'=>$data['name']]) }}</h2>
<p class="mt-1 mb-4" >{{ __('email.reset_password')}}</p>
@endif
<a href="{{ url()->current() }}/password/reset/{{ $data['token'] }}?email={{ $data['email'] }}" class="mt-4">
    <button class="button">{{__('email.click_here')}}</button>
</a>
@endsection