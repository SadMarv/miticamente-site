$(document).ready(function(){

    $(".download").on('click', function(e){
        // stopping form from reloading the page
        e.preventDefault();
        // serializing data from the target form
        var podcastId = $(this).data('podcast-id');

        console.log('podcast '+podcastId);
      
        $.ajax({
          type: 'post',
          dataType: 'text',
          url: '/wp-admin/admin-ajax.php',
          data: {
            'action': 'contactAjax',
            'data': podcastId
          },
          success: function(response){
           var url = response.substring(0,(response.length - 1))
            console.log('log '+url);
            $('#podcast-audio').attr('src', url);

          }
        });
      
      }) // contactForm click event end
});

