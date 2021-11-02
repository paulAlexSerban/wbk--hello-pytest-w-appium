<?php

function el_virtuoso() {
  wp_enqueue_script('front-page', get_theme_file_uri('/assets/scripts/front-page.script.js'), '1.0', true);
  wp_enqueue_script('uikit', get_theme_file_uri('/assets/scripts/uikit.script.js'), '1.0', true);

  wp_enqueue_style('generic-styles', get_theme_file_uri('/assets/styles/front-page.style.css'));
  wp_enqueue_style('uikit', '//cdn.jsdelivr.net/npm/uikit@3.8.0/dist/css/uikit.min.css');
}

add_action('wp_enqueue_scripts', 'el_virtuoso');

function elVirtuoso_features () {
  add_theme_support('title-tag');
}

add_action('after_setup_theme', 'elVirtuoso_features');

function add_file_types_to_uploads($file_types){
  $new_filetypes = array();
  $new_filetypes['svg'] = 'image/svg+xml';
  $file_types = array_merge($file_types, $new_filetypes );
  return $file_types;
  }
  add_filter('upload_mimes', 'add_file_types_to_uploads');