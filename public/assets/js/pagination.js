let margin;
function createPagination(total,per_page,container,lang) {
    margin = lang == 'ar' ? 'margin-right' : 'margin-left';
    let countPages = Math.ceil(total/per_page);

    container.html('');
    //loop to create btns 
    container.append('<div class="pages d-flex"><div class="pages-inner d-flex" ></div></div>');

    for(i = 1; i <= countPages; i++) {
        container.find('.pages-inner').append(`<li class="page-item" value="${i}"><span class="page-link">${i}</span></li>`);
    }

   if( lang == 'en' ) {
        container.prepend('<li class="prev-page page-cursor"><i class="ti-angle-left"></i></li>');
        container.append('<li class="next-page page-cursor"><i class="ti-angle-right"></i></li>');
   } else {
        container.prepend('<li class="prev-page page-cursor"><i class="ti-angle-right"></i></li>');
        container.append('<li class="next-page page-cursor"><i class="ti-angle-left"></i></li>');
   }

    container.children('.pages').css('width',($('.page-link').width() + 1)  * 5 + 1)

    $('.page-item').eq(0).addClass('active');
}

$('.pagination').on('click','.next-page',function(){
    $('.page-item.active').next().click();
    $('.pagination .pages-inner').css(margin,-($('.page-link').width() + 1)  * $('.page-item.active').index());
});

$('.pagination').on('click','.prev-page',function(){
    $('.page-item.active').prev().click();
    $('.pagination .pages-inner').css(margin,-($('.page-link').width() + 1)  * $('.page-item.active').index());
});

function setPage(page_no) {
    $('input.page-indicator').val(page_no);
    $('.page-item').removeClass('active');
    $('.page-item').eq(page_no - 1).addClass('active');
    $('.pagination .pages-inner').css(margin,-($('.page-link').width() + 1)  * $('.page-item.active').index());
}