
/** Change text in title */
document.addEventListener('DOMContentLoaded', function() {
    if(document.getElementById('title-strings') === null) return false;

    var typed = new Typed("#title-strings", {
        stringsElement: "#typed-title-strings",
        startDelay: 0,
        backDelay: 4000,
        loop: true,
        loopCount: Infinity,
        typeSpeed: 40,
        backSpeed: 40,
        cursorChar: '_',
        smartBackspace : false,
        shuffle : false,
        contentType : null,
    });
});

jQuery(document).ready(function(){
    /** Yandex map */
    $(function ($) {
        if ($(".social-box--vk").length <= 0) return false;
        var loadedWidget = false;
        $(window).on('scroll', function() {
            var socialBox = $(".social-box--vk"),
                socialBoxPostition = socialBox.offset();
            if ($(document).scrollTop() > socialBoxPostition.top - $(window).height() * 2) {
                if ( ! loadedWidget) {
                    var data = {
                        'action': 'widget_vk',
                    };
                    $.ajax({
                        url : ajax.url,
                        data : data,
                        type : 'POST',
                        beforeSend : function ( xhr ) {
                            socialBox.text('Загрузка...');
                        },
                        success : function( data ){
                            if( data ) { 
                                socialBox.html(data);
                                setTimeout(function(){  vk_widget_init(); }, 500);
                            }
                        }
                    });
                    loadedWidget = true;
                }
            }
        });
    });


    /**
     * Yandex map
     */
    // $(function ($) {
    //     if ($("#map").length <= 0) {
    //         return false;
    //     }
    //     ymaps.ready(init);
    //     function init(){
    //         var parkBallonsArray = JSON.parse(parkBallons);
    //         // console.log(parkBallonsArray);
    //
    //         mapContact = new ymaps.Map("map", {
    //             center: parkBallonsArray[0].center,
    //             zoom: 17,
    //             controls: ['zoomControl']
    //         });
    //         mapContact.behaviors.disable('scrollZoom');
    //
    //         parkBallonsArray.forEach(function(element, index, array) {
    //             ballon = new ymaps.Placemark(element.position, {
    //                 hintContent: element.title
    //             }, {
    //                 iconLayout: 'default#image',
    //                 iconImageHref: element.ballon,
    //                 iconImageSize: [79, 110], // Размер
    //                 // iconImageOffset: [X, Y] // Смещение
    //             });
    //             mapContact.geoObjects.add(ballon);
    //         });
    //     }
    // });


    /** Sticky menu */
    $(function ($) {
        if ($(".site-header").length === 0 && $(".promo").length === 0) {
            return false;
        }
        var promo = $(".promo"), header = $(".site-header");
        $(window).on('scroll resize load', function (event) {
            var promoHeight = promo.outerHeight(),
                headerHeight = header.outerHeight();
            if($(window).scrollTop() >= (promoHeight-headerHeight-10) ) {
                header.addClass('site-header--sticky');
                header.slideDown();
            } else {
                header.removeClass('site-header--sticky');
            }
        });

    });

    /** Scroll to element in header */
    $(function ($) {
        if ($(".header-nav").length === 0) return false;

        /** Documentation : https://github.com/cferdinandi/smooth-scroll */
        var scroll = new SmoothScroll('[data-scroll]', {
            topOnEmptyHash: true,
            header: '.site-header',
            speed: 200
        });
    });
    $(function ($) {
        if ($(".read-more-text").length === 0) return false;
        new Readmore(".read-more-text", {
           speed: 75,
           collapsedHeight: 300,
           moreLink: '<div style="text-align:center"><a href="#" class="read-more-link fs-16">Развернуть описание</a></div>',
           lessLink: '<div style="text-align:center"><a href="#" class="read-more-link fs-16">Свернуть описание</a></div>'
        });
    });
   
    /** Mask tel */
    $(function ($) {
        $('.wpcf7-tel').mask("+7(000) 00 00 000", {placeholder: "+7(___) __ __ ___"});
    })

    /** Contact form your age */
    $(function ($) {
        $('.wpcf7-select[name="your-age"]').selectize({
            closeAfterSelect: true,
            hideSelected    : true,
            openOnFocus     : true,
            placeholder: "Возраст именинника",
            create: true,
            sortField: {field: 'id'}
        });
    })

    $(function () {
        $('.wpcf7-form-control-wrap .your-date').datepicker({
            autoClose: true,
            dateFormat: "dd.mm.yyyy"
        })
    })

    /** Promo mobile slider */
    $(document).ready(function(){
        $(".slider-mobile-promo").owlCarousel({
            items: 1,
            dots: true,
            loop: true,
        });
    });

    /** Promotion slider */
    $(function () {
        if ($(".promotions-slider").length <= 0) return;
        $('.promotions-slider').owlCarousel({
            loop: false,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                600: {
                    items: 1,
                    nav: false
                },
                1000: {
                    items: 2,
                    nav: false,
                }
            }
        });
        // $('.promotion-item').on('click', function() {
        //     var key = $(this).data('promotion-id');
        //     console.log(key);
        //     var promotionPopup = $('#popup-promotion-' + key);
        //     promotionPopup.show();
        //     // $('html, body').addClass('noscroll');
        // })
        // $('.fixed-overlay .close').on('click', function(){
        //     $('.fixed-overlay').hide();
        //     $('html, body').removeClass('noscroll');
        // });
    });


    /** Promo mobile slider */
    $(document).ready(function(){
        $('.program-slider-mobile').owlCarousel({
            dots: true,
            items: 1,
            loop: true,
            nav: false,
            smartSpeed: 350
        });
    });

    $(document).ready(function(){
        var gallerySlider = $('.program-gallery-slider').owlCarousel({
            dots: true,
            items: 1,
            loop: true,
            nav: false,
            smartSpeed: 350,
            autoplayTimeout: 2500,
            responsive: {
                0 : {
                    autoplay: true,
                    autoplayHoverPause: false,
                    touchDrag: false,
                    mouseDrag: false,
                },
                768 : {
                    autoplay: false,
                    mouseDrag: true,
                }
            }
        });
        $(function() {
            if ($('.program-box').length <= 0) return;
            
            $('.program-box').mouseenter(function() {
                $(this).find('.program-gallery-slider').trigger('next.owl.carousel');
                $(this).find('.program-gallery-slider').trigger('play.owl.autoplay');
            }).mouseleave(function() {
                $(this).find('.program-gallery-slider').trigger('stop.owl.autoplay');
            });
        });
    });

    $(document).ready(function(){
        $('.program-gallery-slider-one').owlCarousel({
            items: 1,
            loop: false,
            nav: false,
            dots: false,
            smartSpeed: 350,
            autoHeight:true
        });
        $('.program-gallery-thumbnails .item').click(function(){
            var number = $(this).data('number');
            $('.program-gallery-slider-one').trigger('to.owl.carousel', number);
        });
    });

    /* Scroll top */
    $(function () {
        var btnScrollTop = $('#scroll-top'),
            btnStatus = 0;

        $(window).on('load resize scroll', function(event) {
            event.preventDefault();
            if ($(window).scrollTop() > 600) {
                if (btnStatus === 0) {
                    btnScrollTop.animate({
                        'bottom' : '2vh'
                    }, 500);
                }
                btnStatus = 1;
            } else {
                if (btnScrollTop.css('bottom') === '50px') {
                    btnScrollTop.animate({
                        'bottom' : '-200px'
                    }, 500);
                } else {
                    btnScrollTop.css('bottom', '-200px');
                }
                btnStatus = 0;
            }
        });

        btnScrollTop.on('click', function(event) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: 0
            }, 600);
            $(this).stop().animate({
                'bottom' : $(window).outerHeight()
            }, 600, function () {
                $(this).css('bottom', '-200px');
            });
        });
    });

    /** Mobile menu */
    $(function() {
        if($('.mobile-menu').length === 0) return false;

        var button = $('.hamburger'),
            mobileMenu = $('.mobile-menu'),
            overlay = $('.overlay-mobile-menu'),
            body = $('html, body');

        button.on('click', function(event) {
            toggleMenu();
        });
        overlay.on('click', function(event) {
            closeMenu();
        });
        $(window).on('load resize', function(event) {
            if ($(this).outerWidth() <= 1200) {
                closeMenu();
            }
        });

        $('.mobile-menu .header-nav .item').on('click', function (event) { closeMenu(); });

        function toggleMenu() {
            button.toggleClass('is-active');
            mobileMenu.toggleClass('is-active');
            overlay.toggleClass('is-active');
            body.toggleClass('noscroll');
        }
        function closeMenu() {
            button.removeClass('is-active');
            mobileMenu.removeClass('is-active');
            overlay.removeClass('is-active');
            body.removeClass('noscroll');
        }
    });

    $(function() {
        $(window).on('load resize', function(event) {
            if ($(this).outerWidth() >= 992) {
                $('.social-box').matchHeight({});
            } else {
                $('.social-box').matchHeight({
                    remove: true
                });
            }
        });
    })
    /** Attraction popups */
    $(function() {
        if($('.attraction-dot, .attraction-popup').length === 0) {
            return false;
        }
        /** Set default popup */
        var activeDotId = $('.attraction-dot.active').data('attraction-button-id');
        $("#attraction-popup-id-" + activeDotId).addClass('active');

        $('.attraction-popup .close').on('click', function(){
            $('.attraction-popup').removeClass('active');
        })
        $('.attraction-dot').on('click', function(){
            $('.attraction-popup').removeClass('active');
            var activeDotId = $(this).data('attraction-button-id');
            $("#attraction-popup-id-" + activeDotId).addClass('active');
        })
    })
    /** Program popups */
    $(function() {
        if($('.program-popup, .program-box').length === 0) {
            return false;
        }

        /** Set default popup */
        var buttons = $('.program-box .button');

        buttons.on('click', function () {
            var programId = $(this).data('program-id');
            var programPopup = $('#program-popup-' + programId);
            programPopup.show();
            $('html, body').addClass('noscroll');
        });

        $('.fixed-overlay .close').on('click', function(){
            $('.fixed-overlay').hide();
            $('html, body').removeClass('noscroll');
        });

    })
    /** Program popups */
    $(function() {
        if($('.auto-calculated-price-program').length === 0) {
            return false;
        }

        $('.programs .program-box').each(function() {
            var programId = $(this).data('program-box-id');
            /** Get program price */
            var priceProgram = calculatorVue.getPriceProgramById(programId);
            /** Render price */
            $(this).find('.auto-calculated-price-program .cost').text(priceProgram);
        })
    })


    $(function() {
        if($('.slider-mobile-instagram').length === 0) {
            return false;
        }
        var owl = $('.slider-mobile-instagram');
        owl.owlCarousel({
            loop: false,
            margin: 2,
            responsive: {
                0: {
                    items: 1
                },
                1200: {
                    items: 2
                },
                1300: {
                    items: 3
                },
            }
        });
    });

    /** Contact tab */
    $(function() {
        if($('.park-anchors, .park-boxes').length === 0) {
            return false;
        }
        
        var park_anchor = $('.park-anchors .anchor-name'),
            park_box = $('.park-boxes .contact-park');
        
        park_anchor.on('click', function() {
            event.preventDefault();
            if ( ! $(this).hasClass('active')) {
                var park_id = $(this).data('park-id');

                park_anchor.removeClass('active');
                park_box.removeClass('active');

                $(this).addClass('active');
                $('#contact-park-'+park_id).addClass('active');

                var lat = $('#contact-park-'+park_id).data('pos-lat'),
                    lng = $('#contact-park-'+park_id).data('pos-lng'),
                    pos = [lat,lng];

                mapContact.panTo(pos, {});
            }
        });
    });

    /** program parks */
    $(function() {
        if($('.open-select-parks').length === 0) {
            return false;
        }
        
        var parks_anchor = $('.open-select-parks'),
            parks_box = $('.select-parks');

        parks_anchor.on('click', function() {
            event.preventDefault();
            if ( parks_box.hasClass('active')) {
                parks_box.removeClass('active');
            } else {
                parks_box.addClass('active');
            }
        });
    });

    $(function() {
        if($('.select-parks').length === 0) {
            return false;
        }
        
        var park_anchor = $('.program-box .select-parks div'),
            park_box = $('.program-box .feature');

        park_anchor.on('click', function() {
            event.preventDefault();
            var park_id = $(this).data('park-id');

            $('.select-parks').removeClass('active');
            $(this).closest('.program-box').find('.feature').removeClass('active');

            // $(this).addClass('active');
            $('#feature-id-'+park_id).addClass('active');
        });
    });

    /** Read more on programs */
    // $(function() {
    //     if($('.read-more-program-features').length === 0) {
    //         return false;
    //     }
        
    //     new Readmore(".read-more-program-features", {
    //         speed: 135,
    //         collapsedHeight: 330,
    //         moreLink: '<div style="text-align:center"><a href="#" class="read-more-link fs-20">Развернуть описание</a></div>',
    //         lessLink: '<div style="text-align:center"><a href="#" class="read-more-link fs-20">Свернуть описание</a></div>'
    //      });
    // })

    /** Default popups */
    MicroModal.init({
        onShow: modal => {
            // console.info(`${modal.id} is shown`);
            $('html, body').addClass('noscroll');
        },
        onClose: modal => {
            // console.info(`${modal.id} is shown`);
            $('html, body').removeClass('noscroll');
        },
    });

    /** FAQ */
    $(function() {
        if($('.faq-item').length === 0) {
            return false;
        }

        const question = $('.faq-item .faq_question'),
            answer = $('.faq-item .faq_answer');

        question.on('click', function() {
            $('.faq-item').removeClass('active')
            $(this).parent().addClass('active');
        });
    });

    /** Contact form 7 */
