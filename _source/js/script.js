$(document).ready(function () {

    // открытие меню
    $('body').on('click', '.js-menu-trigger', function () {
        $(this).toggleClass('open');
        $(this).closest('.js-menu').toggleClass('open');
    });
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.js-menu').length) {
            $('.js-menu-trigger').removeClass('open');
            $('.js-menu').removeClass('open');
        }
        e.stopPropagation();
    });

    // кнопка more
    $('body').on('click', '.js-more', function () {
        $('.js-more-anim').removeClass('animate');
        $('.js-more-modal').slideUp();
        $(this).find('.js-more-anim').addClass('animate');
        $(this).find('.js-more-modal').slideDown();
    });
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.js-more').length) {
            $('.js-more-anim').removeClass('animate');
            $('.js-more-modal').slideUp();
        }
        e.stopPropagation();
    });

});