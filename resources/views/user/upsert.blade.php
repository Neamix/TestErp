@extends('layouts.master')
@section('css')

@section('title')
    @isset($user['id'])
    {{ __('system.edit_user') }}
    @else
    {{ __('system.create_user') }}
    @endisset
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    Upsert
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <h2 class="p-3">
        @isset($user['id'])
            {{ __('system.edit_user') }}
        @else
            {{ __('system.create_user') }}
        @endisset
    </h2>
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <form class="form" id="upsertUser">
                    <input type="hidden" value="@isset($user) {{ $user['id'] }} @endisset" id="user_id">
                    <div class="form-group">
                        <label for="user_name">
                            {{ __('system.user_name') }}
                        </label>
                        <input class="form-control" type="text" id="user_name" placeholder="Example: Abdalrhman Hussin" value="@isset($user) {{ $user['name'] }} @endisset"/>
                        <p class="error" id="user_name_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="user_email">
                            {{ __('system.user_email') }}
                        </label>
                        <input class="form-control" type="text" id="user_email" placeholder="Example: abdalrhmanhussin@gmail.com" value="@isset($user) {{ $user['email'] }} @endisset"/>
                        <p class="error" id="user_email_error"></p>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="datepicker">
                                    {{ __('system.user_join_date') }}
                                </label>
                                <input class="form-control" type="date" id="datepicker" placeholder="dd/mm/yy" value="@isset($user){{$user['join_date']}}@endisset"></p>
                                <p class="error" id="user_date_error"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="user_job">
                                    {{ __('system.user_job') }}
                                </label>
                                <select class="form-control" id="user_job">
                                    <option @isset($user) @if($user['type'] == 1) selected @endif @endisset value="1">{{ __('system.crew') }}</option>
                                    <option @isset($user) @if($user['type'] == 2) selected @endif @endisset value="2">{{ __('system.teacher') }}</option>
                                    <option @isset($user) @if($user['type'] == 3) selected @endif @endisset value="3">{{ __('system.student') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="btn d-flex align-items-center loader-key" load="upsert_user">
                        <div class="loader loader-small ml-2 mr-2 d-none" data-load="upsert_user"></div>
                        <p>
                            @isset($user['id'])
                                {{ __('system.update_user') }}
                            @else
                                {{ __('system.add_user') }}
                            @endisset
                        </p>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@include('js-blades.js-user-upsert')
@endsection