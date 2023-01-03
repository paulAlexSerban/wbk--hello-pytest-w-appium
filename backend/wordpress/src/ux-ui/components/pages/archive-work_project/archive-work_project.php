<?php
// Page template logic
$projects = new WP_Query(array(
  'post_type' => 'work_project'
));
?>

<?php get_header();
      themeFiles('/archive-work_project/', true);?>
<main class="main__base">
  <div class="uk-text-center uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l" uk-grid>
    <?php 
    while($projects->have_posts()) {
      $projects->the_post(); ?>
        <a class="card__base" href="<?php the_permalink(); ?>">
          <?php 
            the_post_thumbnail(
              'large',
              array(
                'class' => 'card__image',
                'uk-img' => ''
              )
            ); 
          ?>
        </a>
    <?php } ?>
  </div>
</main>


<?php get_footer(); ?>