/*    $(function () {
        if($('.modal.get-program').length === 0) return false;
        $(".get-program .wpcf7-submit").on('click', function(event){
            var programNameField = $(this).closest('.get-program').find('input[name="program-name"]'),
                programNameData = $(this).closest('.get-program').data('program-name'),
                tortField = $(this).closest('.get-program').find('input[name="add-tort"]'),
                tortFieldText = '';

            tortFieldText = tortField.is(":checked") ? 'ДА (Хочу тортик)' : 'НЕТ (торт не нужен)';
            /!** Add Values *!/
            programNameField.val(programNameData);
            tortField.val(tortFieldText)
        });
    })
    // wpcf7mailsent
    $('.wpcf7').on('wpcf7mailsent', function (event) {
        if ($(this).closest('.micromodal-slide').length <= 0) return;
        var modalId = $(this).closest('.micromodal-slide')[0].id;
        MicroModal.close(modalId);
        MicroModal.show('thank-you');
    });*/

    /**  Videos START */

    /** Program promo-video */
    $(function() {
        if($('#cpt-promo-video').length === 0) return false;

        var options = {
            url: programVideoUrl, //programVideoUrl - from program page (global)
            autoplay: true,
            loop:1,
            muted: true,
            background: true,
            byline: false,
            title: false,
            portrait: false
        };
        
        var videoPlayer = new Vimeo.Player('cpt-promo-video', options);
        
        videoPlayer.on('play', function() {
            // console.log('Played the video');
        });

    });
    /** Program promo-video */
    $(function() {
        if($('#front-promo-video').length === 0) return false;
        
        var options = {
            url: promoVideoUrl, //promoVideoUrl - from promo
            autoplay: true,
            loop:1,
            muted: true,
            controls: false,
            background: true,
            byline: false,
            title: false,
            portrait: false
        };
        
        var videoPlayer = new Vimeo.Player('front-promo-video', options);
        // console.log(videoPlayer);
        
        $(window).on('scroll resize', function () {
            var promoBlock = $('.site-main>.promo'),
                promoHeight = promoBlock.outerHeight(),
                promoPosition = promoBlock.position();
            
            if ($(this).scrollTop() >= promoPosition.top + promoHeight) {
                videoPlayer.pause();
            } else {
                videoPlayer.play();
            }
        });
    });
    
    /** Attractions slider */
    $(function() {
        if ($(".attractions-list").length <= 0) return;
        if ( ! IsJsonString(attractionsVideo)) return;

        var attractionsObj = JSON.parse(attractionsVideo);
        var videoPlayers = [];

        Object.keys(attractionsObj).forEach(function (index) {
            var options = {
                url: attractionsObj[index], //promoVideoUrl - from promo
                autoplay: false,
                loop:1,
                muted: true,
                controls: false,
                background: true,
                byline: false,
                title: false,
                portrait: false
            };
            videoPlayers[index] = new Vimeo.Player('bgndVideo-'+index, options);
            videoPlayers[index].on('play', function() {
                // console.log('Played the video - ' + index);
            });
            videoPlayers[index].on('pause', function() {
                // console.log('Stop the video - ' + index);
            });
        });
        
        var owl = $(".attractions-list").owlCarousel({
            items: 1,
            animateOut: 'fadeOut',
            video: true,
            dotsContainer: '.attractions-list-dots'
        });
        $('.attraction-dot').click(function () {
            owl.trigger('to.owl.carousel', [
                $(this).index(), 
                300
            ]);
        });

        owl.on('changed.owl.carousel', function(event) {
            if ($('.attraction-item').hasClass("video-item" )) {
                videoPlayers[event.item.index].play();
            }
        });

        /** Load first video */
        $(window).on('scroll resize', function () {
            var block = $('#attractions'),
                blockPosition = block.position(),
                windowHeight = $(this).outerHeight();
            
            if ($(this).scrollTop() >= blockPosition.top - windowHeight) {
                if ($('.owl-item.active .attraction-item.video-item').length > 0) {
                    var videoId = $('.owl-item.active .attraction-item.video-item').data('video-id');
                    // console.log(videoId);
                    
                    if (videoPlayers[videoId].getPaused()) {
                        videoPlayers[videoId].play();
                    }
                }
            }
        });
    });
});


function IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}
    
