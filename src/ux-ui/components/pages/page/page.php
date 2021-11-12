<?php get_header(); ?>

<?php
  $projects = new WP_Query(array(
    'posts_per_page' => 10,
    'posts_type' => 'project'
  ));

  while($projects->have_posts()) {
    $projects->the_post();
       echo '<li>' . get_the_title() . '</li>';
  }
  
  wp_reset_postdata();?>

<?php get_footer(); ?>