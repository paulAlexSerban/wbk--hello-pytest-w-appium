<?php
function themeFiles($args, $hasUiKit) {
  $decodedManifestJson = json_decode(file_get_contents(get_theme_file_uri("/assets/manifest.json"))); /* 1 */
  foreach ($decodedManifestJson as $key => $value) { /* 2 */
    if(preg_match('/\.css$/', $key)) { /* 3 */
      if(preg_match($args, $key)) {
        wp_enqueue_style("{$key}", get_theme_file_uri('/assets/'.$value));
      }
    } else if(preg_match('/\.js$/', $key)) {
      if(preg_match($args, $key)) {
        wp_enqueue_script("{$key}", get_theme_file_uri('/assets/'.$value), NULL, '1.0', true);
      }
    }
  }
}

function load_vendor_scripts () {
  wp_enqueue_style('uikit-css', '//cdn.jsdelivr.net/npm/uikit@3.10.1/dist/css/uikit.min.css');
  wp_enqueue_script('uikit-min', '//cdn.jsdelivr.net/npm/uikit@3.10.1/dist/js/uikit.min.js', NULL, '1.0', true);
  wp_enqueue_script('uikit-icons', '//cdn.jsdelivr.net/npm/uikit@3.10.1/dist/js/uikit-icons.min.js', NULL, '1.0', true);
}

add_action('wp_enqueue_scripts', 'load_vendor_scripts');

// function el_virtuoso() {
  // wp_enqueue_script('uikit', get_theme_file_uri('/assets/scripts/uikit.script.js'), '1.0', true);
  // wp_enqueue_style('uikit', '//cdn.jsdelivr.net/npm/uikit@3.8.0/dist/css/uikit.min.css');
// }

// add_action('wp_enqueue_scripts', 'el_virtuoso');

function elVirtuoso_features () {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  register_nav_menu('header_menu-desktop', 'Header Menu - Desktop');
  register_nav_menu('header_menu-overlay', 'Overlay Navigation Menu - Mobile');
}

add_action('after_setup_theme', 'elVirtuoso_features');

function add_file_types_to_uploads($file_types){
  $new_filetypes = array();
  $new_filetypes['svg'] = 'image/svg+xml';
  $file_types = array_merge($file_types, $new_filetypes );
  return $file_types;
}

add_filter('upload_mimes', 'add_file_types_to_uploads');
/**
 * 1. get the manifest.json file built by webpack when compiling and then decode the JSON
 * 2. for each entry in the JSON file, get the `$key` and the `$value`
 * 3. check if the key ends in `.css` using a regular expression
 */

function load_fonts() {
  wp_enqueue_style('font-avenir-black', 'fonts/AvenirLTStd-Black.woff2');
}

add_action('wp_enqueue_scripts', 'load_fonts');

?>