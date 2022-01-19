@extends('layouts.master')
@section('css')
<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
@section('title')
    @if(Auth::id() == $user->id)
        My Profile
    @else 
       {{ $user->name }}
    @endif
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100 card-profile p-3">
            <div class="card-body">
                <div class="user">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="user-image">
                                <img src="/assets/images/users/{{ $user->avatar }}" class="@if(Auth::id() == $user->id) myAvatar @else avatar @endif profileImage"/>
                                <div type="button"  data-toggle="modal" data-target="#avatarModal" class="img-modify-trigger d-flex justify-content-center align-items-center">
                                    <i class="ti-camera fs-large text-white"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h2 class="fs-large">{{ $user->name }}</h2>
                            <p class="fs-small mb-3"> {{ $user->email }} </p>
                            <p class="tag">
                                @if($user->type == CREW) 
                                    {{__('system.crew')}}
                                @elseif($user->type == TEACHER) 
                                    {{__('system.teacher')}} 
                                @else 
                                    {{__('system.student')}} 
                                @endif 
                            </p>
                            @if(Auth::id() != $user->id)
                                <div class="action d-flex mt-4">
                                    <div class="fs-small cursor-pointer"><i class="ti-pencil mr-2"></i>Edit</div>
                                    <div class="fs-small ml-2 cursor-pointer"><i class="ti-trash mr-2"></i>Trash</div>
                                    <div class="fs-small ml-2 cursor-pointer"><i class="ti-na mr-2"></i>Delete</div>
                                    @if($user->active)
                                    <div class="fs-small ml-2 cursor-pointer"><i class="ti-control-pause mr-2"></i>Suspend</div>
                                    @endif
                                    @if(!$user->active)
                                    <div class="fs-small ml-2 cursor-pointer"><i class="ti-control-play mr-2"></i>Activate</div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if(Auth::id() != $user->id)
                <div class="privilleges mt-5 pt-4">
                    <h2 class="fs-medium mb-2">{{ $user->name }}'s Priviledges</h2>
                    <div class="row">
                        {{-- <div class="col-md-4">
                            <form class="privilledge-form">
                                <div class="form-group">
                                    <input class="privillege-input" type="checkbox" name="user" data_child="user" value="VIEW_USER_LIST">
                                    <label>View Users List</label>
                                    <div class="child-privillege ml-3">
                                        <div class="form-group mb-2">
                                            <input class="privillege-input" type="checkbox" data_parent="user" value="EDIT_USER">
                                            <label>Edit Users</label>
                                        </div>
                                        <div class="form-group mb-2">
                                            <input class="privillege-input" type="checkbox" data_parent="user">
                                            <label>Delete Users</label>
                                        </div>
                                        <div class="form-group mb-2">
                                            <input class="privillege-input" type="checkbox" data_parent="user">
                                            <label>Suspend Users</label>
                                        </div>
                                        <div class="form-group mb-2">
                                            <input class="privillege-input" type="checkbox" data_parent="user">
                                            <label>Trash Users</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> --}}
                        <div class="col-md-6">
                            <form class="privilledge-form">
                                <div class="form-group">
                                    <input class="privillege-input" type="checkbox" value="VIEW_USER_LIST">
                                    <label>View Users List</label>
                                    <div class="child-privillege ml-3">
                                        <div class="form-group mb-2">
                                            <input class="privillege-input" type="checkbox" value="EDIT_USER">
                                            <label>Edit Users</label>
                                        </div>
                                        <div class="form-group mb-2">
                                            <input class="privillege-input" type="checkbox">
                                            <label>Delete Users</label>
                                        </div>
                                        <div class="form-group mb-2">
                                            <input class="privillege-input" type="checkbox">
                                            <label>Suspend Users</label>
                                        </div>
                                        <div class="form-group mb-2">
                                            <input class="privillege-input" type="checkbox">
                                            <label>Trash Users</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form class="privilledge-form">
                                <div class="form-group">
                                    <input class="privillege-input" type="checkbox" value="{{ VIEW_USER_LIST }}" data_child="user" name="user">
                                    <label>{{ __('system.view_user_list') }}</label>
                                    <div class="child-privillege ml-3">
                                        <div class="form-group mb-2">
                                            <input class="privillege-input" type="checkbox" value="{{ EDIT_USER }}" parent_id="{{ VIEW_USER_LIST }}" data_parent="user">
                                            <label>{{ __('system.edit_user') }}</label>
                                        </div>
                                        <div class="form-group mb-2">
                                            <input class="privillege-input" type="checkbox" value="{{ DELETE_USER }}" parent_id="{{ VIEW_USER_LIST }}" data_parent="user">
                                            <label>{{ __('system.delete_user') }}</label>
                                        </div>
                                        <div class="form-group mb-2">
                                            <input class="privillege-input" type="checkbox" value="{{ SUSPEND_USER }}" parent_id="{{ VIEW_USER_LIST }}" data_parent="user">
                                            <label>{{ __('system.suspend_user') }}</label>
                                        </div>
                                        <div class="form-group mb-2">
                                            <input class="privillege-input" type="checkbox" value="{{ TRASH_USER }}" parent_id="{{ VIEW_USER_LIST }}" data_parent="user">
                                            <label>{{ __('system.trash_user') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="button priviledge_save">Save</div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
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

    let targetInput;
    let file = null;
    let readyToUpload = false;

    $('.browse').on('click',function(e){
        e.preventDefault();
        target = $(this).attr('target');
        targetInput = document.getElementById(target);
        targetInput.value = '';
        targetInput.click();
        targetInput.addEventListener('change',function(){
            createNewFileUpload(targetInput.files[0]);
        });
    });

    

    let dragElement = document.querySelector('.drag-zone');
    dragElement.ondragover = function () {
        this.classList.add('active');
        return false;
    }

    dragElement.ondragleave = function () {
        this.classList.remove('active');
        return false;
    }

    dragElement.ondrop = function (e) {
        e.preventDefault();
        file = e.dataTransfer.files[0];
        createNewFileUpload(file);
        this.classList.remove('active');
    }

    function togglePreview(toggle,url = null) {
        if(toggle) {
            readyToUpload = true;
            $('.image-preview').removeClass('d-none').addClass('d-flex');
            $('.drag-zone').addClass('d-none').removeClass('d-flex');
            $('.image-preview img').attr('src',url);
            $('.avatar-footer').addClass('d-flex').removeClass('d-none');
        } else {
            readyToUpload = false;
            console.log($('.image-preview'));
            $('.image-preview').removeClass('d-flex').addClass('d-none');
            $('.drag-zone').addClass('d-flex').removeClass('d-none');
            $('.image-preview img').attr('src','');
            $('.avatar-footer').addClass('d-none').removeClass('d-flex');
        }
    }

    function createNewFileUpload(file) {
        //check the type
        let allowedTypes = ['image/jpeg','image/png','image/jpg'];
        if(!allowedTypes.includes(file.type)) {
            $('#avatar_error').text('{{__("validation.only_type_are_allowed")}}');  
            return false; 
        } else {
            $('#avatar_error').text('');
        }

        //validate size
        if(file.size > 10485760 /**10mb**/) {
            $('#avatar_error').text('{{__("validation.the_maximum_size_allowed_is_10_mb")}}');  
            return false;
        }

        //file read
        let fileRead = new FileReader();
        fileRead.onload = function () {

            let result = fileRead.result;
            let image  =  new Image();
            let error  = {};
            image.src = result;
            window.avatar = result;

            image.onload = function () {
                
                if(this.width < 624 || this.height < 596) {
                    error['min'] = '{{__("validation.this_image_is_very_small_the_avatar_must_be_at_least_624_px_X_596_px")}}';
                } else {
                    delete error['min'];
                }

                if(this.width > 1000 || this.height > 990) {
                    error['max'] = '{{__("validation.this_image_is_very_large_the_avatar_must_be_at_max_1000_px_X_990_px")}}';
                }

                if(Object.keys(error).length) {
                    $('#avatar_error').text(error[Object.keys(error)[0]]);
                } else {
                    $('#avatar_error').text('');
                    togglePreview(true,result);
                }
            }
        }

        fileRead.readAsDataURL(file);
        window.file = file;
    }

    $('.uploadAvatar').on('click',function(){

        let formData = new FormData();
        formData.append('avatar',window.file);

        $.ajax({
            url: '/user/avatar',
            type: 'post',
            enctype: 'multipart/form-data',
            contentType: false,
            processData: false,
            cache:false,
            data: formData,
            success: function(e) {
                if(e.result == 'success') {

                    togglePreview(false);

                        Swal.fire({
                            title: 'Success',
                            icon: 'success',
                            showConfirmButton: false
                        });

                        $('.closeAvatarModel').click();
                        $('.myAvatar').attr('src',"");
                        $('.myAvatar').attr('src',window.avatar);
                }
            }
        })
    });

    $('.resetAvatar,.closeAvatarModel').on('click',function(){
        togglePreview(false);
    });


</script>
@endsection
