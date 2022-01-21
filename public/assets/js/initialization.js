//datepicker init
$( "#datepicker" ).datepicker();

//ajax setup
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.password_confirm_need').on('click',function() {
    $('.confirmPasswordForm').attr('action',$(this).attr('data-url'));
    $('.confirmPasswordForm').attr('redirect',$(this).attr('redirect'));
});

$('.confirmPasswordForm').on('submit',function(e){
    e.preventDefault();
    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: {password: $('.password-input').val()},
        success: (e) => {
            window.location.href = $(this).attr('redirect');
        },
        error: function(e) {
            $('.confirm-error').text(e.responseJSON.message);
        }
    })
})

