<script>
    let priviledges_full = @json($user->priviledges);
    let priviledges_array = [];
    console.log(priviledges_array);

    //check all input in priviledges array 
    priviledges_full.forEach(priviledge => {
        priviledges_array.push(priviledge.id);
    });

    priviledges_array.forEach(priviledge => {
        let input = $(`.privillege-input[value=${priviledge}]`);

        if(input.length) {
            input.click();
        } 
    });

    $('.privillege-input').on('click',function(){
        if(!$(this).prop('checked')) {
            let name = $(this).prop('name');
            if(name) {
                $(`.privillege-input[data_parent=${name}]`).each(function(){
                    let checked = $(this).prop('checked');
                    if(checked) {
                        $(this).click();
                    }
                })
            }

        } else {
            let parent = $(this).attr('data_parent');

            if(parent) {

                if(!$(`.privillege-input[data_child=${parent}]`).prop('checked')) {
                    $(`.privillege-input[data_child=${parent}]`).click();
                }

            }

        }
        console.log(priviledges_array);
    });

    $('.privillege-input').on('change',function(){
        let val = $(this).val();

        if($(this).prop('checked')) {
            priviledges_array.push(val);
        } else {
            let index = priviledges_array.indexOf(val);
            priviledges_array.splice(index,1);
        }
    });

    $('.priviledge_save').on('click',function(){
        $.ajax({
            url: '/user/priviledge/{{ $user->id }}',
            method: 'post',
            data: {'priviledges': priviledges_array},
            success: function() {
                console.log('here');
            }
        })
    })
</script>