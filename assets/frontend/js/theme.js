; (function ($) {
    "use strict";
    

    var nav_offset_top = $('header').height();
    /*-------------------------------------------------------------------------------
	  Navbar 
	-------------------------------------------------------------------------------*/

    //* Navbar Fixed  
    function navbarFixed() {
        if ($('.main_menu_area').length) {
            $(window).scroll(function () {
                var scroll = $(window).scrollTop();
                if (scroll >= nav_offset_top) {
                    $(".main_menu_area").addClass("navbar_fixed");
                } else {
                    $(".main_menu_area").removeClass("navbar_fixed");
                }
            });
        };
    };
    navbarFixed();




    /*----------------------------------------------------*/
    /*  Main Slider js
    /*----------------------------------------------------*/
    function main_slider() {
        if ($('#home_slider').length) {
            $("#home_slider").revolution({
                sliderType: "standard",
                sliderLayout: "auto",
                delay: 10000,
                disableProgressBar: "on",
                navigation: {
                    onHoverStop: 'off',
                    touch: {
                        touchenabled: "on"
                    },
                    arrows: {
                        style: "zeus",
                        enable: true,
                        hide_onmobile: true,
                        hide_under: 767,
                        hide_onleave: true,
                        hide_delay: 200,
                        hide_delay_mobile: 1200,
                        tmp: '<div class="tp-title-wrap">  	<div class="tp-arr-imgholder"></div> </div>',
                        left: {
                            h_align: "left",
                            v_align: "center",
                            h_offset: 20,
                            v_offset: 0
                        },
                        right: {
                            h_align: "right",
                            v_align: "center",
                            h_offset: 20,
                            v_offset: 0
                        }
                    },
                },
                responsiveLevels: [4096, 1320, 1199, 992, 767, 480, 330],
                gridwidth: [1170, 1170, 960, 720, 700, 300, 300],
                gridheight: [550, 550, 500, 500, 500, 500, 450],
                lazyType: "smart",
                fallbacks: {
                    simplifyAll: "off",
                    nextSlideOnWindowFocus: "off",
                    disableFocusListener: false,
                }
            })
        }
    }
    main_slider();


    /*----------------------------------------------------*/
    /*  Skill Slider
    /*----------------------------------------------------*/
    function progressBarConfig() {
        var progressBar = $('.progress');
        if (progressBar.length) {
            progressBar.each(function () {
                var Self = $(this);
                Self.appear(function () {
                    var progressValue = Self.data('value');

                    Self.find('.progress-bar').animate({
                        width: progressValue + '%'
                    }, 1000);

                    Self.find('.number').countTo({
                        from: 0,
                        to: progressValue,
                        speed: 1000
                    });
                });
            })
        }
    }
    progressBarConfig();

    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });


    $(document).ready(function () {
        $('#HS1to, .nice_select, .product_select').niceSelect();
    });


    /*----------------------------------------------------*/
    /*  Bitcoin Hover Slider
    /*----------------------------------------------------*/
    $('.gain_coin_item').hover(function () {
        $(this).closest('.gain_coin_inner').find('.g_coin_r_item[data-rel="' + $(this).attr('data-rel') + '"]').addClass('visible');
    }, function () {
        $('.g_coin_r_item.visible').removeClass('visible');
    });


    /*----------------------------------------------------*/
    /*  Clients Slider
    /*----------------------------------------------------*/
    var owl2 = $("#statics-slider");
    owl2.owlCarousel({
        autoplay: !0,
        autoplayTimeout: 0,
        autoplayHoverPause: !0,
        autoplaySpeed: 8e3,
        navRewind: !1,
        loop: !0,
        items: 8,
        margin: 30,
        dots: !0,
        nav: !1,
        responsiveClass: !0,
        responsive: {
            0: {
                items: 2,
            },
            480: {
                items: 2,
            },
            768: {
                items: 4,
            },
            992: {
                items: 5,
            },
            1280: {
                items: 6,
            },
            1440: {
                items: 8,
            }
        }
    }

    );

    //clients_slider();
    /*----------------------------------------------------*/
    /*  Clients Slider
    /*----------------------------------------------------*/
    function team_slider() {
        if ($('.team_slider').length) {
            $('.team_slider').owlCarousel({
                loop: true,
                margin: 100,
                items: 4,
                nav: false,
                autoplay: false,
                smartSpeed: 1500,
                dots: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                    },
                    480: {
                        items: 2,
                        margin: 30,
                    },
                    768: {
                        items: 3,
                        margin: 60,
                    },
                    1200: {
                        items: 4,
                    }
                }
            })
        }
    }
    team_slider();

    /*----------------------------------------------------*/
    /*  Clients Slider
    /*----------------------------------------------------*/
    function testi_slider() {
        if ($('.testi_slider').length) {
            $('.testi_slider').owlCarousel({
                loop: true,
                margin: 0,
                items: 1,
                nav: false,
                autoplay: true,
                smartSpeed: 1500,
                dots: true,
            })
        }
    }
    testi_slider();

    //(function (b, i, t, C, O, I, N) {
    //    window.addEventListener('load', function () {
    //        if (b.getElementById(C)) return;
    //        I = b.createElement(i), N = b.getElementsByTagName(i)[0];
    //        I.src = t; I.id = C; N.parentNode.insertBefore(I, N);
    //    }, false)
    //})(document, 'script', 'https://widgets.bitcoin.com/widget.js', 'btcwdgt');


    /*----------------------------------------------------*/
    /*  Preloader
    /*----------------------------------------------------*/
    
    
    $(window).on('load', function () {
        $('.preloader').addClass('complete');
        setTimeout(
            function () {
                $('.preloader').fadeOut('slow')
            }, 2100
        );
    });
	
	if (screen.width < 1300) {
		$("#viewport").attr("content", "width=1300");
	}else{
		$("#viewport").attr("content", "width=device-width, initial-scale=1,shrink-to-fit=no");
	}
})(jQuery)




