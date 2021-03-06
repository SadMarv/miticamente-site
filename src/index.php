<?php /* Template Name: Home */
?>
<!doctype html>
<html lang="pt-br">
  <?php wp_head(); ?>
  <?php get_header('new'); ?>
  <body class="home">

    <?php get_header('navbar') ?>
    <div class="bg-podcast-image" style="display:none;" >
        <div class="blur-podcast" style="background: url('https://miticamente.com.br/wp-content/uploads/2020/05/Ep036_tinyhd.png') center no-repeat; background-size:cover;">
        </div>
        <div class="container podcast">
          <div class="row">
            <div class="col-12">
              <div class="box-image-podcast  text-center" >
                <img class="image-podcast" src="" alt="<?php echo $title ?>">
              </div>
            </div>
          </div><!--Fim Row-->
        </div><!--Fim Container-->
      </div><!--Fim bg-podcast-image-->
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

              <div  class="card-podcast">
                <a href=<?php echo $perm_link ?>>
                  <div class="img-podcast"  style="background-image:linear-gradient(173deg, rgba(225,225,220,0), rgba(0,0,0,0.4)), url('<?php echo $thumb; ?>');"></div>
                 </a>
                <?php if( $episode_content = get_the_powerpress_content() ){ // Player Powerpress  ?>
                    <div class="content-powerpress-meta">
                      
                      <span class="player-buttons btn-baixar">
                        <a class="download" href="<?php
                          $EpisodeData = powerpress_get_enclosure_data(get_the_ID(), 'podcast');
                          $MediaURL = powerpress_add_flag_to_redirect_url($EpisodeData['url'], 'p');
                          echo $MediaURL;
                          ?>" target="_blank">
                          <i class="fas fa-download"></i> Baixar (<?php
                          $EpisodeData = powerpress_get_enclosure_data(get_the_ID(), 'podcast');
                          $MediaSize = powerpress_add_flag_to_redirect_url($EpisodeData['size'], '');
                          echo number_format($MediaSize / (1024 * 1024), 1); ?>MB)
                        </a>
                      </span>
                      <span class="player-buttons btn-play">
                        <a title="Play" class='download play' data-podcast-id=<?php echo get_the_ID(); ?> >
                          <i class="fas fa-play" aria-hidden="true"></i> Play
                        </a>
                      </span>
                      <span class="player-buttons btn-share">
                        <a class="download" data-share-id=<?php echo get_the_ID(); ?>><i class="fa fa-share" aria-hidden="true"></i> Compartilhar</a>
                        <div class="share-block closed" >
                          <strong class="share-strong">Compartilhar</strong>
                          <p class="share-title"><?php echo $name; ?> - <?php echo $title; ?></p>
                          <div class="share-links">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $perm_link; ?>" aria-label="Facebook share" target="_blank"><i class="fab fa-facebook"></i></a>
                            <a href="https://twitter.com/intent/tweet?text=<?php echo $name; ?> - <?php echo $title; ?>&amp;url=<?php echo $perm_link; ?>&amp;" aria-label="Twitter share" target="_blank"><i class="fab fa-twitter-square"></i></a>
                            <a href="https://api.whatsapp.com/send?text=<?php echo $name; ?> - <?php echo $title; ?> <?php echo $perm_link; ?>" aria-label="Whatsapp share" target="_blank"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                          </div>
                        </div>
                      </span>
                                        
                    </div>
                <?php } ?>
                
                <a href=<?php echo $perm_link ?>>
                  <p class="podcast-name"><?php echo $name; ?></p>
                  <p class="podcast-title"><?php echo $title; ?></p>
                </a>

              </div>

          </div>
          <?php
            endwhile; wp_reset_postdata();
          ?>          
      </div><!--Fim Row-->
    </div><!--Fim Container-->
    <!-- Player-->
    <div class="col-12 text-center player">
      <div class="podcast_player_wrapper desktop"> 
          <audio class="podcast-audio" id="podcast-audio" src=""> 
              <source class='podcast-audio' type="audio/mpeg" src=""> 
          </audio>

          <div class="place_loading">
            <i class="fa fa-spinner fa-pulse fa-3x fa-fw loading"></i>
          </div>

          <div class="box-buttons desktop">
            <span class="podcast_backward podcast_btn">
              <i class="fa fa-backward" aria-hidden="true"></i>
            </span>
            <span class="podcast_play podcast_btn">
              <i class="fa fa-play"></i>
            </span>
            <span class="podcast_forward podcast_btn">
              <i class="fa fa-forward" aria-hidden="true"></i>
            </span>
          </div>

          <div class="box-progress">
            <div class="box-btn-close mobile">
              <div class="btn btn-close">
                <i class="fa fa-window-close" aria-hidden="true"></i>
              </div>
            </div>

            <div class="timer mobile"></div>

            <div class="progress">
              <input type="range" min="0" max="0" step="1" class="bar" style="width:100%;" value="0">
              </input>
            </div><!--Fim playback-bar-->

            <span class="podcast_name text-left">
              <p style="margin: unset;"></p>
            </span>

            <div class="box-buttons mobile">
              <span class="podcast_backward podcast_btn">
                <i class="fa fa-backward" aria-hidden="true"></i>
              </span>
              <span class="podcast_play podcast_btn">
                <i class="fa fa-play"></i>
              </span>
              <span class="podcast_forward podcast_btn">
                <i class="fa fa-forward" aria-hidden="true"></i>
              </span>
            </div>

          </div>
          <div class="timer desktop"></div>

          <div class="box-btn-close desktop">
              <div class="btn btn-close">
                <i class="fa fa-window-close" aria-hidden="true"></i>
              </div>
            </div>
      </div><!--Fim podcast_player_wrapper-->
    </div><!--Fim player-->
    
    


    <!-- Footer -->
    <?php wp_footer(); ?>
    <?php get_footer('new') ?>
    <?php get_footer('scripts'); ?>
    <script src="<?php bloginfo('template_url');?>/static/scripts/home.js"></script>
  </body>
</html>
