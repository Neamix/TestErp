@extends('layouts.master')
@section('css')

@section('title')
empty
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-2"> Users List</h4>
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
                <div class="row">
                    <div class="col-md-3">
                        <form class="search_form">
                            <input type="search" placeholder="Enter name " class="form-control search-user">
                        </form>
                    </div>
                    <div class="col-md-3">
                        <form class="search-form">
                            <select class="form-control select_job">
                                <option value="1" selected>{{__('system.crew')}}</option>
                                <option value="2">{{__('system.teacher')}}</option>
                                <option value="3">{{__('system.student')}}</option>
                            </select>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form class="active-form row">
                            <div class="form-group d-flex align-items-center col-md-4 mb-0">
                                <input class="form-control w-25 active_user" name="active-state" type="radio" value="1">
                                <label class="mb-0">All User</label>
                            </div>
                            <div class="form-group d-flex col-md-4 mb-0">
                                <input class="form-control w-25 align-items-center active_user" name="active-state" type="radio" value="2">
                                <label class="mb-0">Active User</label>
                            </div>
                            <div class="form-group d-flex col-md-4 align-items-center mb-0">
                                <input class="form-control w-25 active_user" name="active-state" type="radio" value="3">
                                <label class="mb-0">Suspended User</label>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-4 users-list">
                   
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
<script>
    //init list
    $(function(){
        function getUser() {
            let type = $('.select_job').val();
            let name = ($('.search-user').val().length) ? $('.search-user').val() : null;
            let active = $('.active_user:checked').val();
            let page = $('.page-indicator').val();

            $.ajax({
                url: `/user/list?page=${page}`,
                data: {
                    'type': type,
                    'name': name,
                    'active': active
                },
                success: function(e) {
                    pages = Math.ceil(3/15);
                    users = e.data;
                    $('.users-list').html('');
                    $('.pagination').html('');
                    if(pages > 1) {
                        for(i = 1; i <= pages; i++) {
                            $('.pagination').append(`<li class="page-link" value="${i}">${i}</li>`);
                        }
                    }
                  
                    users.forEach(user => {
                        let str = `<div class="col-md-4">
                                        <div class="card mt-4">
                                            <div class="card-body card-user d-flex">
                                                <div class="user-image w-25">
                                                    <img src="{{ asset('assets/images/users/default.png') }}" alt="user" class="w-100">
                                                </div>
                                                <div class="user-info">
                                                    <h2>${user.name}</h2>`;

                        if(user.type == 1) str += '<p>Crew</p>';
                        if(user.type == 2) str += '<p>Teacher</p>';
                        if(user.type == 3) str += '<p>Student</p>';

                        str +=`</div></div></div></div>`;

                        $('.users-list').append(str);
                    });

                    
                }
            })
        }

        //init the list
        getUser();

        $('.search-user').on('keyup',function(){
            getUser();
        });

        $('.active_user,.select_job').on('change',function(){
            getUser();
        })
    });
</script>
@endsection
