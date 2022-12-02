
//----------For Search----------//
var left = new TimelineMax ();

left.from($("#rect"),2,{width:0},1)
.from($("#rect"),2,{left:400},1)
//.to($("#copy"),0.05,{autoAlpha:0, repeat:5, yoyo:true}

function mySearch() {
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementById('myInput');
  filter = input.value.toUpperCase();
  ul = document.getElementById("myUL");
  li = ul.getElementsByTagName('li');
  ul.style.display = "block";
if(document.getElementById("myInput").value){
   for (i = 0; i < li.length; i++) {
    a = li[i].getElementsByTagName("a")[0];
    txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) >= 0) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}else{
 ul.style.display = "none";
}
$(document).click(function(){
  document.getElementById("myUL").style.display = "none";
  document.getElementById("myInput").value = "";
});
}

//----------Get Search Data ----------//
$(document).ready(function(){
  $.get( PAGE_URL + '/general/search_data/').done(function(e){
    if(e)
      $('#myUL').append(e);
  });
});

//----------For Navigation Animation----------//
$('#sn-menu-toggle').click(function(){
  $(this).toggleClass('open');
  $('.sn-nav-list').toggleClass('hide');
  $('.sn-header-logo').toggleClass('low-opacity');
  $('.sn-search-wrap').toggleClass('low-opacity');
})


//----------For Search Animation----------//
$('.fa-search').click(function(){
  $('.sn-search-wrap input').addClass('sn-search-wrap-anm');
  $('.fa-search').hide();
  $('.fa-times').show();
  $('#myInput').focus();
});

$('.fa-times').click(function(){
  $('.sn-search-wrap input').removeClass('sn-search-wrap-anm');
  $('.fa-search').show();
  $('.fa-times').hide();
});
//----------For Sub Navigation Show List----------//
$('.sn-movies i').click(function(){
  $('.sn-movies-sub-list').toggleClass('sn-padding');
  $('.sn-movies .fa-sort-up').toggleClass('show');
  $('.sn-movies .fa-sort-down').toggleClass('sn-border');
  $('.sn-movies .fa-sort-down').toggleClass('hide');
  $('.sn-movies-sub-list').toggleClass('sn-height');
});
$('.sn-series i').click(function(){
  $('.sn-series-sub-list').toggleClass('sn-padding');
  $('.sn-series .fa-sort-up').toggleClass('show');
  $('.sn-series .fa-sort-down').toggleClass('sn-border');
  $('.sn-series .fa-sort-down').toggleClass('hide');
  $('.sn-series-sub-list').toggleClass('sn-height');
});
