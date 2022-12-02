$(window).on('load', function() {
$(".triple-spinner").fadeOut("slow");;
});
$(document).ready(function() {
  $('.ky-movie-tabs ul, .ky-series-tabs ul').on('click','li', function() {
    let $id=$(this).attr('id');
    $('.'+$id+'-content').show();
    $('.'+$id+'-content').siblings().hide();
    $(this).addClass('selected');
    $(this).siblings().removeClass('selected');
  });

  $('.ky-movie-tabs-content, .ky-series-tabs-content').children().not(":first-child").hide();

  var swiper = new Swiper('.swiper-container.series-related-video-details-container,.swiper-container.movie-related-video-details-container', {
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
            slidesPerView: 5,
            spaceBetween: 20,
          },
          960: {
            slidesPerView: 8,
            spaceBetween: 25,
          },
        }
      });

});
