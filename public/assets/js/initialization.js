//ajax setup
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },

    beforeSend: function() {
        console.log(window.loader);
        $(`.loader[data-load="${window.loader}"]`).removeClass('d-none')
    },

    complete: function() {
        $(`.loader[data-load="${window.loader}"]`).addClass('d-none');
    }
});

$('.loader-key').on('click',function(){
    window.loader = $(this).attr('load');
})

$('.password_confirm_need').on('click',function() {
    $('.confirmPasswordForm').attr('url',$(this).attr('data-url'));
    $('.confirmPasswordForm').attr('redirect',$(this).attr('redirect'));
});

$('.confirmPasswordForm').on('submit',function(e){
    e.preventDefault();
    $.ajax({
        url: $(this).attr('url'),
        method: $(this).attr('type'),
        data: {password: $('.password-input').val()},
        success: (e) => {
            window.location.href = $(this).attr('redirect');
        },
        error: function(e) {
            $('.confirm-error').text(e.responseJSON.message);
        }
    })
});

$(document).on("click", function(e){
    let key = $(e.target).attr('key');
    $(`.dropdown-toggle[key_menu != "${key}"]`).fadeOut();
});

$('.dropdown-toggle').on('click',function(e){
    e.stopPropagation();
});

$('.data-row').on('click',function(){
    window.location = $(this).attr('data-href');
    return false;
});
