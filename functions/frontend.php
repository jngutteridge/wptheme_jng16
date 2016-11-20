<?php

function get_website_title()
{
    return wp_title('/', false, 'right') . 'Jack Gutteridge';
}

function get_header_header()
{
    echo '<!DOCTYPE html>';
    echo '<html>';
}

function get_stylesheet_link()
{
    echo '<link rel="stylesheet" type="text/css" href="/wp-content/themes/jng16/css/screen.css" />';
}

function set_page_class($class)
{
    global $jng_page_class;
    $jng_page_class = $class;
}

function get_page_class()
{
    global $jng_page_class;

    return isset ($jng_page_class) ? $jng_page_class : '';
}

function get_header_footer()
{
    echo '<body class="' . join ( ' ', get_body_class (get_page_class()) ) . '">';
}

function get_footer_footer()
{
    echo '</body>';
    echo '</html>';
}

function get_latest_writing_list()
{
    $rps = wp_get_recent_posts ( null, OBJECT );

    echo '<ul>';

    foreach ( $rps as $p )

        echo '<li><a href="' . get_permalink($p->ID) . '">' . $p->post_title . ' / <time>' . date('jS F Y', strtotime($p->post_date)) . '</time></a></li>';

    echo '</ul>';
}

function get_archive_index()
{
    $aps = new WP_Query([ 'post_type' => 'post', 'posts_per_page' => -1 ]); // archive posts

    while ($aps->have_posts()) :

        $aps->the_post();

        echo '<article class="post page">';
        echo    '<header class="post">';
        echo        '<div class="container">';
        echo            '<h2><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h2>';
        echo            '<time>' . get_the_date() . '</time>';
        echo        '</div>';
        echo    '</header>';
        echo    '<aside class="action post">';
        echo        '<div class="container">';
        echo            '<a class="action" href="' . get_the_permalink() . '">' . 'Read article' . '</a>';
        echo        '</div>';
        echo    '</aside>';
        echo '</article>';

    endwhile;

    wp_reset_postdata();
}
