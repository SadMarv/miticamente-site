<!doctype html>
<html lang="pt-br">
  <?php wp_head(); ?>
  <?php get_header('new'); ?>
  <body class="home">

    <?php get_header('navbar') ?>

    <div class="container home">
      <div class="row pt-5">
      <?php
      // Start the loop.
      while ( have_posts() ) : the_post();
        $postid = get_the_ID();
        $perm_link = get_the_permalink();
        $thumb = get_the_post_thumbnail_url($postid);
      ?>
      </div>
    </div>
    <div class="bg-podcast-image">

    </div>
      <div>
        <div class="image-podcast" >
          <?php echo the_post_thumbnail(); ?>
        </div>
        <?php
          the_content();
        ?>
      </div>
      <?php
      // End of the loop.
      endwhile;
    ?>
      </div><!--Fim Row-->
    </div><!--Fim Container-->

    <!-- Footer -->
    <?php wp_footer(); ?>
    <?php get_footer('new') ?>
    <?php get_footer('scripts'); ?>
    <script src="<?php bloginfo('template_url');?>/static/scripts/podcasts.js"></script>
  </body>
</html>

