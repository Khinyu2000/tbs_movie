$(function(){
	var swiper = new Swiper('.swiper-container.sn-sub-nav-container', {
	  slidesPerView: 'auto',
	  freeMode: true,
	});

	if($(document).height() === $(window).height()){
       $('.wp-general-buttons a span').addClass('show-button');
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
