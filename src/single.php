<!doctype html5>
<html lang="pt-br">
  <?php get_header('new'); ?>
  <body <?php body_class(); ?>>
    <?php get_header('navbar') ?>
    
    <?php
      // Start the loop.
      while ( have_posts() ) : the_post();
      ?>
      <div class="">

      <?php
      the_content();
      ?>
      </div>
      <?php
      // End of the loop.
      endwhile;
    ?>
    <!-- Footer -->
    <?php get_footer('block') ?>

  </body>
  <?php wp_footer(); ?>
  <?php get_footer('scripts'); ?>
</html>
