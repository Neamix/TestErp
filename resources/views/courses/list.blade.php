@extends('layouts.master')
@section('css')

@section('title')
{{__('system.courses_list')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-2"> {{__('system.courses_list')}}</h4>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row user-list">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <form class="search_form">
                            <input type="search" placeholder="{{ __('system.enter_name') }}" class="form-control search-subject">
                        </form>
                    </div>
                    <div class="col-md-3">
                        <div class="select-picker w-100 position-relative">
                            <select class="form-control position-relative w-100 search-teacher"   key="add_teacher">
                                <option disabled selected value> -- {{ __('system.search_teacher') }} -- </option>
                                @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>   
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <p class="empty_list mt-4 w-100 text-center">{{__('system.no_data_to_display')}}</p>
                <div class="row mt-4 courses-list">
                </div>
            </div>
            <ul class="pagination p-3">
               
            </ul>
            <input class="page-indicator" value="1" type="hidden">
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@include('js-blades.js-subject-pagination')
@endsection
