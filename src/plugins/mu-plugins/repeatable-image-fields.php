<?php
/**
 * Plugin Name: Repeatable Image Fields
 * Plugin URI:  https://Repeatable_Image_Fields.com
 * Description: Repeatable Image Fields to use in a carousel
 * Author:      Paul Serban
 */

add_action( 'admin_init', 'add_post_gallery' );
add_action( 'add_meta_boxes_page', 'add_page_gallery' );
add_action( 'admin_head-post.php', 'print_scripts' );
add_action( 'admin_head-post-new.php', 'print_scripts' );
add_action( 'save_post', 'update_post_gallery', 10, 2 );

// Make it work only in selected templates
$rep_fields_templates = array('single.php');
$rep_fields_posts     = array('post', 'event', 'professor');

/**
 * Add custom Meta Box
 */

// Add meta box to custom posts 
function add_post_gallery() {
    global $rep_fields_posts;       
    add_meta_box(
        'post_gallery',
        'Slideshow Gallery',
        'post_gallery_options',
        $rep_fields_posts,
        'normal',
        'core'
    );
}

// Add meta box to custom page templates
function add_page_gallery() {       
    global $post, $rep_fields_templates;
    if ( in_array( get_post_meta( $post->ID, '_wp_page_template', true ), $rep_fields_templates ) ) {
        add_meta_box(
            'post_gallery',
            'Slideshow Gallery',
            'post_gallery_options',
            'page',
            'normal',
            'core'
        );
    }
}

/**
 * Print the Meta Box content
 */
function post_gallery_options() {
    global $post;
    $gallery_data = get_post_meta( $post->ID, 'gallery_data', true );

    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'noncename_so_14445904' );  ?>

    <div id="dynamic_form">

        <div id="field_wrap">
        <?php 
        if ( isset( $gallery_data['image_url'] ) ) {
            for( $i = 0; $i < count( $gallery_data['image_url'] ); $i++ ) {
            ?>

            <div class="field_row">

              <div class="field_left">
                <div class="form_field">
                  <!--<label>Image URL</label>-->
                  <input type="hidden"
                         class="meta_image_url"
                         name="gallery[image_url][]"
                         value="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>"/>
                  <input type="hidden"
                         class="meta_image_id"
                         name="gallery[image_id][]"
                         value="<?php esc_html_e( $gallery_data['image_id'][$i] ); ?>"/>
                </div>
                <div class="form_field" style="margin-bottom: 20px">
                  <label>Description</label>
                  <textarea
                         class="meta_image_desc"
                         name="gallery[image_desc][]"
                         rows="3"
                         style="width: 100%"><?php esc_html_e( $gallery_data['image_desc'][$i] ); ?></textarea>
                </div>
                <input class="button" type="button" value="Choose File" onclick="add_image(this)" />&nbsp;&nbsp;&nbsp;
                <input class="button" type="button" value="Remove" onclick="remove_field(this)" />
              </div>

              <div class="field_right image_wrap">
                <img src="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>" />
              </div>
              <div class="clear" /></div> 
            </div>
            <?php
            }
        }
        ?>
        </div>

        <div style="display:none" id="master-row">
            <div class="field_row">
                <div class="field_left">
                    <div class="form_field">
                        <!--<label>Image URL</label>-->
                        <input class="meta_image_url" value=""  name="gallery[image_url][]" />
                        <input class="meta_image_id" value=""  name="gallery[image_id][]" />
                    </div>
                    <div class="form_field" style="margin-bottom: 20px">
                        <label>Description</label>
                        <textarea class="meta_image_desc" name="gallery[image_desc][]" rows="3" style="width: 100%"></textarea>
                    </div>
                    <input type="button" class="button" value="Choose Image" onclick="add_image(this)" />&nbsp;&nbsp;&nbsp;
                    <input class="button" type="button" value="Remove" onclick="remove_field(this)" />
                </div>
                <div class="field_right image_wrap">
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <div id="add_field_row">
          <input class="button" type="button" value="Add Image" onclick="add_field_row();" />
        </div>
        <?php if ( 'trend' == get_post_type( $post->ID ) ) { ?>
        <p style="color: #a00;">Make sure the number if images you add is a <b>multiple of 5</b>.</p>
        <?php } ?>
    </div>
    <?php
}

