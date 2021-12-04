<?php get_header(); 
    themeFiles('/single-work_project/', true);
?>

<main class="main__base">
<?php
  while(have_posts()) {
    the_post(); ?>
    <div class="hero-carousel__base uk-position-relative uk-visible-toggle" uk-slider='center: true'>
      <ul class="hero-carousel__list uk-slider-items uk-grid">
      <?php
      if ( '' != get_post_meta( get_the_ID(), 'gallery_data', true ) ) {
        $gallery = get_post_meta( get_the_ID(), 'gallery_data', true );
      }

      if ( isset( $gallery['image_id'] ) ) {
        for( $i = 0; $i < count( $gallery['image_id'] ); $i++ ) {
          if ( '' != $gallery['image_id'][$i] ) {
              $img_src = wp_get_attachment_image_url( $gallery['image_id'][$i] );
              $img_srcset = wp_get_attachment_image_srcset( $gallery['image_id'][$i]);
              $img_sizes = wp_get_attachment_image_sizes($gallery['image_id'][$i], 'full');?>

              <li class="hero-carousel__item">
                <div class="uk-panel">
                  <img  src="<?php echo esc_url( $img_src ); ?>"
                          srcset="<?php echo esc_attr( $img_srcset ); ?>"
                          sizes="<?php echo esc_attr( $img_sizes ); ?>">
                </div>
              </li>

              <?php
          }
        }
      }?>
      </ul>
      <a class="hero-carousel__control uk-position-center-left uk-position-small uk-hidden-hover" href="#"
        uk-slidenav-previous uk-slider-item="previous"></a>
      <a class="hero-carousel__control uk-position-center-right uk-position-small uk-hidden-hover" href="#"
        uk-slidenav-next uk-slider-item="next"></a>
    </div>
      <h2><?php the_title(); ?></h2>

    <div class="project-description">
      <?php the_content();?>
    </div>

<?php }?>
</main>

<?php get_footer(); ?>