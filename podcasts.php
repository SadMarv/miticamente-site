<?php /* Template Name: Podcasts Page */
?> <!doctype html><html lang="pt-br"> <?php get_header('new'); ?> <body class="home"> <?php get_header('navbar') ?> <div class="container home"><div class="row"><div class="col-12 col-xs-6"><h1>Episódios</h1></div> <?php
        $args = array(
          'post_type' => 'post',
          'category_name'  => 'Podcasts',
          'posts_per_page' => -1,
          'order' => 'DESC',
        );
        $query = new WP_Query($args);
        while($query->have_posts()):$query->the_post();
        $name = explode('–', get_the_title())[0];
        $title = explode('–', get_the_title())[1];
        $postid = get_the_ID();
        $perm_link = get_the_permalink();
        $thumb = get_the_post_thumbnail_url($postid);
        $content_post = get_the_excerpt($postid);
        $content = $content_post->post_content;
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);

        ?> <div class="col-12 col-xl-6"><div class="card-podcast" style="background-image:linear-gradient(173deg, rgba(225,225,220,0), rgba(0,0,0,0.4)), url('<?php echo $thumb; ?>');"><a href="<?php echo $perm_link; ?>"><p class="podcast-name"><?php echo $name; ?></p><p class="podcast-title"><?php echo $title; ?></p></a> <?php if( $episode_content = get_the_powerpress_content() ){ // Player Powerpress  ?> <div class="content-powerpress-meta"><span class="player-buttons"><a download="" class="download" href="<?php
                          $EpisodeData = powerpress_get_enclosure_data(get_the_ID(), 'podcast');
                          $MediaURL = powerpress_add_flag_to_redirect_url($EpisodeData['url'], 'p');
                          ?>" target="_blank"><i class="fas fa-download"></i> Baixar (<?php
                          $EpisodeData = powerpress_get_enclosure_data(get_the_ID(), 'podcast');
                          $MediaSize = powerpress_add_flag_to_redirect_url($EpisodeData['size'], '');
                          echo number_format($MediaSize / (1024 * 1024), 1); ?>MB) </a></span><span class="player-buttons"><a title="Play" class="download play" data-podcast-id="<?php echo get_the_ID(); ?> "><i class="fas fa-play" aria-hidden="true"></i> Play </a></span><span class="player-buttons"><a class="download" href="https://miticamente.com.br/feed/podcast/feed.xml" target="_blank"><i class="fas fa-rss"></i> Assinar</a></span></div> <?php } ?> </div></div><div class="col-12 col-xl-6"><div> <?php
                echo $content;
              ?> </div></div> <?php
            endwhile; wp_reset_postdata();
          ?> </div></div> <?php get_footer('new') ?> <?php get_footer('scripts'); ?> <script src="<?php bloginfo('template_url');?>/static/scripts/podcasts.js"></script></body></html>