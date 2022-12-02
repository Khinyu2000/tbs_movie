$(function(){
  var swiper = new Swiper('.swiper-container.wp-short-video-detail-container', {
      slidesPerGroup: 1,
      loop: false,
      keyboard: {
        enabled: false,
      },
      speed: 500,
    autoplay: {
    delay: 3000,
    disableOnInteraction: false,
    },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        0: {
          slidesPerView: 3,
          spaceBetween: 15,
        },
        480: {
          slidesPerView: 6,
          spaceBetween: 15,
        },
        960: {
          slidesPerView: 9,
          spaceBetween: 25,
        },
      }
    });

  /*$(window).scroll(function(){
    var general = $('.wp-general-container').height();
      if($(this).scrollTop() == ('.wp-general-container').  outerHeight()){
        $('.wp-general-buttons a span').css('bottom', '0');
        alert(general);
      }else{
        $('.wp-general-buttons a span').css('bottom', '-100%');
      }

    });*/
    if($(document).height() === $(window).height()){
       $('.wp-general-buttons a span').addClass('show-button');
    }else{
      $('.wp-general-buttons a span').removeClass('show-button');
    }
    $(window).on("scroll", function() {
      var scrollHeight = $(document).height();
      var scrollPosition = $(window).height() + $(window).scrollTop();
      if (scrollHeight - scrollPosition <= 10) {
        $('.wp-general-buttons a span').addClass('show-button');
      }else{
        $('.wp-general-buttons a span').removeClass('show-button');
      }
    });
});