$(document).ready(function() {
    $('.owl-carousel').owlCarousel({
        loop:true,  
        dots:true,
        autoplay:true,
        lazyLoad:true,
        dotsEach: true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    })
});