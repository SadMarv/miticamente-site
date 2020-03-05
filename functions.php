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
    $podcast = $_POST['data'];
    $podcastId = preg_replace('/\D/', '', $podcast);

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

  function arrow_previous_link( $label = null ) {
    global $paged;
 
    if ( null === $label ) {
        $label = __( '&laquo; Previous Page' );
    }
 
    if ( ! is_single() && $paged > 1 ) {
        /**
         * Filters the anchor tag attributes for the previous posts page link.
         *
         * @since 2.7.0
         *
         * @param string $attributes Attributes for the anchor tag.
         */
        $attr = apply_filters( 'previous_posts_link_attributes', '' );
        return '<a href="' . previous_posts( false ) . "\" $attr>" . preg_replace( '/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', $label ) . '</a>';
      } else {
        /**
         * Filters the anchor tag attributes for the previous posts page link.
         *
         * @since 2.7.0
         *
         * @param string $attributes Attributes for the anchor tag.
         */
        $attr = apply_filters( 'previous_posts_link_attributes', '' );
        return '<a class="disabled"' . $attr . '>' . preg_replace( '/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', $label ) . '</a>';
    }
  }

  function arrow_next_link( $label = null, $max_page = 0 ) {
    global $paged, $wp_query;

    if ( ! $max_page ) {
        $max_page = $wp_query->max_num_pages;
    }

    if ( ! $paged ) {
        $paged = 1;
    }

    $nextpage = intval( $paged ) + 1;

    if ( null === $label ) {
        $label = __( 'Next Page &raquo;' );
    }

    if ( ! is_single() && ( $nextpage <= $max_page ) ) {
        /**
         * Filters the anchor tag attributes for the next posts page link.
         *
         * @since 2.7.0
         *
         * @param string $attributes Attributes for the anchor tag.
         */
        $attr = apply_filters( 'next_posts_link_attributes', '' );
        return '<a href="' . next_posts( $max_page, false ) . "\" $attr>" . preg_replace( '/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', $label ) . '</a>';

      } else {
        /**
         * Filters the anchor tag attributes for the next posts page link.
         *
         * @since 2.7.0
         *
         * @param string $attributes Attributes for the anchor tag.
         */
        $attr = apply_filters( 'next_posts_link_attributes', '' );
        return '<a class="disabled"' . $attr . '>' . preg_replace( '/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', $label ) . '</a>';
        
    }
  }

 ?>
