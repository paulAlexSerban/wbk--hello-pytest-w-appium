<?php get_header();
themeFiles('/front-page/', true);?>
<main class="main__base" data-js-component="main" data-js-page="front-page">
  <div class="carousel__base uk-position-relative uk-visible-toggle" data-js-component="carousel" tabindex="-1" uk-slideshow="animation: fade; ratio: false;">
    <ul class="carousel__list uk-slideshow-items">
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


                <li class="carousel__item">
                  <div
                    class="carousel__slide uk-position-cove uk-animation-reverse uk-transform-origin-center-left">
                    <img class="carousel__image" data-src="<?php echo esc_url( $img_src ); ?>" data-srcset="<?php echo esc_attr( $img_srcset ); ?>" sizes="<?php echo esc_attr( $img_sizes ); ?>" alt="" uk-cover uk-img
                      uk-img="target: !* -*, !* +*">
                  </div>
                </li>


                <?php
            }
          }
        }?>

    </ul>
    <a class="carousel__control uk-position-center-left uk-position-small uk-hidden-hover" href="#"
      uk-slidenav-previous uk-slideshow-item="previous"></a>
    <a class="carousel__control uk-position-center-right uk-position-small uk-hidden-hover" href="#"
      uk-slidenav-next uk-slideshow-item="next"></a>
    <div class="uk-position-bottom-center uk-position-small">
      <ul class="uk-dotnav">
          <li uk-slideshow-item="0"><a href="#">Item 1</a></li>
          <li uk-slideshow-item="1"><a href="#">Item 2</a></li>
          <li uk-slideshow-item="2"><a href="#">Item 3</a></li>
          <li uk-slideshow-item="3"><a href="#">Item 4</a></li>
          <li uk-slideshow-item="4"><a href="#">Item 5</a></li>
          <li uk-slideshow-item="5"><a href="#">Item 6</a></li>
      </ul>
    </div>
  </div>
</main>

<?php get_footer(); ?>