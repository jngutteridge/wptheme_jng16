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
    $href = get_template_directory_uri();
    echo '<link rel="stylesheet" type="text/css" href="' . $href . '/css/screen.css" />';
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

function get_latest_writing()
{
    $posts = wp_get_recent_posts (
        array(
            'numberposts' => 5,
            'post_status' => 'publish'
        ),
        OBJECT
    );

    foreach ($posts as $post) :

        echo '<article class="post page">';
        echo    '<header class="post">';
        echo        '<div class="container">';
        echo            '<h2><a href="' . get_permalink($post->ID) . '">' . $post->post_title . '</a></h2>';
        echo            '<time>' . date('jS F Y', strtotime($post->post_date)) . '</time>';
        echo        '</div>';
        echo    '</header>';
        echo    '<aside class="action post">';
        echo        '<div class="container">';
        echo            '<a class="action" href="' . get_permalink($post->ID) . '">' . 'Read article' . '</a>';
        echo        '</div>';
        echo    '</aside>';
        echo '</article>';

    endforeach;
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

function get_header_nav()
{
    if (get_page_class() !== 'frontpage')
        get_template_part ('header-nav');
}
