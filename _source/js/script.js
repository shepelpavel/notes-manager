$(document).ready(function () {

    // функция генерация пароля
    function generatePass(lngt, mod) {
        var result = '';
        var template = '';
        var letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        var numerals = '12345678901234567890123456789012345678901234567890';
        var symbols = '!#$%&()*+-:;<=>?@[]^_{|}~!#$%&()*+-:;<=>?@[]^_{|}~';
        switch (mod) {
            case '0':
                template = letters;
                break;
            case '1':
                template = letters + numerals;
                break;
            case '2':
                template = letters + symbols;
                break;
            case '3':
                template = letters + numerals + symbols;
                break;
            default:
                template = letters + numerals;
        }
        var max_position = template.length - 1;
        for (i = 0; i < lngt; ++i) {
            position = Math.floor(Math.random() * max_position);
            result = result + template.substring(position, position + 1);
        }
        return result;
    }

    // генерация пароля
    $('body').on('click', '.js-generate-button', function () {
        var lngt = $('.js-generate-length').val();
        if ($('.js-generate-num').prop('checked') && $('.js-generate-sym').prop('checked')) {
            var mod = '3';
        } else if ($('.js-generate-sym').prop('checked')) {
            var mod = '2';
        } else if ($('.js-generate-num').prop('checked')) {
            var mod = '1';
        } else {
            var mod = '0';
        }
        $('.js-generate-password').text(generatePass(lngt, mod));
    });

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