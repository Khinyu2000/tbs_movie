var deleteItemsTemp = [];
$(document).ready(function(){
  $(window).scroll(function(){
    if($(this).scrollTop() > 51){
      $('.ssn-cat-sidebar').addClass('ssn-cat-sidebar-sticky');
    }else{
      $('.ssn-cat-sidebar').removeClass('ssn-cat-sidebar-sticky');
    }
  });
});
function AddCat(){
  $("#Catinput :input").css({
    "border-bottom":"1px solid #ccc",
    "display":"block"
  });
  $("#Catinput input").focus();
  $(".ssn-ok").css("display", "inline-block");
  $(".ssn-cancel").css("display", "block");
}
function CancelCat(){
  $("#Catinput :input").css({
    "display":"none"
  });
  $(".ssn-ok").css("display", "none");
  $(".ssn-cancel").css("display", "none");
}
function AddItem(){
  $(".ssn-add-item-overlay").css({
    "display":"block",
    "transition":"0.5s ease"
  });
}
function CancelItem(){
  $(".ssn-add-item-overlay").css({
    "display":"none"
  });
}
function deleteAjaxQuery(id, deleteObj, action){
  $.post( PAGE_URL + action, {id: id}).done(function(e){
    if(!e)
      deleteObj.hide();
  });
}
function editCatAjaxQuery(id, name, action){
  $.post( PAGE_URL + action, {id: id, name: name});
}
function editCategory(selectObj){
  selectObj.hide();
  $('.hk-cat-save-js').show();
  $('.ssn-sub-cat-title').toggleClass('ssn-sub-cat-title-active');
  $('.ssn-sub-cat-title input').prop('disabled', false).select();
}
function saveCategory(selectObj){
  var inputObj = $('.ssn-sub-cat-title input');
  selectObj.hide();
  $('.hk-cat-edit-js').show();
  $('.ssn-sub-cat-title').toggleClass('ssn-sub-cat-title-active');
  inputObj.prop('disabled', true);
  if(confirm('Are you Sure?'))
  {
    var id = inputObj.data('id');
    var name = inputObj.val();
    var requestQuery = CAT_URL + 'edit_category/';
    editCatAjaxQuery(id, name, requestQuery);
  }
}
function editItems(selectObj){
  selectObj.hide();
  $('.hk-items-save-js').show();
  $('.hk-items-delete-js').show();
}
function saveItems(selectObj){
  selectObj.hide();
  $('.hk-items-delete-js').hide();
  $('.hk-items-edit-js').show();

  if(confirm('Are you Sure?'))
  {
    for(var i=0; i<deleteItemsTemp.length; i++)
    {
      $id = deleteItemsTemp[i].data('id');
      var requestQuery = '';
      if(CAT_URL == '/movies/')
        requestQuery = '/movies/delete_movie/';
      else if(CAT_URL == '/short_videos/')
        requestQuery = '/short_videos/delete_short_video/';
      else
        requestQuery = '/series/delete_series/';
      deleteAjaxQuery($id, deleteItemsTemp[i], requestQuery);
    }
    deleteItemsTemp = [];
  }
  else
  {
    for(var i=0; i<deleteItemsTemp.length; i++)
    {
      $id = deleteItemsTemp[i].show();
    }
    deleteItemsTemp = [];
  }
}
function preview_images(f){
  var total_file=f.length;
  for(var i=0;i<total_file;i++)
  {
    $('#ssn-image-item-preview').append("<img src='"+ URL.createObjectURL(event.target.files[i]) +"'>");
  }
}
function checkFiles(f){
  $( "#ssn-image-item-preview" ).empty();
  if(f.length>6) {
    alert("You can only upload a maximum of 6 photos");
    $('#itemimages').val('');
    }else{
     preview_images(f);
    }
 }
function mySearch(){
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

//////////////////////////////////////////////////////////////////////////////////////////
$('.ssn-add-item-button').hover(
  function(){$(this).addClass('animated pulse fast')},
  function(){$(this).removeClass('animated pulse fast')}
);
$('.ssn-cancel-item-button').hover(
  function(){$(this).addClass('animated pulse fast')},
  function(){$(this).removeClass('animated pulse fast')}
);
$('.hk-main-cat-delete-js').click(function(){
  if(confirm("All things related this category are deleted. Are you Sure?"))
  {
    var id = $(this).data('id');
    var parent = $(this).parent();
    var requestQuery = CAT_URL + 'delete_category/';
    deleteAjaxQuery(id, parent, requestQuery);
  }
});
$('.hk-cat-edit-js').click(function(){
  editCategory($(this));
});
$('.hk-cat-save-js').click(function(){
  saveCategory($(this));
});
$('.hk-items-edit-js').click(function(){
  editItems($(this));
});
$('.hk-items-save-js').click(function(){
  saveItems($(this));
});
$('.hk-items-delete-js').click(function(){
  if(confirm('Are you Sure?'))
  {
    var parent = $(this).parent();
    parent.hide();
    deleteItemsTemp[deleteItemsTemp.length] = parent;
  }
});

//
// function isEllipsisActive(element) {
//   return element.offsetWidth < element.scrollWidth;
// }
//
// Array.from(document.querySelectorAll('.ssn-item-sum'))
// .forEach(element => {
//   if (isEllipsisActive(element)) {
//     $('.ssn-item-sum').addClass('ssn-item-name');
//   }
// });
