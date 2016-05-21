<?php

function set_menus() {

    //register_nav_menu('header', 'Header Navigation');
    //register_nav_menu('footer', 'Footer Navigation');
}

//add_theme_support('post-thumbnails');

//add_image_size('banner', 1260, 520, false);
//add_image_size('slide-full', 1280, 330, true);
//add_image_size('gallery-full', 880, 495);
//add_image_size('gallery-thumb', 200, 110, true);


function add_post_slug_template($templates) {

    $templates = array($templates);

    $object = get_queried_object();

    $templates[] = "single-{$object->post_type}-{$object->post_name}.php";
    $templates[] = "single-{$object->post_type}.php";
    $templates[] = "single.php";

    return locate_template($templates);
}

function intercept_template_hierarchy() {

    add_filter( 'single_template', 'add_post_slug_template', 10, 1 );
}

function complete_version_removal() {

    return '';
}

function style_admin_bar () {

    if ( is_admin_bar_showing() && !current_user_can('update_core') ) :

        echo '<style type="text/css">';
        echo     'body {';
        echo         'margin-top: -28px;';
        echo         'padding-bottom: 28px;';
        echo     '}';
        echo     'body.admin-bar #wphead {';
        echo         'padding-top: 0;';
        echo     '}';
        echo     'body.admin-bar #footer {';
        echo         'padding-bottom: 28px;';
        echo     '}';
        echo     '#wpadminbar {';
        echo         'top: auto !important;';
        echo         'bottom: 0;';
        echo     '}';
        echo     '#wpadminbar .quicklinks .menupop ul {';
        echo         'bottom: 28px;';
        echo     '}';
        echo '</style>';

    endif;
}

function degreelessness_mode() {

    $url = 'http://bespokemedia.net/js/degreelessness-mode.js';

    //if ( is_admin_bar_showing() ) :

        echo '<script type="text/javascript" src='. $url . '></script>';

    if ( is_admin_bar_showing() && current_user_can('update_core') ) :

        degreelessness_mode_dev();

    endif;
}

function set_admin_post_order($wp_query) {

    global $pagenow;

    if ( is_admin() && 'edit.php' == $pagenow && !isset($_GET['orderby']) ) {

        $wp_query->set( 'orderby', 'date' );
        $wp_query->set( 'order', 'DSC' );
    }
}


function remove_unneeded_admin_menus() {

    //remove_menu_page('edit-comments.php');
    //remove_menu_page('edit.php');
}
