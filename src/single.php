
<?php
      // Start the loop.
      while ( have_posts() ) : the_post();
        $postid = get_the_ID();
        $title = get_the_title();
        $perm_link = get_the_permalink();
        $thumb = get_the_post_thumbnail_url();
      ?>
<?php 
define('MITIC_TITLE',$title . ' - Miticamente Podcast');
define('MITIC_META_DESCRIPTION', wp_trim_excerpt() );
define('MITIC_META_IMG', $thumb);
?>
<!doctype html>
<html lang="pt-br">
  <?php wp_head(); ?>
  <?php get_header('new'); ?>
  <body class="home">

    <?php get_header('navbar') ?>
      

    <div class="container ">
      <div class="row pt-5">
      </div>
    </div>

    <div class="bg-podcast-image" >
      <div class="blur-podcast" style="background: url('<?php echo $thumb ?>') center no-repeat; background-size:cover;">
      </div>
      <div class="container podcast">
        <div class="row">
          <div class="col-12">
            <div class="box-image-podcast  text-center" >
              <img class="image-podcast" src="<?php echo $thumb ?>" alt="<?php echo $title ?>">
            </div>
          </div>
        </div><!--Fim Row-->
      </div><!--Fim Container-->
    </div><!--Fim bg-podcast-image-->
    
    <div class="container podcast">
      <div class="row">
        <div class="col-12">
          <?php echo get_the_powerpress_content();?>
          <h1><?php echo get_the_title();?></h1>
        </div>
      </div>
      <div class="row">
        <div class="podcast-content col-12 text-center" style="margin: 5px;">
          <?php
            the_content();
          ?>
          <?php
            // End of the loop.
            endwhile;
          ?>
        </div>
      </div>
    </div>


    <!-- Footer -->
    <?php wp_footer(); ?>
    <?php get_footer('new') ?>
    <?php get_footer('scripts'); ?>
    <script src="<?php bloginfo('template_url');?>/static/scripts/podcasts.js"></script>
  </body>
</html>


