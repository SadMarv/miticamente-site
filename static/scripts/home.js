$(document).ready(function(){var i=$("#podcast-audio")[0];function t(a){var t=0;if("input"==a.type&&(t=i.duration*parseInt($(".bar").val())/100,i.currentTime=t),"timeupdate"==a.type){t=i.currentTime;var e=($(".rangeslider").width()-$(".rangeslider__handle").width())*(i.currentTime/i.duration);$(".rangeslider__handle").css({display:"none"}),$(".rangeslider__fill").css({width:e})}var n=Math.floor(t/60),o=Math.floor(t%60);o<10&&(o="0"+o),$("#status").text(n+":"+o)}$(".bar").rangeslider({polyfill:!1,onInit:function(){$(".rangeslider__fill").css({width:"0px"})}}),$(document).on("input",".bar",function(a){t(a)}),$("#podcast-audio").on("timeupdate",function(a){t(a)}),history.replaceState(null,"","#home");var r=!1;function d(){r=!0,$("#podcast-audio").get(0).play(),$(".podcast_play").children("i").removeClass("fa fa-play").addClass("fa fa-pause")}$(".play").on("click",function(a){a.preventDefault();var t=$(this).data("podcast-id");console.log("podcastId",t);var e=window.location.href,i=e.substr(e.indexOf("media"));$.ajax({type:"post",dataType:"json",url:"/wp-admin/admin-ajax.php",data:{action:"contactAjax",data:t},success:function(a){var t=a.url,e=(a.duration,a.name),n=a.title,o=t.substr(t.indexOf("media"));history.replaceState(null,"","#podcast="+t),o==i&&0!=r||($(".podcast-audio").attr("src",t),d(),$(".podcast_name").children("p").text(e+" - "+n))},error:function(a){alert("error"),console.log(a)}})}),$(".podcast_play").on("click",function(a){a.preventDefault(),r?(r=!1,$("#podcast-audio").get(0).pause(),$(".podcast_play").children("i").removeClass("fa fa-pause").addClass("fa fa-play")):d()})});