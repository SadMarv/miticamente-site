$(document).ready(function(){for(var n=$("#navbarText").data("menu"),a=document.getElementsByClassName("nav-link"),e=a.length,l=0;l<e;l++){var t=a[l].dataset.link;n==t&&$("."+t).removeClass("nav-link__underline").addClass("nav-link__underline")}});