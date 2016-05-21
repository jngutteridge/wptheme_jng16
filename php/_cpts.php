<?php

function set_taxonomies() {

    register_taxonomy( 'link_category', array('link'), array(

        'hierarchical'   => true,
        'label'          => 'Link Categories',
        'singular_label' => 'Link Category',
        'rewrite'        => true
    ));
}

function set_post_types() {

    register_post_type( 'link', array(

        'labels' => array(

            'name'                => _x( 'Links', 'Post Type General Name', 'text_domain' ),
            'singular_name'       => _x( 'Link', 'Post Type Singular Name', 'text_domain' ),
            'menu_name'           => __( 'Links', 'text_domain' ),
            'parent_item_colon'   => __( 'Link:', 'text_domain' ),
            'all_items'           => __( 'All links', 'text_domain' ),
            'view_item'           => __( 'View link', 'text_domain' ),
            'add_new_item'        => __( 'Add new link', 'text_domain' ),
            'add_new'             => __( 'Add new', 'text_domain' ),
            'edit_item'           => __( 'Edit link', 'text_domain' ),
            'update_item'         => __( 'Update link', 'text_domain' ),
            'search_items'        => __( 'Search link', 'text_domain' ),
            'not_found'           => __( 'Not found', 'text_domain' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
        ),
        'supports' => array(

            'title',
            'editor',
            'author',
            'excerpt',
            'custom-fields',
            'page-attributes'
        ),
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 20,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'rewrite'             => true,
        'capability_type'     => 'post',
    ));
}

