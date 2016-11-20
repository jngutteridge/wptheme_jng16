<?php

function add_post_slug_template($templates)
{
    $templates = array($templates);

    $object = get_queried_object();

    $templates[] = "single-{$object->post_type}-{$object->post_name}.php";
    $templates[] = "single-{$object->post_type}.php";
    $templates[] = "single.php";

    return locate_template($templates);
}

function intercept_template_hierarchy()
{
    add_filter( 'single_template', 'add_post_slug_template', 10, 1 );
}

function complete_version_removal()
{
    return '';
}

function style_admin_bar()
{
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

function set_admin_post_order($wp_query)
{
    global $pagenow;

    if ( is_admin() && 'edit.php' == $pagenow && !isset($_GET['orderby']) ) {

        $wp_query->set( 'orderby', 'date' );
        $wp_query->set( 'order', 'DSC' );
    }
}
