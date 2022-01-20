<script>
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