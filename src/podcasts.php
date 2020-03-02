<?php /* Template Name: Podcasts Page */
?>
<!doctype html>
<html lang="pt-br">
  <?php get_header('new'); ?>
  <body class="home">

    <?php get_header('navbar') ?>
    <?php
        $args = array(
          'post_type' => 'post',
          'category_name'  => 'Podcasts',
          'posts_per_page' => 10,
          'order' => 'DESC',
          'paged' => $paged
        );
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $query = new WP_Query($args);
    ?>
         

    <div class="container home">
      <div class="row pt-5">
        <div class="col-8">
          <h1 class="title-podcasts">Podcasts</h1>
        </div>
        <div class="col-4 pagination-top text-center">
            <?php 
                echo previous_posts_link('<i class="fa fa-chevron-left" aria-hidden="true"></i>');
                echo next_posts_link( '<i class="fa fa-chevron-right" aria-hidden="true"></i>', $query->max_num_pages);
            ?>
        </div>
      </div><!--fim row-->

      <div class="row">
          <?php
            while($query->have_posts()):$query->the_post();
            $name = explode('–', get_the_title())[0];
            $title = explode('–', get_the_title())[1];
            $postid = get_the_ID();
            $perm_link = get_the_permalink();
            $thumb = get_the_post_thumbnail_url($postid);
            $content = get_the_content();
          ?>
        
          <div class="col-12 col-xl-6 box-podcast">
            <div  class="card-podcast" style="background-image:linear-gradient(173deg, rgba(225,225,220,0), rgba(0,0,0,0.4)), url('<?php echo $thumb; ?>');">
                <a href=<?php echo $perm_link; ?>>
                  <p class="podcast-name"><?php echo $name; ?></p>
                  <p class="podcast-title"><?php echo $title; ?></p>
                </a>
            </div>
          </div>
          <div class="col-xl-6 d-none d-xl-flex  box-podcast">
            <div class="podcast-content">
              <p class="description-podcast">
                <?php
                  echo wp_filter_nohtml_kses( $content );
                ?>
              </p>
            </div>
          </div>
          <?php
            endwhile; 
          ?>
          <div class="col-12 pagination d-block text-center">
            <?php 
                echo paginate_links( array(
                    'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                    'total'        => $query->max_num_pages,
                    'current'      => max( 1, get_query_var( 'paged' ) ),
                    'format'       => '?paged=%#%',
                    'show_all'     => false,
                    'type'         => 'plain',
                    'end_size'     => 2,
                    'mid_size'     => 1,
                    'prev_next'    => true,
                    'prev_text'    => sprintf( '<i class="fa fa-arrow-left" aria-hidden="true"></i>' ),
                    'next_text'    => sprintf( '<i class="fa fa-arrow-right" aria-hidden="true"></i>' ),
                    'add_args'     => false,
                    'add_fragment' => '',
                ) );
            ?>
          </div>
          <?php 
            wp_reset_postdata();
          ?>
      </div><!--Fim Row-->
    </div><!--Fim Container-->

    <!-- Footer -->
    <?php get_footer('new') ?>
    <?php get_footer('scripts'); ?>
    <script src="<?php bloginfo('template_url');?>/static/scripts/podcasts.js"></script>
  </body>
</html>
