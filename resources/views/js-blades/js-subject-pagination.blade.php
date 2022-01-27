<script>
    //init list
    $(function(){
        let reloadPager = true;

        function getSubject() {
            let name = ($('.search-subject').val().length) ? $('.search-subject').val() : null;
            let teacher = $('.search-teacher').val() ? $('.search-teacher').val() : null;
            let page  = $('.page-indicator').val();

            $.ajax({
                url: `/subject/list?page=${page}`,
                data: {
                    'name': name,
                    'teacher': teacher,
                },
                success: function(e) {
                    let courses = e.data;

                    $('.courses-list').html('');
                    
                    if(reloadPager) {
                        createPagination(e.total,e.per_page,$('.pagination'),'{{ Auth::user()->lang }}');
                        reloadPager = false;
                    }
                  
                    courses.forEach(course => {
                        
                        let teachersArray = [];

                        course.teachers.forEach(teacher => {
                            console.log(teacher);
                            teachersArray.push(teacher.name);
                        });

                        let teachersString = teachersArray.join(',');

                        let str = `<div class="col-md-4">
                                        <div class="card mt-4">
                                            <div class="card-body card-user d-flex">
                                                <div class="user-info">
                                                    <h2>${course.name}</h2>
                                                    <p>${teachersString}</p>
                                                    <p><span> ${getTranslateValue(course.day)} </span>${course.start_at}</p>
                                                    `;

                        str +=`</div></div></div></div>`;

                        $('.courses-list').append(str);
                    });
                }
            });
        }   

        //init the list
        getSubject();

        $('.search-subject').on('keyup',function(){
            reloadPager = true;
            console.log('here');
            setPage(1);
            getSubject();
        });

        $('.search-teacher').on('change',function(){
            reloadPager = true;
            setPage(1);
            getSubject();
        });

        $('.pagination').on('click','.page-item',function(){
            setPage($(this).attr('value'));
            getSubject();
        });
    });
</script>