/**
 * Promo video
 */
var frontPagePromoVideoPlayer;
jQuery(function () {
    frontPagePromoVideoPlayer = jQuery("#promo-video-player").YTPlayer({
        playOnlyIfVisible: true,
        useOnMobile:false, 
        showControls:false,
        autoPlay:true,
        loop:true,
        mute:true,
        opacity:1,
        addRaster:true,
        quality:'default',
        optimizeDisplay:true,
        addFilters: {opacity: 80}
    });
});


/**
 * Promo video
 */
var frontPageAttractionsVideoPlayer = false;
jQuery(function () {
    frontPageAttractionsVideoPlayer = jQuery(".attractions-video-player").YTPlayer({playOnlyIfVisible: true});
});

/**
 * Attractions slider
 */
$(document).ready(function(){
    var owl = $(".attractions-list").owlCarousel({
        items: 1,
        animateOut: 'fadeOut',
        video: true,
        dotsContainer: '.attractions-list-dots'
    });
    $('.attraction-dot').click(function () {
        owl.trigger('to.owl.carousel', [
            $(this).index(), 300
        ]);
    });
    jQuery(".bgndVideo-0").YTPPlay();
    owl.on('change.owl.carousel', function(event) {
        if ($('#attraction-item-event.item.index').hasClass("video-item" )) {
            jQuery(".bgndVideo-" + event.item.index).YTPPause();
        }
    });
    owl.on('changed.owl.carousel', function(event) {
        if ($('#attraction-item-event.item.index').hasClass("video-item" )) {
            jQuery(".bgndVideo-" + event.item.index).YTPPlay();
        }
    });
});