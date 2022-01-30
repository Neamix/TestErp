<script>
    function userActions(action) {

        let url = '';

        if( action == 'suspend' ) {
            url = '/user/state/{{ $user->id }}' 
        }

        $.ajax({
            url: url,
            method: 'post',
            success: function (e) {
                // Swal.fire({
                //     title: 'Success',
                //     icon: 'success',
                //     showConfirmButton: false
                // });
            },
            error: function (e) {
                Swal.fire({
                    title: 'Error',
                    icon: 'error',
                    showConfirmButton: false
                });
            }
        })
    }

    $('.state-btn').on('click',function(){
        userActions('suspend');
        $('.state-btn').toggleClass('d-none');
    })

</script>