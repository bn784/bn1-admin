$(document).ready(function(){

  $('#Toggle_Sidebar').click( function() {
    var toggleWidth =  $('#section_sidebar').css("margin-left");
    if (toggleWidth == '0px') {
      $('#section_sidebar').css("margin-left", "-250px");
      $('#section_content').css("margin-left", "0px");
    } else {
      $('#section_sidebar').css("margin-left", "0px");
      $('#section_content').css("margin-left", "250px");
    }
  });
  //
  $('.dropdown .test').on("click", function(e){
    $(this).next('div').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
  //
  var h = $('nav').height() + 15;
  $('body').animate({ paddingTop: h });
});