<?php get_header();
themeFiles('/front-page/', true);?>
<main class="main__base" data-js-component="main" data-js-page="front-page">
  <div class="carousel__base uk-position-relative uk-visible-toggle" data-js-component="carousel" tabindex="-1" uk-slideshow="animation: fade; ratio: false;">
    <ul class="carousel__list uk-slideshow-items">
      <?php
          $projects = new WP_Query(array(
            'post_type' => 'work_project'
          ));
        ?>
        <?php while($projects->have_posts()) {
          $projects->the_post(); ?>
          <li class="carousel__item">
            <a class="carousel__slide uk-position-cove uk-animation-reverse uk-transform-origin-center-left"
              href="<?php the_permalink(); ?>"
              target="_blank">
              <?php the_post_thumbnail('full', 
                                        array( 'class' => 'carousel__image',
                                                'uk-img' => 'target: !* -*, !* +*',
                                                'uk-cover' => '',
                                                'uk-img' => ''
                                              )); ?>
            </a>
          </li>
        <?php } ?>
    </ul>
    <a class="carousel__control uk-position-center-left uk-position-small uk-hidden-hover" href="#"
      uk-slidenav-previous uk-slideshow-item="previous"></a>
    <a class="carousel__control uk-position-center-right uk-position-small uk-hidden-hover" href="#"
      uk-slidenav-next uk-slideshow-item="next"></a>
  </div>
</main>

<?php get_footer(); ?>