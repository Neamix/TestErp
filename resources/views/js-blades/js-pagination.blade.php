<script>
    //init list
    $(function(){
        let reloadPager = true;

        function getUser() {
            let type = $('.select_job').val();
            let name = ($('.search-user').val().length) ? $('.search-user').val() : null;
            let active = $('.active_user:checked').val();
            let page = $('.page-indicator').val();
            window.loader = $('.main-container').attr('load');
            $('.users-list').html('');
            $.ajax({
                url: `/user/filter?page=${page}`,
                data: {
                    'type': type,
                    'name': name,
                    'active': active
                },
                success: function(e) {
                    let users = e.data;
                    
                    if(reloadPager) {
                        createPagination(e.total,e.per_page,$('.pagination'),'{{ Auth::user()->lang }}');
                        reloadPager = false;
                    }
                  
                    users.forEach(user => {
                        console.log(user);
                        let str = `<div class="col-md-4 position-relative">
                                        <div class="card mt-4">
                                            <div class="card-body card-user d-flex position-relative">
                                                <a href="/user/profile/${user.id}" class="position-absolute top-0 left-0 w-100 h-100"></a>
                                                <div class="user-image w-25">
                                                    <img src="/assets/images/users/${user.avatar}" alt="user" class="w-100 rounded-circle">
                                                </div>
                                                <div class="user-info">
                                                    <h2>${user.name}</h2>`;

                        if(user.type == 1) str += '<p>{{__("system.crew")}}</p>';
                        if(user.type == 2) str += '<p>{{__("system.teacher")}}</p>';
                        if(user.type == 3) str += '<p>{{__("system.student")}}</p>';

                        str +=`</div></div></div></div>`;

                        $('.users-list').append(str);
                    });

                    
                }
            })
        }

        //init the list
        getUser();

        $('.search-user').on('keyup',function(){
            reloadPager = true;
            setPage(1);
            getUser();
        });

        $('.active_user,.select_job').on('change',function(){
            reloadPager = true;
            setPage(1);
            getUser();
        });

        $('.user-list').on('click','.page-item',function(){
            setPage($(this).attr('value'));
            getUser();
        });
    });
</script>