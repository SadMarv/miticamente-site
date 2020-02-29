$(document).ready(function(){

  var audio = $("#podcast-audio")[0];

  function displayTime(e){
    console.log("\n\nEvent: "+e.type);

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
      var rangeSliderWidth = $(".rangeslider").width();
      var audioPercent = audio.currentTime / audio.duration;
      var sliderPos = rangeSliderWidth*audioPercent;
      console.log("rangeSliderWidth", rangeSliderWidth);
      
      console.log("audioPercent", audioPercent);
      console.log("sliderPos", sliderPos);
      
      

      // The "handle" and the green fill at its left.
      $(".rangeslider__handle").css({"display":"none"});
      $(".rangeslider__fill").css({"width":sliderPos});

      //console.log("Width: " +$(".rangeslider").width());
      console.log("Percentage played: " +audioPercent);

    }

    console.log("tempCurrentTime: " +newCurrentTime)

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
    e.preventDefault();
    var podcastId = $(this).data('podcast-id');
    var path = window.location.href;
    var urlPodcast = path.substr(path.indexOf('media'));
    
    console.log('path', path);
    console.log('podcast '+podcastId);
    
    $.ajax({
      type: 'post',
      dataType: 'json',
      url: '/wp-admin/admin-ajax.php',
      data: {
        'action': 'contactAjax',
        'data': podcastId
      },
      success: function(response){
        console.log(response);
        var url = response['url'];
        var duration = response['duration'];
        var name = response['name'];
        var title = response['title'];
        
        var urlHash = url.substr(url.indexOf('media')); 
        console.log('urlPodcast', urlPodcast);
        console.log('urlHash '+urlHash);
        history.replaceState(null,'','#podcast='+url);
        
        if(urlHash != urlPodcast || isPlaying == false){
          $('.podcast-audio').attr('src', url);
          play();
          $(".podcast_name").children('p').text(name+' - '+ title);
        } else {
          console.log("mesma faixa");
        }
          },
          error: function(errorThrown){
            alert('error');
            console.log(errorThrown);
       }
        });
        
      }) // contactForm click event end

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
        console.log("apertei");
        
        
        if(isPlaying){
          pause();
          console.log("isPlaying", isPlaying);
        } else {
          play();
          console.log("isPlaying", isPlaying);
        }
      })

      
});

