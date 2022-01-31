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
    <h2 class="p-3">
        @isset($subject['id'])
            {{ __('system.edit_user') }}
        @else
            {{ __('system.add_subject') }}
        @endisset
    </h2>
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100 subject-insert">
            <div class="card-body">
                <form class="form" id="upsertCourse">
                    <input type="hidden" value="@isset($user) {{ $user['id'] }} @endisset" id="user_id">
                    <div class="form-group">
                        <label for="subject_name">
                            {{ __('system.subject_name') }}
                        </label>
                       <input type="text" placeholder="{{ __('system.subject_name') }}" class="form-control" id="subject_name" value="@isset($course->name) {{ $course->name }} @endisset">
                       <p class="error" id="name_error"></p>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="teacher">
                                         {{ __('system.student') }} 
                                    </label>
                                    <div class="select-picker w-100 position-relative">
                                        <input type="search" class="form-control position-relative w-100 select-picker-input" placeholder="{{ __('system.add_student') }}" data-type="{{ STUDENT }}"  key="add_student">
                                        <ul class="drop-down-search-list card position-absolute bottom-0 w-100 nav overlayed dropdown-toggle" key_menu="add_student">
                                          
                                        </ul>
                                    </div>
                                    <p class="error" id="student_error"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="teacher">
                                         {{ __('system.add_teacher') }} 
                                    </label>
                                    <div class="select-picker w-100 position-relative">
                                        <input type="search" class="form-control position-relative w-100 select-picker-input" placeholder="{{ __('system.add_teacher') }}" data-type="{{ TEACHER }}"  key="add_teacher">
                                        <ul class="drop-down-search-list card position-absolute bottom-0 w-100 nav overlayed dropdown-toggle" key_menu="add_teacher">
                                              
                                        </ul>
                                    </div>
                                    <p class="error" id="teacher_error"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="teacher">
                                         {{ __('system.course_start_time') }} 
                                    </label>
                                    <div class="select-picker w-100 position-relative">
                                        <input type="time" class="form-control position-relative w-100 select-picker-input start" placeholder="{{ __('system.course_time') }}" value="@isset($course->start_at){{ $course->start_at}}@endisset">
                                        <p class="error" id="start_error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="teacher">
                                         {{ __('system.course_end_time') }} 
                                    </label>
                                    <div class="select-picker w-100 position-relative">
                                        <input type="time" class="form-control position-relative w-100 select-picker-input end" placeholder="{{ __('system.course_time') }}" value="@isset($course->end_at){{ $course->end_at}}@endisset">
                                        <p class="error" id="end_error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="teacher">
                                         {{ __('system.day') }} 
                                    </label>
                                    <div class="select-picker w-100 position-relative">
                                        <select class="form-control position-relative w-100 select-picker-input" placeholder="{{ __('system.day') }}" id="select_day">
                                            <option @isset($course) @if($course->day == 'saturday') selected @endif @endisset value="saturday">{{__('system.saturday')}}</option>
                                            <option @isset($course) @if($course->day == 'sunday') selected @endif  @endisset value="sunday">{{__('system.sunday')}}</option>
                                            <option @isset($course) @if($course->day == 'monday') selected @endif  @endisset value="monday">{{__('system.monday')}}</option>
                                            <option @isset($course) @if($course->day == 'tuesday') selected @endif @endisset value="tuesday">{{__('system.tuesday')}}</option>
                                            <option @isset($course) @if($course->day == 'wednesday') selected @endif @endisset value="wednesday">{{__('system.wednesday')}}</option>
                                            <option @isset($course) @if($course->day == 'thursday') selected @endif @endisset value="thursday">{{__('system.thursday')}}</option>
                                            <option @isset($course) @if($course->day == 'friday') selected @endif @endisset value="friday">{{__('system.friday')}}</option>
                                        </select>
                                        <p class="error" id="day_error"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn loader-key d-flex align-items-center" load="upsert_subject">
                        <div class="loader loader-small ml-2 mr-2 d-none" data-load="upsert_subject"></div>
                        <p>{{ __('system.add_subject') }}</p>
                    </button>
                </form>
                <h3 class="mt-4 text-large">{{ __('system.student_list') }}</h3>
                <table id="studentTable" class="table  table-hover mt-3"  style="text-align: center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th>{{__('system.name')}}</th>
                            <th>{{__('system.email')}}</th>
                            <th>{{__('system.operation')}}</th>
                        </tr>
                    </thead>
                    <tbody class="student-table-body">
                        
                    </tbody>
                </table>
                <input type="hidden" id="course_id" value="@isset($course) {{ $course->id }} @endisset">
            </div>
        </div>
    </div>

    <!-- row closed -->
    @endsection
    @section('js')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>
    <script>
        let selectedStudentJson;
        let selectedTeacherJson;
    </script>
    @isset($course)
    <script> 
        selectedStudentJson = @json($course->students) 
    </script>
    @endisset
    @isset($course)
    <script> 
        selectedTeacherJson = @json($course->teachers) 
    </script>
    @endisset
    <script>
        let selectedStudents = [];
        let selectedTeachers = [];
        let create_state = $('#subject_name').val().length == 0 ? true : false;

        if(selectedStudentJson) {
            selectedStudentJson.forEach(student =>{
                selectedStudents.push(student.id);
                buildArow(student,$('.student-table-body'))
            });
        }

        if(selectedTeacherJson) {
            selectedTeacherJson.forEach(teacher =>{
                selectedTeachers.push(teacher.id)
            });
        }

        console.log(selectedStudents,selectedTeachers);

        $('#table_id').DataTable();
        $('.select-picker-input').keyup(function(){
            let name = $(this).val()
            let type;
            let type_id = $(this).attr('data-type');
            if( type_id == 1) {
                type = 'crew'
            } else if(type_id == 2) {
                type = 'teacher'
            } else {
                type = 'student'
            }

            if(name.length) {
                $.ajax({
                    url: '{{ route("user.filter") }}',
                    type: 'get',
                    data: {name: $(this).val(),type: $(this).attr('data-type'),limit:5,id: $('#course_id').val()},
                    success: (e) => {
                        let users = e.data;
                        $(this).siblings($('.drop-down-search-list')).html('');
                        $(this).siblings($('.dropdown-toggle')).fadeIn();
                        users.forEach(user => {
                            let activeState = (selectedStudents.includes(user.id) || selectedTeachers.includes(user.id)) ? 'active' : '';
                            let add_class = (user.type == '{{ STUDENT }}') ? 'add-student' : 'add-teacher';
                            $(this).siblings($('.drop-down-search-list')).append(`<li class="nav-item ${add_class} p-2 ${activeState}" user-id="${user.id}" user-email="${user.email}" user-name="${user.name}">${user.name}</li>`);
                            $('.empty-users').remove();
                        });

                        if( ! users.length ) {
                            $(this).siblings($('.drop-down-search-list')).append(`<li class="nav-item d-flex justify-content-center m-2 empty-users"> ${ getTranslateValue('no') } ${ getTranslateValue(type) } ${getTranslateValue('start_with')} ${name}</li>`);
                        }
                    }
                });
        } else {
            $(this).siblings($('.drop-down-search-list')).html('');
        }
        
        $('.select-picker-input').on('click',function(){
            $(`.dropdown-toggle[key_menu = "${$(this).attr('key')}"]`).fadeIn();
        });

    });

    $('.drop-down-search-list').on('click','.add-student',function(){
        let id = parseInt($(this).attr('user-id'));
        if(selectedStudents.includes(id)) {
            removeStudent(id);
        } else {
            selectedStudents.push(id);
            buildArow({id: id,name: $(this).attr('user-name'),email: $(this).attr('user-email'),type: '{{ STUDENT }}'},$('.student-table-body'))
            $(this).addClass('active');
        }

    });



    $('.drop-down-search-list').on('click','.add-teacher',function(){
        let id = parseInt($(this).attr('user-id'));
        console.log(id);
        if(selectedTeachers.includes(id)) {
            let index = selectedTeachers.findIndex((x) => x == id );
            selectedTeachers.splice(index,1);
            $(this).removeClass('active');
        } else {
            selectedTeachers.push(id);
            $(this).addClass('active');
        }

    });

    function buildArow(user,container) {
        let row = `<tr id=${user.id}>
                        <th scope="row">${user.id}</th>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td class="removeStudentrow cursor-pointer" type="${user.type}" id="${user.id}"><i class="ti-na"></i></td>
                    </tr>`;
        $('.dataTables_empty').addClass('d-none');
        $('#table_id').DataTable();
        container.append(row);
    }

    function removeStudent(id) {
        let index = selectedStudents.findIndex((x) => x == id );
        selectedStudents.splice(index,1);
        $(`.add-student[user-id="${id}"]`).removeClass('active');
        $(this).removeClass('active');
        $(`tr#${id}`).remove();
    }

    $('table').on('click','.removeStudentrow',function(){
        removeStudent($(this).attr('id'));
    })

    $('#upsertCourse').on('submit',function(e){
        e.preventDefault();

        $.ajax({
            url: '/subject/upsert',
            type: 'post',
            data: {
                students: selectedStudents,
                teachers: selectedTeachers,
                id: $('#course_id').val(),
                start: $('.start').val(),
                end: $('.end').val(),
                name: $('#subject_name').val(),
                day: $('#select_day').val()
            },

            success: (e) => {
                Swal.fire({
                    title: 'Success',
                    icon: 'success',
                    confirmButtonText: 'Cool',
                    showConfirmButton: false
                });

                $('.error').text('');
                if( create_state ) {
                    $(this).trigger('reset')
                    $('.student-table-body').html('');
                    
                    selectedTeachers = [];
                    selectedStudents = [];
                    console.log('here');
                    $('.drop-down-search-list').html('');
                }
            },

            error: function (error) {
                let errors = error.responseJSON.errors;
                console.log(errors);
                if( errors ) {
                    if(errors.name ) {
                        if(errors.name == 'validation.required') {
                            $('#name_error').text(`{{__('validation.name_is_required')}}`);
                        }
                    } else {
                        $('#name_error').text(``);
                    }

                    if(errors.start ) {
                        if(errors.start == 'validation.required') {
                            $('#start_error').text(`{{__('validation.start_time_is_required')}}`);
                        }
                    } else {
                        $('#start_error').text(``);
                    }

                    if(errors.day ) {
                        if(errors.day.includes('valiation.required')) {
                            $('#day_error').text(`{{__('validation.day_is_required')}}`);
                        }
                    } else {
                        $('#day_error').text(``);
                    }

                    if(errors.end ) {
                        if(errors.end.includes('validation.required')) {
                            $('#end_error').text(`{{__('validation.end_time_is_required')}}`);
                        } 

                        if(errors.end.includes('validation.invalid')) {
                            $('#end_error').text(`{{__('validation.end_time_must_be_after_the_start_time')}}`);
                        }
                    } else {
                        $('#end_error').text('');
                    }

                    if(errors.students ) {
                        if(errors.students.includes('validation.required')) {
                            $('#student_error').text(`{{__('validation.student_is_required')}}`);
                        } 
                    } else {
                        $('#student_error').text(''); 
                    }

                    if(errors.teachers ) {
                        if(errors.teachers.includes('validation.required')) {
                            $('#teacher_error').text(`{{__('validation.teacher_is_required')}}`);
                        } else {
                            $('#teacher_error').text(errors.teachers[0]);
                        }
                    } else {
                        $('#teacher_error').text('')
                    }
                }
            }
        })
    });
</script>
@endsection