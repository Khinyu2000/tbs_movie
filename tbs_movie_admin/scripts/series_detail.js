$(document).ready(function() {
  $('#ky-unicode-tab').on('click', function() {
    $('.ky-unicode-description').addClass("active").siblings().removeClass("active");
    $('#ky-description-indicator').css({"transform" : "translateX(0px)", "transition" : "0.2s ease"});
  });

  $('#ky-zawgyi-tab').on('click', function() {
    $('.ky-zawgyi-description').addClass("active").siblings().removeClass("active");
    $('#ky-description-indicator').css({"transform" : "translateX(77px)", "transition" : "0.2s ease"});
  });

  $('.ky-form-edit-icon').on('click', function() {
    editTranslation($('.ky-series-info-container'), $('.ky-series-form-container'));
    $('.ky-item-info-edit-form-container input').first().focus();
  });

  $('.ky-item-save-button, .ky-item-cancel-button').on('click', function() {
    editFinishedTranslation($('.ky-series-form-container'), $('.ky-series-info-container'));
  });

  $('#ky-series-add-icon').on('click', function() {
    $('.ky-series-episodes').css({"height" : "73%",
                                  "transition" : "all 0.3s"});
    $('.ky-episodes-add-form').slideDown('quick');
  });

  $('.ky-episodes-add-form .fa-creative-commons-nd, .ky-episodes-add-form .fa-times-circle').on('click', function() {
    $('.ky-series-episodes').css({"height" : "91.7%",
                                  "transition" : "all 0.8s"});
    $('.ky-episodes-add-form').slideUp('quick');
  });

  $('.ky-episodes-edit-icon').on('click', function() {
    $(this).parent().next().slideDown('quick');
  });

  $('.ky-episodes-edit-form .fa-creative-commons-nd, .ky-episodes-edit-form .fa-times-circle').on('click', function() {
    $(this).parent().parent().parent().parent().slideUp('quick');
  });

  $('#ky-series-image-edit').on('click', function() {
    $('#ky-series-image').click();
  });

  $('#ky-series-image').change(function() {
    if(this.files && this.files[0]) {
      var reader=new FileReader();
      reader.onload=function(e) {
        $(".ky-series-image img").attr('src', e.target.result);
      }
      reader.readAsDataURL(this.files[0]);
    }

    $('.ky-series-image form div:nth-child(2)').fadeIn("1000");
  });

  let $current_image=$('.ky-series-image img').attr('src');
  $('.ky-series-image form > div:nth-child(2) > span').on('click', function() {
    $('.ky-series-image img').attr('src', $current_image);
  });

  $('.ky-series-image form > div:nth-child(2) > button, .ky-series-image form > div:nth-child(2) > span').on('click', function() {
    $('.ky-series-image form div:nth-child(2)').fadeOut("1000");
  });

  let rate=$('#imdb-rate').val();
  const basedRate=10;
  const starPercentage=(rate/basedRate)*100 + '%';
  $('.stars-inner').css({"width" : starPercentage });

  $('.ky-movies-info-edit-form-container form input, .ky-movies-info-edit-form-container form textarea').on('focus active', function() {
    $(this).prev().css({"color" : "#f84841cc"});
  });

  $('.ky-movies-info-edit-form-container form input, .ky-movies-info-edit-form-container form textarea').on('blur', function() {
    $(this).prev().css({"color" : "#222"});
  });

});

function editTranslation($obj1, $obj2) {
  $obj1.css({"transform" : "translateX(100%)", "pointer-events" : "none"});
  $obj2.css({"transform" : "translateX(0%)", "pointer-events" : "auto"});
}
function editFinishedTranslation($obj1, $obj2) {
  $obj1.css({"transform" : "translateX(-100%)", "pointer-events" : "none"});
  $obj2.css({"transform" : "translateX(0%)", "pointer-events" : "auto"});
}
