<?php

if ( ! function_exists( 'already_setup' ) ) {
    function already_setup() {
        add_theme_support('post-thumbnails');

        register_nav_menus(
            array(
                'top' => 'Top Menu',
            )
        );
    }
}
add_action( 'after_setup_theme', 'already_setup' );


function already_load_scripts() {
    wp_enqueue_script('webpack', get_template_directory_uri(). '/assets/js/scripts.js');
    wp_localize_script( 'webpack', 'already', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'already_load_scripts' );


function already_load_styles() {
    wp_enqueue_style('webpack', get_template_directory_uri(). '/assets/css/main.css');
}
add_action( 'wp_enqueue_scripts', 'already_load_styles' );


add_filter('acf/settings/save_json', 'already_acf_json_save_point');

function already_acf_json_save_point( $path ) {
    return get_stylesheet_directory() . '/acf-json';
}


function get_films() {
    $args = [
        'post_type' => 'movies',
        'posts_per_page' => 2,
        'tax_query' => [],
        'meta_query' => []
    ];

    if (isset($_GET['s']) && !empty($_GET['s'])) {
        $args['s'] = $_GET['s'];
    }

    if (isset($_GET['page']) && !empty($_GET['page'])) {
        $args['posts_per_page'] = $args['posts_per_page'] * $_GET['page'];
    }

    if (isset($_GET['genre']) && !empty($_GET['genre'])) {
        $args['tax_query'][] = [
            'taxonomy' => 'genre',
            'field'    => 'term_id',
            'terms'    => [$_GET['genre']],
            'operator' => 'IN'
        ];
    }

    if (
        isset($_GET['year_from']) && !empty($_GET['year_from']) &&
        isset($_GET['year_to']) && !empty($_GET['year_to'])
    ) {
        $args['meta_query'][] = [
            'key' => 'release_year',
            'value' => $_GET['year_from'],
            'compare' => '>=',
        ];

        $args['meta_query'][] = [
            'key' => 'release_year',
            'value' => $_GET['year_to'],
            'compare' => '<=',
        ];
    }

    if (isset($_GET['orderby']) && !empty($_GET['orderby'])) {
        $args['orderby'] = $_GET['orderby'];
    }

    if (isset($_GET['order']) && !empty($_GET['order'])) {
        $args['order'] = $_GET['order'];
    }

    $ajaxposts = new WP_Query($args);

    ob_start();

    if($ajaxposts->have_posts()) {
        while($ajaxposts->have_posts()) : $ajaxposts->the_post();
            get_template_part('template-parts/film', 'post');
        endwhile;
    } else {
        get_template_part('template-parts/content/content', 'none');
    }

    $response = ob_get_contents();
    ob_end_clean();

    echo json_encode([
        "total_count"=>$ajaxposts->found_posts,
        "current_count"=>$ajaxposts->post_count,
        "html"=>$response
    ]);
    exit();
}
add_action('wp_ajax_get_films', 'get_films');
add_action('wp_ajax_nopriv_get_films', 'get_films');