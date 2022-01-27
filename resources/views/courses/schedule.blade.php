@extends('layouts.master')
@section('css')

@section('title')
    {{__('system.schedule')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-2"> {{__('system.schedule')}}</h4>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @foreach($courses as $key => $courseGroup)
                <h6 class="mb-3">{{__("system.$key")}}</h6>
                <table id="{{ $key }}" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                    <thead>
                    <tr class="alert-success">
                        <th>#</th>
                        <th>{{__('system.name')}}</th>
                        <th>{{__('system.day')}}</th>
                        <th>{{__('system.course_start_time')}}</th>
                        <th>{{__('system.course_end_time')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                           @foreach ($courseGroup as $course)
                                <tr class="position-relative data-row" data-href="#">
                                    <a href="#" class="position-absolute w-100 h-100 left-0 top-0"></a>
                                    <td>{{$course->id}}</td>
                                    <td>{{$course->name}}</td>
                                    <td>{{__("system.$course->day")}}</td>
                                    <td>{{$course->start_at}}</td>
                                    <td>{{$course->end_at}}</td>         
                                </tr>
                           @endforeach
                    </tbody>
                </table>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
