<h2>{{ __('email.welcome_to_ebtkar') }}</h2>

<p>{{ __('email.you_have_sign_out_in_ebtkar_system') }} . {{ __('email.to_verify_your_account_please_click_on_link_below') }}</p>

<a href="{{ url()->current() }}/password/reset/{{ $data['token'] }}?email={{ $data['email'] }}">{{ url()->current() }}/password/reset/{{ $data['token'] }}?email={{ $data['email'] }}</a>