
<script>
    let create_state = ( $('#user_name').val().length ) ? false : true; 
    $('#upsertUser').on('submit', function (e) {
        //stop submit action
        e.preventDefault();

        //get input values
        let username = $('#user_name').val();
        let email = $('#user_email').val();
        let joinDate = $('#datepicker').val();
        let userJob = $('#user_job').val();
        let id = $('#user_id').val();
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

        if( ! Object.keys(error).length ) {
            $.ajax({
                url: '/user/upsert',
                method: 'post',
                data: {
                    'name': username,
                    'id': id,
                    'email': email,
                    'join_date': joinDate,
                    'type': userJob
                },
                success: function (e) {
                    if(e.result == 'success') {
                        Swal.fire({
                            title: 'Success',
                            text: '{{ __("validation.user_has_been_created_successfully") }}',
                            icon: 'success',
                            confirmButtonText: 'Cool',
                            showConfirmButton: false
                        })
                        
                        if( create_state ) {
                            $('#upsertUser').trigger("reset");
                        }
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Error occur',
                            icon: 'error',
                            confirmButtonText: 'Cool',
                            showConfirmButton: false
                        })
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