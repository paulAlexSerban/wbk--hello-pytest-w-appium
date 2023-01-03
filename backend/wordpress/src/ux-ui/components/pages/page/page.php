<?php get_header(); 
      themeFiles('/page/', true);?>

<main class="main__base">
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


              <div class="hero-banner__base uk-inline uk-light">
                <img class="hero-banner__image" src="<?php echo esc_url( $img_src ); ?>"
                      srcset="<?php echo esc_attr( $img_srcset ); ?>"
                      sizes="<?php echo esc_attr( $img_sizes ); ?>" alt="" uk-image>
                <div class="uk-position-center">
                <h1><?php the_title(); ?></h1>
                </div>
              </div>  

            <?php
          }
        }
    }?>

  <?php the_content(); ?>
</main>

<?php get_footer(); ?>