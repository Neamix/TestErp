@extends('layouts.master')
@section('css')
<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
@section('title')
    {{ $course->name }}
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
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100 card-profile p-3">
            <div class="card-body">
                <div class="subject">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="h2">{{ $course->name }}</h2>
                            <p class="h6"> {{ __("system.$course->day") }} . {{ $course->start_at }}</p>
                                <div class="action d-flex mt-4">
                                    @can('edit-course')
                                    <div class="fs-small cursor-pointer"><i class="ti-pencil mr-2"></i><a href="{{ route('course.edit',['course'=>$course->id]) }}">{{ __('system.edit') }}</a></div>
                                    @endcan
                                    @can('trash-course')
                                    <div class="fs-small ml-2 cursor-pointer password_confirm_need" data-toggle="modal" data-target="#confirmPassword" data-url="{{ route('course.soft',['course' =>$course->id]) }}" redirect="{{ route('course.list') }}"><i class="ti-trash mr-2"></i>{{__('system.trash')}}</div>
                                    @endcan
                                    @can('delete-course')
                                    <div class="fs-small ml-2 cursor-pointer password_confirm_need" data-toggle="modal" data-target="#confirmPassword" data-url="{{ route('course.destroy',['course'=>$course->id]) }}" redirect="{{ route('course.list') }}"><i class="ti-na mr-2 ml-2"></i>{{__('system.delete')}}</div>
                                    @endcan
                                </div>
                            <h4 class="fs-medium mb-3">{{__('system.teacher_assigned_to_course')}}</h4>
                            <table id="datatable" class="table datatable  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                                <thead>
                                <tr class="alert-success">
                                    <th>#</th>
                                    <th>{{__('system.name')}}</th>
                                    <th>{{__('system.email')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($course->teachers as $teacher)
                                        <tr>
                                            <td>{{$teacher->id}}</td>
                                            <td>{{$teacher->name}}</td>
                                            <td>{{$teacher->email}}</td>   
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h4 class="fs-medium mb-3">{{__('system.student_assigned_to_course')}}</h4>
                            <table id="" class="table datatable  table-hover table-sm table-bordered p-0 mt-4" data-page-length="50" style="text-align: center">
                                <thead>
                                <tr class="alert-success">
                                    <th>#</th>
                                    <th>{{__('system.name')}}</th>
                                    <th>{{__('system.email')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($course->students as $student)
                                        <tr>
                                            <td>{{$student->id}}</td>
                                            <td>{{$student->name}}</td>
                                            <td>{{$student->email}}</td>   
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@endsection
