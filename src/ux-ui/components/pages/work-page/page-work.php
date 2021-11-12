<?php get_header();
themeFiles('/work-page/', true);?>

<?php
  $projects = new WP_Query(array(
    'post_type' => 'work_project'
  ));

  while($projects->have_posts()) {
    $projects->the_post(); ?>
    <h2><?php the_title(); ?></h2>
    <div><?php the_content(); ?></div>
    <div>

    <?php 
      $image = get_field('cover_image');
      $size = 'full'; // (thumbnail, medium, large, full or custom size)
      if( $image ) {
        echo wp_get_attachment_image_url( $image['id']);
        echo wp_get_attachment_image_srcset( $image['id']);
      } ?>


    </div>
  <?php } ?>

<?php get_footer(); ?>