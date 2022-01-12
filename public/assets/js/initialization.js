//datepicker init
$( "#datepicker" ).datepicker();

//ajax setup
console.log($('meta[name="csrf-token"]').attr('content'))
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});