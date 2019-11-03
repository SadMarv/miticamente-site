<?php /* Template Name: New Home */
define('CNFGR_TITLE', 'Hospedagem em Nuvem Gerenciada por Robôs - Configr');
define('CNFGR_META_DESCRIPTION', 'A plataforma de gerenciamento de hospedagem de sites da Configr foi criada para facilitar a gestão de recursos de hospedagem em nuvem, para a melhor performance de aplicações como Wordpress, Magento e outras.');
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
          'category_name'  => 'podcasts',
          'order' => 'ASC',
        );
        $query = new WP_Query($args);
        while($query->have_posts()):$query->the_post();
        $name = explode('–', get_the_title())[0];
        $title = explode('–', get_the_title())[1];
        $postid = get_the_ID();
        $perm_link = get_the_permalink();
        $thumb = get_the_post_thumbnail_url($postid);
        ?>
        <div class="col-12 col-xl-6 text-center">
          <a href=<?php echo $perm_link; ?>>
          <div  class="card-podcast" style="background-image:linear-gradient(180deg, rgba(0, 0, 0, 0.1), rgba(51, 51, 51, 0.59)), url('<?php echo $thumb; ?>');">
              <!-- <div class="overlay">
              </div> -->
              <p class="podcast-name"><?php echo $name; ?></p>
              <p class="podcast-title"><?php echo $title; ?></p>
          </div>
        </a>
        </div>

        <?php
        endwhile; wp_reset_postdata();
         ?>
      </div>
    </div>



    <!-- Footer -->
    <?php get_footer('new') ?>
    <?php get_footer('scripts'); ?>
    <script src="<?php bloginfo('template_url');?>/static/scripts/home.js"></script>
    <script src="<?php bloginfo('template_url');?>/static/scripts/theater.min.js"></script>
  </body>
</html>
