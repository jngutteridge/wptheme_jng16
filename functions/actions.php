<?php

add_action( 'init', 'set_post_types' );
add_action( 'init', 'set_taxonomies' );

add_action( 'template_redirect', 'intercept_template_hierarchy', 20 );

add_action( 'wp_head', 'style_admin_bar' );
