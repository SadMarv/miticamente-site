$(document).ready(function(){
  var menuSelected = $("#navbarText").data('menu');
  var href = document.getElementsByClassName('nav-link');
  var count = href.length;

  for (var index = 0; index < count; index++) {
    var element = href[index].dataset.link;
    
    if(menuSelected == element){
      $('.'+element).removeClass('nav-link__underline').addClass('nav-link__underline');
    }
  }

  
      
});

