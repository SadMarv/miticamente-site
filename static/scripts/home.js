$(document).ready(function(){history.replaceState(null,"","#home");var n=!1;function r(){n=!0,$("#podcast-audio").get(0).play(),$(".podcast_play").children("i").removeClass("fa fa-play").addClass("fa fa-pause")}$(".play").on("click",function(a){a.preventDefault();var o=$(this).data("podcast-id"),e=window.location.href,l=e.substr(e.indexOf("media"));console.log("path",e),console.log("podcast "+o),$.ajax({type:"post",dataType:"json",url:"/wp-admin/admin-ajax.php",data:{action:"contactAjax",data:o},success:function(a){console.log(a);var o=a.url,s=(a.duration,$("#podcast-audio")[0]);function e(a){console.log("\n\nEvent: "+a.type);var o=0;if("input"==a.type&&(console.log("Slider val: "+$(".bar").val()),console.log("Audio duration: "+s.duration),o=s.duration*parseInt($(".bar").val())/100,s.currentTime=o),"timeupdate"==a.type){o=s.currentTime;var e=$(".rangeslider").width(),t=s.currentTime/s.duration,l=e*t;$(".rangeslider__fill").css({width:l+21}),console.log("Percentage played: "+t)}console.log("tempCurrentTime: "+o);var n=Math.floor(o/60),r=Math.floor(o%60);r<10&&(r="0"+r),$("#status").text(n+":"+r)}$(".bar").rangeslider({polyfill:!1}),$(document).on("input",".bar",function(a){e(a)}),$("#podcast-audio").on("timeupdate",function(a){e(a)});var t=o.substr(o.indexOf("media"));console.log("urlPodcast",l),console.log("urlHash "+t),history.replaceState(null,"","#podcast="+o),t!=l||0==n?($(".podcast-audio").attr("src",o),r()):console.log("mesma faixa")},error:function(a){alert("error"),console.log(a)}})}),$(".podcast_play").on("click",function(a){a.preventDefault(),console.log("apertei"),n?(n=!1,$("#podcast-audio").get(0).pause(),$(".podcast_play").children("i").removeClass("fa fa-pause").addClass("fa fa-play")):r(),console.log("isPlaying",n)})});