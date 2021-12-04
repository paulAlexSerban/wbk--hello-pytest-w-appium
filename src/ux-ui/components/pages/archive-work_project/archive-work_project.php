<?php
// Page template logic
$projects = new WP_Query(array(
  'post_type' => 'work_project'
));
?>

<?php get_header();
      themeFiles('/archive-work_project/', true);?>
<main class="main__base">
  <div class="uk-child-width-expand@s uk-text-center" uk-grid>
    <?php 
    while($projects->have_posts()) {
      $projects->the_post(); ?>
        <div class="card__base">
          <?php 
            the_post_thumbnail(
              'large',
              array(
                'class' => 'card__image',
                'uk-img' => ''
              )
            ); 
          ?>
        </div>
    <?php } ?>
  </div>
</main>


<?php get_footer(); ?>