/**
 * Print styles and scripts
 */
function print_scripts()
{
    // Check for correct post_type
    global $post, $rep_fields_templates, $rep_fields_posts;
    if ( !in_array( get_post_meta( $post->ID, '_wp_page_template', true ), $rep_fields_templates ) && 
         !in_array( get_post_type( $post->ID)                           , $rep_fields_posts ) )
        return;
    ?>  
    <style type="text/css">
      .field_left {
        float:left;
        width: 75%;
        padding-right: 20px;
        box-sizing:border-box;  
      }
      .field_right {
        float:left;
        width: 25%;
      }
      .image_wrap img {
          max-width: 100%;
      }
      #dynamic_form input[type=text] {
        width:100%;
      }
      #dynamic_form .field_row {
        border:1px solid #cecece;
        margin-bottom:10px;
        padding:10px;
      }
      #dynamic_form label {
        display: block;
        margin-bottom: 5px;
      }
    </style>

    <script type="text/javascript">
        function add_image(obj) {

            var parent=jQuery(obj).parent().parent('div.field_row');
            var inputField = jQuery(parent).find("input.meta_image_url");
            var inputFieldID = jQuery(parent).find("input.meta_image_id");
            var fileFrame = wp.media.frames.file_frame = wp.media({
                multiple: false
            });
            fileFrame.on('select', function() {
                var selection = fileFrame.state().get('selection').first().toJSON();
                inputField.val(selection.url);
                inputFieldID.val(selection.id);
                jQuery(parent)
                .find("div.image_wrap")
                .html('<img class="print-scripts-test" src="'+selection.url+'" />');
            });
            fileFrame.open();
        //});
        };

        function remove_field(obj) {
            var parent=jQuery(obj).parent().parent();
            parent.remove();
        }

        function add_field_row() {
            var row = jQuery('#master-row').html();
            jQuery(row).appendTo('#field_wrap');
        }
    </script>
    <?php
}

/**
 * Save post action, process fields
 */
function update_post_gallery( $post_id, $post_object ) 
{
    // Doing revision, exit earlier **can be removed**
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )  
        return;

    // Doing revision, exit earlier
    if ( 'revision' == $post_object->post_type )
        return;

    // Verify authenticity
    if ( !wp_verify_nonce( $_POST['noncename_so_14445904'], plugin_basename( __FILE__ ) ) )
        return;

    global $rep_fields_templates, $rep_fields_posts;
    if ( !in_array( get_post_meta( $post_id, '_wp_page_template', true ), $rep_fields_templates ) && 
         !in_array( get_post_type( $post_id)                            , $rep_fields_posts ) ) 
        return;

    if ( $_POST['gallery'] ) 
    {
        // Build array for saving post meta
        $gallery_data = array();
        for ($i = 0; $i < count( $_POST['gallery']['image_url'] ); $i++ ) 
        {
            if ( '' != $_POST['gallery']['image_url'][ $i ] ) 
            {
                $gallery_data['image_url'][]  = $_POST['gallery']['image_url'][ $i ];
                $gallery_data['image_id'][]  = $_POST['gallery']['image_id'][ $i ];
                $gallery_data['image_desc'][] = $_POST['gallery']['image_desc'][ $i ];
            }
        }

        if ( $gallery_data ) 
            update_post_meta( $post_id, 'gallery_data', $gallery_data );
        else 
            delete_post_meta( $post_id, 'gallery_data' );
    } 
    // Nothing received, all fields are empty, delete option
    else 
    {
        delete_post_meta( $post_id, 'gallery_data' );
    }
}


