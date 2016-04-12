$(document).on('ready', function(){
    $('.scrollbar-inner').scrollbar();
}).on('click', '.users-block-toggle', function(){
    if( $('.users-block').hasClass('active') ){
        $('.users-block').removeClass('active');
    } else {
        $('.users-block').addClass('active');
    }
}).on('click', '.sidebar-toggle', function(){
    if( $('.admin-block').hasClass('show') ){
        $('.admin-block').removeClass('show');
        $('.main-page-block').removeClass('move');
        $('.sidebar-toggle.show').css('display','inline-block');
    } else {
        $('.admin-block').addClass('show');
        $('.main-page-block').addClass('move');
        $('.sidebar-toggle.show').css('display','none');
    }
}).on('click', '.firechat-header', function () {
    if( $(this).parent().children('.firechat-container').hasClass('active') ){
        $(this).parent().children('.firechat-container').removeClass('active');
    } else {
        $(this).parent().children('.firechat-container').addClass('active');
    }
});