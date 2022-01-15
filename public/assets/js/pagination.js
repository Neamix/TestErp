function createPagination(total,per_page,container) {
    let countPages = Math.ceil(total/per_page);

    container.html('');
    //loop to create btns 

    for(i = 1; i <= countPages; i++) {
        container.append(`<li class="page-item" value="${i}"><span class="page-link">${i}</span></li>`);
    }

    $('.page-item').eq(0).addClass('active');
}

function setPage(page_no) {
    $('input.page-indicator').val(page_no);
    $('.page-item').removeClass('active');
    $('.page-item').eq(page_no - 1).addClass('active');
    console.log($('.page-item').eq(page_no - 1));
}