these files will gte automatically loaded  and won't get deactivated by mistake

add this in your templates to use the components

```php
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

          <img src="<?php echo esc_url( $img_src ); ?>"
              srcset="<?php echo esc_attr( $img_srcset ); ?>"
              sizes="(max-width: 50em) 87vw, 680px" alt="Foo Bar">

          <?php
          // if ( isset($gallery['image_desc'][$i]) ) {
          //   echo $gallery['image_desc'][$i];
          // }
      }
    }
  }?>
```