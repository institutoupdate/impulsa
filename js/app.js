$(document).ready(function() {

    var $width = $(window).width(); // resolucion de pantalla

    // Scroll header
    $(function () {
        // A todos los primeros bloques darle la clase "js-first-block"
        var $blockScroll = $('.js-first-block').offset().top;
        var $prevScrollpos = window.pageYOffset; // Guardo el punto donde se encuentra el scroll al momento de cargar la página.
        var $scrollHeader;

        // Mobile
        if ($width < 1024) {
            $scrollHeader = 10;
        }
        
        //Desktop
        else {
            $scrollHeader = $blockScroll - 0;
        }

        $(window).scroll(function () {
            var $scroll = getCurrentScroll();

            // Mobile
            if ($width < 1024) {
                // Si scroleo para abajo y se pasa el primer bloque
                if ($scroll >= $scrollHeader) {
                    $(".js-header").removeClass('header--bg-transparent');
                    $(".js-header").addClass('header--shadow');
                }

                // Si llego arriba de todo
                if ($scroll === 0) {
                    $(".js-header").addClass('header--bg-transparent');
                    $(".js-header").removeClass('header--shadow');
                }
            }

            // Desktop
            else if ($width >= 1024) {
                // Si scroleo para abajo y se pasa el primer bloque
                if ($scroll >= $scrollHeader) {
                    $(".js-header").addClass('header--up');
                    $(".js-header").removeClass('header--bg-transparent');
                    $(".js-header").addClass('header--shadow');
                }

                // Si scroleo para arriba
                if ($prevScrollpos > $scroll) {
                    // Si llego arriba de todo
                    if ($scroll === 0) {
                        $(".js-header").addClass('header--down');
                        $(".js-header").removeClass('header--up');
                        $(".js-header").addClass('header--bg-transparent');
                        $(".js-header").removeClass('header--shadow');
                    }
                    // Si scroleo para arriba y NO llego arriba de todo
                    else {
                        $(".js-header").addClass('header--down');
                        $(".js-header").removeClass('header--up');
                    }
                } 
                // Si sigo scroleando para abajo
                else {
                    $(".js-header").addClass('header--up');
                    $(".js-header").removeClass('header--down');
                }

                $prevScrollpos = $scroll;

            }   
    
        });
                
        function getCurrentScroll() {
            return window.pageYOffset || document.documentElement.scrollTop;
        }

        // Cuando carga la pagina se fija donde esta el scroll

        // Si el scroll está debajo del primer bloque
        if($(window).scrollTop() >= $scrollHeader) {
            $('.js-header').removeClass('header--bg-transparent');
            $(".js-header").addClass('header--shadow');
        } 
    });

    // Slider
    var slider = new Swiper ('.js-slider', {
        // Optional parameters
        loop: true,
        slidesPerView: 1,

        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });

    // Btn Hamburger
    $('.js-btn-hamburger').click(function(event) {
        event.preventDefault();
        $(this).toggleClass('active');
        $('body').toggleClass('body-menu--open');
        $('.js-header__menu').toggleClass('header__menu--open');
    });

    // Dropdown
    var $dropdownTime = 400;
    $('.js-dropdown__btn').click(function(event) {
        event.preventDefault();
        $(this).toggleClass('active');
        $('.js-box--dropdown').slideToggle($dropdownTime);
    });

    // Dropdown search order
    var $dropdownOrderTime = 400;
    $('#btn-search-order').click(function(event) {
        event.preventDefault();
        $(this).toggleClass('active');
        $('#order-options').slideToggle($dropdownOrderTime);
    });

    // Dropdown language header
    var $dropdownHeaderTime = 400;
    $('#btn-language-header').click(function(event) {
        event.preventDefault();
        $(this).toggleClass('active');
        $('#language-header').slideToggle($dropdownHeaderTime);
    });   

    // Dropdown language header
    var $dropdownFooterTime = 400;
    $('#btn-language-footer').click(function(event) {
        event.preventDefault();
        $(this).toggleClass('active');
        $('#language-footer').slideToggle($dropdownFooterTime);
    });            
        
    // Click en el documento    
    $(document).on('click', function(e) {
        // Header menu close
        if (!$(e.target).is('.js-btn-hamburger')) {
            if (!$(e.target).is('.header .header__menu, .header .header__menu *')) {
                $('.js-btn-hamburger').removeClass('active');
                $('body').removeClass('body-menu--open');
                $('.js-header__menu').removeClass('header__menu--open');
                $('#language-header').slideUp($dropdownHeaderTime);
            }
        }
    });

    // Submit form on order change
    $('.js-order').change(function(){
        $(this).parents('form').submit();
    });

});
