<?php /* Template Name: Home */
?> <!doctype html><html lang="pt-br"> <?php get_header('new'); ?> <body class="home"> <?php get_header('navbar') ?> <div class="container home"><div class="row"> <?php
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
        ?> <div class="col-12 col-xl-6"><div class="card-podcast" style="background-image:linear-gradient(173deg, rgba(225,225,220,0), rgba(0,0,0,0.4)), url('<?php echo $thumb; ?>');"><a href="<?php echo $perm_link; ?>"><p class="podcast-name"><?php echo $name; ?></p><p class="podcast-title"><?php echo $title; ?></p></a> <?php if( $episode_content = get_the_powerpress_content() ){ // Player Powerpress  ?> <div class="content-powerpress-meta"><span class="player-buttons"><a download="" class="download" href="<?php
                          $EpisodeData = powerpress_get_enclosure_data(get_the_ID(), 'podcast');
                          $MediaURL = powerpress_add_flag_to_redirect_url($EpisodeData['url'], 'p');
                          ?>" target="_blank"><i class="fas fa-download"></i> Baixar (<?php
                          $EpisodeData = powerpress_get_enclosure_data(get_the_ID(), 'podcast');
                          $MediaSize = powerpress_add_flag_to_redirect_url($EpisodeData['size'], '');
                          echo number_format($MediaSize / (1024 * 1024), 1); ?>MB) </a></span><span class="player-buttons"><a title="Play" class="download play" data-podcast-id="<?php echo get_the_ID(); ?> "><i class="fas fa-play" aria-hidden="true"></i> Play </a></span><span class="player-buttons"><a class="download" href="https://miticamente.com.br/feed/podcast/feed.xml" target="_blank"><i class="fas fa-rss"></i> Assinar</a></span></div> <?php } ?> </div></div> <?php
            endwhile; wp_reset_postdata();
          ?> </div></div><div class="col-12 text-center player"><div class="podcast_player_wrapper"><audio class="podcast-audio" id="podcast-audio" src=""><source class="podcast-audio" type="audio/mpeg" src=""></audio><div class="progress"><span class="podcast_play"><i class="fa fa-play"></i> </span><span class="podcast_name text-center"><p style="margin:unset"></p></span><input type="range" min="0" max="100" step="1" class="bar" style="width:60%" value="0"><div id="status"></div></div></div></div> <?php get_footer('new') ?> <?php get_footer('scripts'); ?> <script src="<?php bloginfo('template_url');?>/static/scripts/home.js"></script></body></html>