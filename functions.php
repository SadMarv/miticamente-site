<?php
  add_theme_support( 'post-thumbnails' );

  
  add_action( 'init', 'my_script_enqueuer' );

function my_script_enqueuer() {
  wp_register_script( "my_voter_script", get_template_directory_uri() . '/static/scritps/home.js', array('jquery') );
   wp_localize_script( 'my_voter_script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        

   wp_enqueue_script( 'jquery' );
   wp_enqueue_script( 'my_voter_script' );

}


  function contactAjax(){
    $podcastId = $_POST['data'];


    $name = explode(' –', get_the_title($podcastId))[0];
    $title = explode('– ', get_the_title($podcastId))[1];

    $EpisodeData = powerpress_get_enclosure_data( $podcastId );

      $items = array(
        "url" => $EpisodeData['url'],
        "duration" => $EpisodeData['duration'],
        "name" => $name,
        "title" => $title,
      );

      wp_send_json($items);

  }
  add_action('wp_ajax_contactAjax', 'contactAjax');
  add_action('wp_ajax_nopriv_contactAjax', 'contactAjax');

 ?>
