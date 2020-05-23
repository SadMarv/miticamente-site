$(document).ready(function(){

  var statusId = 0;

  $(document).click(function() {
    $('.share-block').css( "display", "none" ).removeClass('opened').addClass('closed');
    $('.btn-share').css("border-bottom-right-radius","10px");
  });

  $('.download').on("click", function(e){
    e.stopPropagation();

    var status = $(this).closest('div').find('.share-block');

    if(status.hasClass('closed') ){
      $('.share-block').css( "display", "none" ).removeClass('opened').addClass('closed');
      status.css( "display", "block" ).removeClass('closed').addClass('opened');
      $('.btn-share').css("border-bottom-right-radius","10px");
      $(this).parent().css("border-bottom-right-radius","0");
    } else {
      status.css( "display", "none" ).removeClass('opened').addClass('closed');
      $(this).parent().css("border-bottom-right-radius","10px");
    }
    

  });

  function showonlyone(thechosenone) {
    $('.newboxes').each(function(index) {
       if ($(this).attr("id") == thechosenone) {
          $(this).show(200);
        }
       else {
          $(this).hide(600);
       }
    });
 }function SelectAll(id)
 {
     document.getElementById(id).focus();
     document.getElementById(id).select();
 }

  var audio = $("#podcast-audio")[0];

  function displayTime(e){

    var newCurrentTime = 0;

    // User moves the slider. Just update the audio currentTime.
    if(e.type=="input"){

      newCurrentTime = audio.duration * parseInt( $(".bar").val() ) / 100;
      audio.currentTime = newCurrentTime;
    }

    // The audio plays. Move the slider.
    if(e.type=="timeupdate"){
      newCurrentTime = audio.currentTime;        

      // Update the slider position
      var rangeSliderWidth = $(".rangeslider").width() - $(".rangeslider__handle").width();
      var audioPercent = audio.currentTime / audio.duration;
      var sliderPos = rangeSliderWidth*audioPercent;

      // The "handle" and the green fill at its left.
      $(".rangeslider__handle").css({"display":"none"});
      $(".rangeslider__fill").css({"width":sliderPos});

      //console.log("Width: " +$(".rangeslider").width());

    }


    // Display formatted time
    var minutes = Math.floor(newCurrentTime/60);
    var seconds = Math.floor(newCurrentTime%60);
    if(seconds<10){seconds = "0"+seconds}
    $("#status").text(minutes+":"+seconds);
  }


  // RangeSlider instantiation
  $(".bar").rangeslider({
    polyfill: false,

    onInit: function (){
      $(".rangeslider__fill").css({"width":'0px'});
    },
  });


  // Control handlers
  $(document).on("input", ".bar", function(e){  // On slider move
    displayTime(e)
  });

  $("#podcast-audio").on('timeupdate',  function(e){  // on currentTime change
    displayTime(e)
  });

  history.replaceState(null,'','#home');
  
  var isPlaying = false;


  $(".play").on('click', function(e){
    $(".player").css('display', 'block');
    e.preventDefault();
    var podcastId = $(this).data('podcast-id');
    console.log('podcastId',podcastId);
    
    var path = window.location.href;
    var urlPodcast = path.substr(path.indexOf('media'));
    
    $.ajax({
      type: 'post',
      dataType: 'json',
      url: '/wp-admin/admin-ajax.php',
      data: {
        'action': 'contactAjax',
        'data': podcastId
      },
      success: function(response){
        var url = response['url'];
        var duration = response['duration'];
        var name = response['name'];
        var title = response['title'];
        var urlHash = url.substr(url.indexOf('media')); 
        history.replaceState(null,'','#podcast='+url);
        
        if(urlHash != urlPodcast || isPlaying == false){
          $('.podcast-audio').attr('src', url);
          play();
          $(".podcast_name").children('p').text(name+' - '+ title);
        } else {
        }
          },
          error: function(errorThrown){
            alert('error');
            console.log(errorThrown);
       }
        });
        
      }) // contactAjax click event end

      $(".btn-close").on("click", function(){
        pause();
        $(".player").css('display', 'none');
      });

      function play(){
        isPlaying = true;
       $('#podcast-audio').get(0).play();
       $(".podcast_play").children('i').removeClass('fa fa-play').addClass('fa fa-pause');
      }

      function pause(){
        isPlaying = false;
        $('#podcast-audio').get(0).pause();
        $(".podcast_play").children('i').removeClass('fa fa-pause').addClass('fa fa-play');
      }

      $(".podcast_play").on('click', function (e){
        e.preventDefault();
        
        
        if(isPlaying){
          pause();
        } else {
          play();
        }
      })

      
});

