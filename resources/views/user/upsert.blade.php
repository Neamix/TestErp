@extends('layouts.master')
@section('css')

@section('title')
    Upsert
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
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <form class="form" id="upsertUser">
                    <div class="form-group">
                        <label for="user_name">
                            {{ __('system.user_name') }}
                        </label>
                        <input class="form-control" type="text" id="user_name" placeholder="Example: Abdalrhman Hussin"/>
                        <p class="error" id="user_name_error"></p>
                    </div>
                    <div class="form-group">
                        <label for="user_email">
                            {{ __('system.user_email') }}
                        </label>
                        <input class="form-control" type="text" id="user_email" placeholder="Example: abdalrhmanhussin@gmail.com"/>
                        <p class="error" id="user_email_error"></p>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="datepicker">
                                    {{ __('system.user_join_date') }}
                                </label>
                                <input class="form-control" type="text" id="datepicker" placeholder="dd/mm/yy"></p>
                                <p class="error" id="user_date_error"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="user_job">
                                    {{ __('system.user_job') }}
                                </label>
                                <select class="form-control" id="user_job">
                                    <option>Crew</option>
                                    <option>Teacher</option>
                                    <option>Student</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="btn">
                        <p>Add User</p>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script>
    $('#upsertUser').on('submit', function (e) {
        //stop submit action
        e.preventDefault();

        //get input values
        let username = $('#user_name').val();
        let email = $('#user_email').val();
        let joinDate = $('#datepicker').val();
        let userJob = $('#user_job').val();
        let error = {};
        //validate input
        if(username.length == 0) {
            $('#user_name_error').text("{{ __('validation.user_name_is_required') }}");
            error['username'] = true;
        } else {
            $('#user_name_error').text('');
            delete error.name;
        }

        if(! email.length ) {
            $('#user_email_error').text("{{ __('validation.user_email_is_required') }}");
            error['email'] = true;
        } else {
            $('#user_email_error').text('');
            delete error.email;
        }

        //validate date 

        let splitDate = joinDate.split('/');

        let year  = splitDate[2];

        let month = splitDate[0];

        let day   = splitDate[1];
    
        let daysInMonth = function (month,year) {
            return new Date(month,year,0).getDate();
        }

        if(
            day > daysInMonth(month,year)
            ||
            month <= 0 
            ||
            month > 12
            ||
            year > 3000
            ||
            year < 1000
            ||
            !joinDate
            
        ) {
            $('#user_date_error').text("{{ __('validation.enter_valid_date') }}");
            error['join_date'] = true;
        } else {
            $('#user_date_error').text("");
            delete error.join_date;
        }
        console.log(Object.keys(error).length);
        if( ! Object.keys(error).length ) {
            $.ajax({
                url: '/user/upsert',
                method: 'post',
                data: {
                    'name': username,
                    'email': email,
                    'join_date': joinDate,
                    'user_job': userJob
                },
                success: function (e) {
                    if(e.errors) {
                        e.errors.forEach(error => {
                            console.log(error)
                        });
                    }

                    if(e.result == 'success') {

                    } else {
                        
                    }
                },
                error: function (error) {
                    let errors = error.responseJSON.errors;
                    if( errors ) {
                        if(errors.email == 'validation.unique') {
                            $('#user_email_error').text("{{ __('validation.this_email_is_already_used_by_another_user') }}");
                        }
                    }

                }
            })
        }


    });

</script>
@endsection