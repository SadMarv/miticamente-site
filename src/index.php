<?php /* Template Name: Home */
?>
<!doctype html>
<html lang="pt-br">
  <?php wp_head(); ?>
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

            <a href=<?php echo $perm_link ?>>
              <div  class="card-podcast text-center">
                <img class="img-podcast"  style="background-image:linear-gradient(173deg, rgba(225,225,220,0), rgba(0,0,0,0.4)), url('<?php echo $thumb; ?>');">

                <?php if( $episode_content = get_the_powerpress_content() ){ // Player Powerpress  ?>
                    <div class="content-powerpress-meta">
                        <span class="player-buttons">
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
                        <span class="player-buttons">
                          <a title="Play" class='download play' data-podcast-id=<?php echo get_the_ID(); ?> >
                            <i class="fas fa-play" aria-hidden="true"></i> Play
                          </a>
                        </span>
                        <span class="player-buttons">

                        <a class="assinar" id="myHeader1" href="javascript:showonlyone('newboxes1');" ><span class="player-text">ASSINAR</span></a></section>
                        <a class="compartilhar" id="myHeader2" href="javascript:showonlyone('newboxes2');"><span class="player-text">COMPARTILHAR</span></a></section>
                        <a class="incorporar" id="myHeader3" href="javascript:showonlyone('newboxes3');"><span class="player-text">INCORPORAR</span></a></section>
                        <div class="newboxes" id="newboxes1">
                          <span><a href="LINK PARA PÁGINA IOS" target="_blank"><span class="player-text">iPhone</span></a></span>
                          <span><a href="LINK PARA PÁGINA ANDROID" target="_blank"><span class="player-text">Android</span></a></span>
                          <span><a href="LINK PARA PÁGINA WINDOWS PHONE" target="_blank"><span class="player-text">Windows Phone</span></a></span>
                          <span><a href="<?php echo site_url(); ?>/feed/podcast/" target="_blank"><span class="player-text">Feed Rss</span></a></span>
                        </div>
                        <div class="newboxes" id="newboxes2">
                          <span><a onClick="window.open('http://www.facebook.com/sharer.php?s=100&p[url]=<?php the_permalink(); ?>','sharer','toolbar=0,status=0,width=580,height=325');" href="javascript: void(0)"><span class="player-text">Facebook</span></a></span>
                          <span><a onclick="javascript:window.open('http://twitter.com/share?text=<?php echo urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')); ?>&url=<?php echo urlencode(get_permalink());?>&via=USUÁRIO-TWITTER','',
                          'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
                          return false;" href="javascript: void(0)"><span class="player-text">Twitter</span></a></span>
                          <span><a onclick="javascript:window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>','','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="javascript: void(0)"><span class="player-text">Google Plus</span></a></span>
                          <span><input type="text" id="txtfld" onClick="SelectAll('txtfld');" style="width:200px" value="<?php echo the_permalink(); ?>" /></span>
                        </div>
                        <div class="newboxes" id="newboxes3">
                          <span><input type="text" id="txtfld2" onClick="SelectAll('txtfld2');" style="width:100%;color:#320890" value="&lt;iframe width='100%' src='<?php echo the_permalink(); ?>?player=<?php echo get_the_ID($post->ID); ?>' frameborder='0' scrolling='no' onload='resizeIframe(this)'&gt;&lt;/iframe&gt;&lt;script&gt;function resizeIframe(a){a.style.height=a.contentWindow.document.body.scrollHeight+'px'}&lt;/script&gt;" /></span>
                        </div>

                          <a class="download" href="https://miticamente.com.br/feed/podcast/feed.xml" target="_blank"><i class="fas fa-rss"></i> Assinar</a>
                        </span>
                    </div>
                <?php } ?>
                
                <a href=<?php echo $perm_link ?>>
                  <p class="podcast-name"><?php echo $name; ?></p>
                  <p class="podcast-title"><?php echo $title; ?></p>
                </a>

              </div>
            </a>

          </div>
          <?php
            endwhile; wp_reset_postdata();
          ?>          
      </div><!--Fim Row-->
    </div><!--Fim Container-->
    <!-- Player-->
    <div class="col-12 text-center player">
      <div class="podcast_player_wrapper"> 
          <audio class="podcast-audio" id="podcast-audio" src=""> 
              <source class='podcast-audio' type="audio/mpeg" src=""> 
          </audio>
          <div class="progress">
            <span class="podcast_play">
              <i class="fa fa-play"></i>
            </span>
            <span class="podcast_name text-center">
              <p style="margin:unset"></p>
            </span>
            <input type="range" min="0" max="100" step="1" class="bar" style="width:60%" value="0">
            </input>
            <div id="status"></div>
          </div><!--Fim playback-bar-->
          <div class="btn btn-close">
          <i class="fa fa-window-close" aria-hidden="true"></i>
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
