<?php
function elVirtuoso_post_types() {
  register_post_type('work_project', array(
    'public' => true,
    'show_in_rest' => true,
    'labels' => array(
     'name' => 'Work/Project',
     'add_new_item' => 'Add new work/project',
     'edit_item' => 'Edit work/project',
     'all_items' => 'All works/projects',
     'singular_name' => 'Work/Project'
    ),
    'menu_icon' => 'dashicons-hammer'
  ));
}

add_action('init', 'elVirtuoso_post_types')
?>
