@extends('layouts.master')
@section('css')
<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
@section('title')
    @if(Auth::id() == $user->id)
        My Profile
    @else 
       {{ $user->name }}
    @endif
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30 mb-4">
        <div class="card card-statistics h-100 card-profile p-3">
            <div class="card-body">
                <div class="user">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="user-image">
                                <img src="/assets/images/users/{{ $user->avatar }}" class="@if(Auth::id() == $user->id) myAvatar @else avatar  @endif profileImage"/>
                                <div type="button"  data-toggle="modal" data-target="#avatarModal" class="img-modify-trigger d-flex justify-content-center align-items-center @if(Auth::id() != $user->id) d-none @endif">
                                    <i class="ti-camera fs-large text-white"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h2 class="fs-large">{{ $user->name }}</h2>
                            <p class="fs-small mb-3"> {{ $user->email }} </p>
                            <p class="tag">
                                @if($user->type == CREW) 
                                    {{__('system.crew')}}
                                @elseif($user->type == TEACHER) 
                                    {{__('system.teacher')}} 
                                @else 
                                    {{__('system.student')}} 
                                @endif 
                            </p>
                            @if(Auth::id() != $user->id && $user->allowedToActionOn())
                                <div class="action d-flex mt-4">
                                    @can('edit-user')
                                    <div class="fs-small cursor-pointer"><i class="ti-pencil mr-2"></i><a href="{{ route('user.edit',['user'=>$user->id]) }}">Edit</a></div>
                                    @endcan
                                    @can('trash-user')
                                    <div class="fs-small ml-2 cursor-pointer password_confirm_need" data-toggle="modal" data-target="#confirmPassword" data-url="{{ route('user.soft',['user' =>$user->id]) }}" redirect="{{ route('user.filter') }}"><i class="ti-trash mr-2"></i>Trash</div>
                                    @endcan
                                    @can('delete-user')
                                    <div class="fs-small ml-2 cursor-pointer password_confirm_need" data-toggle="modal" data-target="#confirmPassword" data-url="{{ route('user.destroy',['user'=>$user->id]) }}" redirect="{{ route('user.filter') }}"><i class="ti-na mr-2 ml-2"></i>Delete</div>
                                    @endcan
                                    @can('suspend-user')
                                    <div class="fs-small ml-2 cursor-pointer state-btn @if(!$user->active) d-none @endif"><i class="ti-control-pause mr-2 ml-2"></i>Suspend</div>
                                    @endcan
                                    @can('suspend-user')
                                    <div class="fs-small ml-2 cursor-pointer state-btn @if($user->active) d-none @endif"><i class="ti-control-play mr-2 ml-2"></i>Activate</div>
                                    @endcan
                                </div>
                            @endif
                            @isset($passwordError)
                                <p class="danger fs-sm">{{ $passwordError }}</p>
                            @endisset
                        </div>
                    </div>
                </div>
                @if(Auth::id() != $user->id && $user->allowedToActionOn() && Auth::user()->isAdmin() && $user->type == CREW) 

                <div class="privilleges mt-5 pt-4">
                    <h2 class="fs-medium mb-2">{{ $user->name }}'s Priviledges</h2>
                    <div class="row">
                        {{-- <div class="col-md-4">
                            <form class="privilledge-form">
                                <div class="form-group">
                                    <input class="privillege-input" type="checkbox" name="user" data_child="user" value="VIEW_USER_LIST">
                                    <label>View Users List</label>
                                    <div class="child-privillege ml-3">
                                        <div class="form-group mb-2">
                                            <input class="privillege-input" type="checkbox" data_parent="user" value="EDIT_USER">
                                            <label>Edit Users</label>
                                        </div>
                                        <div class="form-group mb-2">
                                            <input class="privillege-input" type="checkbox" data_parent="user">
                                            <label>Delete Users</label>
                                        </div>
                                        <div class="form-group mb-2">
                                            <input class="privillege-input" type="checkbox" data_parent="user">
                                            <label>Suspend Users</label>
                                        </div>
                                        <div class="form-group mb-2">
                                            <input class="privillege-input" type="checkbox" data_parent="user">
                                            <label>Trash Users</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> --}}
                        <div class="col-md-6">
                            <form class="privilledge-form">
                                <div class="form-group">
                                    <input class="privillege-input" type="checkbox" value="{{ VIEW_SUBJECT_LIST }}" data_child="subject" name="subject">
                                    <label>{{ __('system.view_subject_list') }}</label>
                                    <div class="child-privillege ml-3">
                                        <div class="form-group mb-2">
                                            <input class="privillege-input" type="checkbox" value="{{ EDIT_SUBJECT }}" parent_id="{{ VIEW_SUBJECT_LIST }}" data_parent="subject">
                                            <label>{{ __('system.edit_subject') }}</label>
                                        </div>
                                        <div class="form-group mb-2">
                                            <input class="privillege-input" type="checkbox" value="{{ DELETE_USER }}" parent_id="{{ VIEW_SUBJECT_LIST }}" data_parent="subject">
                                            <label>{{ __('system.delete_subject') }}</label>
                                        </div>
                                        <div class="form-group mb-2">
                                            <input class="privillege-input" type="checkbox" value="{{ TRASH_USER }}" parent_id="{{ VIEW_SUBJECT_LIST }}" data_parent="subject">
                                            <label>{{ __('system.trash_subject') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form class="privilledge-form">
                                <div class="form-group">
                                    <input class="privillege-input" type="checkbox" value="{{ VIEW_USER_LIST }}" data_child="user" name="user">
                                    <label>{{ __('system.view_user_list') }}</label>
                                    <div class="child-privillege ml-3">
                                        <div class="form-group mb-2">
                                            <input class="privillege-input" type="checkbox" value="{{ EDIT_USER }}" parent_id="{{ VIEW_USER_LIST }}" data_parent="user">
                                            <label>{{ __('system.edit_user') }}</label>
                                        </div>
                                        <div class="form-group mb-2">
                                            <input class="privillege-input" type="checkbox" value="{{ DELETE_USER }}" parent_id="{{ VIEW_USER_LIST }}" data_parent="user">
                                            <label>{{ __('system.delete_user') }}</label>
                                        </div>
                                        <div class="form-group mb-2">
                                            <input class="privillege-input" type="checkbox" value="{{ SUSPEND_USER }}" parent_id="{{ VIEW_USER_LIST }}" data_parent="user">
                                            <label>{{ __('system.suspend_user') }}</label>
                                        </div>
                                        <div class="form-group mb-2">
                                            <input class="privillege-input" type="checkbox" value="{{ TRASH_USER }}" parent_id="{{ VIEW_USER_LIST }}" data_parent="user">
                                            <label>{{ __('system.trash_user') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="button priviledge_save">Save</div>
                    </div>
                </div>
                @endif
                @if($user->type == TEACHER || $user->type == STUDENT) 
                <table id="datatable" class="table  datatable mt-4 table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                    <thead>
                    <tr class="alert-success">
                        <th>#</th>
                        <th>{{__('system.name')}}</th>
                        <th>{{__('system.day')}}</th>
                        <th>{{__('system.course_start_time')}}</th>
                        <th>{{__('system.course_end_time')}}</th>
                        <th>{{__('system.operation')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($user->teacher->courses as $course)
                            <tr>
                                <td>{{$course->id}}</td>
                                <td>{{$course->name}}</td>
                                <td>{{$course->day}}</td>
                                <td>{{$course->start_at}}</td>
                                <td>{{$course->end_at}}</td>           
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@include('js-blades.js-priviledges')
@include('js-blades.js-drag&drop')
@include('js-blades.js-user-action')
@endsection
