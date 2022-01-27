@extends('layouts.master')
@section('css')

@section('title')
{{__('system.trash_bin')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-2">{{__('system.trash_bin')}}</h4>
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
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                    <thead>
                    <tr class="alert-success">
                        <th>#</th>
                        <th>{{__('system.name')}}</th>
                        <th>{{__('system.operation')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                            <tr>
                            <td>{{$course->id}}</td>
                            <td>{{$course->name}}</td>
                            <td class="d-flex justify-content-center">
                                <ul class="operation d-flex nav">
                                    @can('delete-course',Auth::user())
                                    <li class="nav-item ml-2 mr-2 cursor-pointer password_confirm_need" data-target="#confirmPassword" data-toggle="modal" data-url="{{ route('course.destroy',['course'=>$course->id]) }}" redirect="{{ route('trash',['model'=>'course']) }}"><i class="ti-na"></i></li>
                                    @endcan
                                    @can('trash-course')
                                    <li class="nav-item ml-2 mr-2 cursor-pointer password_confirm_need" data-target="#confirmPassword" data-toggle="modal" data-url="{{ route('course.restore',['course'=>$course->id]) }}" redirect="{{ route('trash',['model'=>'course']) }}"><i class="ti-back-right mr-2 ml-2"></i></li>
                                    @endcan
                                </ul>
                            </td>                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
