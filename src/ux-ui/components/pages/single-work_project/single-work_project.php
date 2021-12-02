<?php get_header(); 
    themeFiles('/single-work_project/', true);
?>

<?php
  while(have_posts()) {
    the_post(); ?>
    <div class="hero-carousel__base">
      hero carousel
    </div>
      <h2><?php the_title(); ?></h2>

    <div class="project-description"></div>
      <?php the_content();?>

<?php }?>

<?php get_footer(); ?>