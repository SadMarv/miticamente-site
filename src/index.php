<?php /* Template Name: Home */
?>
<!doctype html>
<html lang="pt-br">
  <?php get_header('new'); ?>
  <body class="home">

    <?php get_header('navbar') ?>
    <div class="container home">
      <div class="row">
        <?php
        $args = array(
          'post_type' => 'post',
          'category_name'  => 'Podcasts',
          'posts_per_page' => 8,
          'order' => 'DESC',
        );
        $query = new WP_Query($args);
        while($query->have_posts()):$query->the_post();
        $name = explode('–', get_the_title())[0];
        $title = explode('–', get_the_title())[1];
        $postid = get_the_ID();
        $perm_link = get_the_permalink();
        $thumb = get_the_post_thumbnail_url($postid);
        ?>
          <div class="col-12 col-xl-6">
            <div  class="card-podcast" style="background-image:linear-gradient(173deg, rgba(225,225,220,0), rgba(0,0,0,0.4)), url('<?php echo $thumb; ?>');">
                <a href=<?php echo $perm_link; ?>>
                  <p class="podcast-name"><?php echo $name; ?></p>
                  <p class="podcast-title"><?php echo $title; ?></p>
                </a>

                <?php if( $episode_content = get_the_powerpress_content() ){ // Player Powerpress  ?>
                    <div class="content-powerpress-meta">
                      <span class="player-buttons">
                        <a download="" class="download" href="<?php
                          $EpisodeData = powerpress_get_enclosure_data(get_the_ID(), 'podcast');
                          $MediaURL = powerpress_add_flag_to_redirect_url($EpisodeData['url'], 'p');
                          ?>" target="_blank">
                          <i class="fas fa-download"></i> Baixar (<?php
                          $EpisodeData = powerpress_get_enclosure_data(get_the_ID(), 'podcast');
                          $MediaSize = powerpress_add_flag_to_redirect_url($EpisodeData['size'], '');
                          echo number_format($MediaSize / (1024 * 1024), 1); ?>MB)
                        </a>
                      </span>
                      <span class="player-buttons">
                        <a title="Play" class="download" data-podcast-id=<?php echo get_the_ID(); ?> >
                          <i class="fas fa-play" aria-hidden="true"></i> Play
                        </a>
                      </span>
                      <span class="player-buttons">
                        <a class="download" href="https://miticamente.com.br/feed/podcast/feed.xml" target="_blank"><i class="fas fa-rss"></i> Assinar</a>
                      </span>
                    </div>
                <?php } ?>
            </div>
          </div>
          <?php
            endwhile; wp_reset_postdata();
          ?>          
      </div><!--Fim Row-->
    </div><!--Fim Container-->
    
    <div class="player">
      <div class="podcast_player_wrapper"> 
      <audio controls yid="podcast"> 
          <source id='podcast-audio' src=""> 
        </audio>
        <div id="playback-bar">
          <div class="buffered"> 
            <span id="buffered-amount"></span>
          </div>
          <div class="progressbarrr"> 
            <span id="progress-amount" style="width: 2.50232%;"></span>
          </div><div class="needle"> 
            <span id="needleposition" style="width: 3px; display: none;"></span>
          </div>
        </div>
        <div class="controls"> 
          <span onclick="PlayPodcast()" class="podcast_button podcast_play">
            <i class="fa fa-play"></i>
          </span> 
          <span onclick="PausePodcast()" class="podcast_button podcast_pause hide-b">
            <i class="fa fa-pause"></i>
          </span> 
          <span onclick="setOneHalfSpeed()" class="podcast_smallbutton podcast_normalspeed">1x</span> 
          <span onclick="setDoubleSpeed()" class="podcast_smallbutton hide-b podcast_onehalfspeed">1.5x</span> 
          <span onclick="setNormalSpeed()" class="podcast_smallbutton hide-b podcast_doublespeed">2x</span> 
          <span onclick="setVolumeHalf()" class="podcast_smallbutton podcast_mute hide-b">
            <i class="fa fa-volume-off"></i>
          </span> 
          <span onclick="setVolumeFull()" class="podcast_smallbutton podcast_halfvolume hide-b">
            <i class="fa fa-volume-down"></i>
          </span> 
          <span onclick="setVolumeZero()" class="podcast_smallbutton podcast_fullvolume">
            <i class="fa fa-volume-up"></i></span>
        </div> 
        <span id="toend">-1:07:21</span>
  </div>
    </div>


    <!-- Footer -->
    <?php get_footer('new') ?>
    <?php get_footer('scripts'); ?>
    <script src="<?php bloginfo('template_url');?>/static/scripts/home.js"></script>
  </body>
</html>
