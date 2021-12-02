<?php get_header();
themeFiles('/archive-work_project/', true);?>

  <?php
    $projects = new WP_Query(array(
      'post_type' => 'work_project'
    ));
  ?>
  <?php while($projects->have_posts()) {
    $projects->the_post(); ?>
    <h2><?php the_title(); ?></h2>
    <div><?php the_post_thumbnail(); ?></div>
  <?php } ?>

<?php get_footer(); ?>