$(document).ready(function(){var i=$("#podcast-audio")[0];function o(a){console.log("\n\nEvent: "+a.type);var o=0;if("input"==a.type&&(o=i.duration*parseInt($(".bar").val())/100,i.currentTime=o),"timeupdate"==a.type){o=i.currentTime;var e=$(".rangeslider").width(),t=i.currentTime/i.duration,n=e*t;console.log("rangeSliderWidth",e),console.log("audioPercent",t),console.log("sliderPos",n),$(".rangeslider__handle").css({display:"none"}),$(".rangeslider__fill").css({width:n}),console.log("Percentage played: "+t)}console.log("tempCurrentTime: "+o);var l=Math.floor(o/60),s=Math.floor(o%60);s<10&&(s="0"+s),$("#status").text(l+":"+s)}$(".bar").rangeslider({polyfill:!1,onInit:function(){$(".rangeslider__fill").css({width:"0px"})}}),$(document).on("input",".bar",function(a){o(a)}),$("#podcast-audio").on("timeupdate",function(a){o(a)}),history.replaceState(null,"","#home");var s=!1;function r(){s=!0,$("#podcast-audio").get(0).play(),$(".podcast_play").children("i").removeClass("fa fa-play").addClass("fa fa-pause")}$(".play").on("click",function(a){a.preventDefault();var o=$(this).data("podcast-id"),e=window.location.href,l=e.substr(e.indexOf("media"));console.log("path",e),console.log("podcast "+o),$.ajax({type:"post",dataType:"json",url:"/wp-admin/admin-ajax.php",data:{action:"contactAjax",data:o},success:function(a){console.log(a);var o=a.url,e=(a.duration,a.name),t=a.title,n=o.substr(o.indexOf("media"));console.log("urlPodcast",l),console.log("urlHash "+n),history.replaceState(null,"","#podcast="+o),n!=l||0==s?($(".podcast-audio").attr("src",o),r(),$(".podcast_name").children("p").text(e+" - "+t)):console.log("mesma faixa")},error:function(a){alert("error"),console.log(a)}})}),$(".podcast_play").on("click",function(a){a.preventDefault(),console.log("apertei"),s?(s=!1,$("#podcast-audio").get(0).pause(),$(".podcast_play").children("i").removeClass("fa fa-pause").addClass("fa fa-play")):r(),console.log("isPlaying",s)})});