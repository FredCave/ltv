<?php

// SECURITY: HIDE USERNAMES
add_action(‘template_redirect’, ‘bwp_template_redirect’);
function bwp_template_redirect() {
    if ( is_author() ) {
        wp_redirect( home_url() ); 
        exit;
    }
}

// HIDE VERSION OF WORDPRESS
function wpversion_remove_version() {
    return '';
    }
add_filter('the_generator', 'wpversion_remove_version');

// ENQUEUE CUSTOM SCRIPTS
function enqueue_cpr_scripts() {
  
    wp_deregister_script( 'jquery' );
    // wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js');
// //    wp_register_script( 'jquery', get_template_directory_uri() . '/js/_jquery.js');
    // wp_enqueue_script( 'jquery' );  
    
//    wp_enqueue_script('jquery', get_template_directory_uri() . '/js/_jquery.js', true);
    // wp_enqueue_script('all-scripts', get_template_directory_uri() . '/js/scripts.min.js', array('jquery'), true);

    // wp_register_script( "custom_ajax", get_template_directory_uri() . '/js/custom_ajax.js', array('jquery') );
    // wp_localize_script( "custom_ajax", "myAjax", array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );        
    // wp_enqueue_script( "custom_ajax" );

    // wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

}
add_action('wp_enqueue_scripts', 'enqueue_cpr_scripts');

// ADD CUSTOM POST TYPES
add_action( 'init', 'create_post_types' );
function create_post_types() {
    register_post_type( 'news',
    array(
        'labels' => array(
            'name' => __( 'News' )
        ),
        'public' => true,
        'show_in_rest' => true,
        // 'taxonomies' => array('archive-cat'),
        'has_archive' => true,
        'supports' => array('editor','title'),
        'menu_position' => 5
        )
    );
    register_post_type( 'projects',
    array(
        'labels' => array(
            'name' => __( 'Projects' )
        ),
        'public' => true,
        'show_in_rest' => true,
        // 'taxonomies' => array('category'),
        'has_archive' => true,
        'supports' => array('editor','title'),
        'menu_position' => 6
        )
    );
    register_post_type( 'concerts',
    array(
        'labels' => array(
            'name' => __( 'Concerts' )
        ),
        'public' => true,
        'show_in_rest' => true,
        // 'taxonomies' => array('category'),
        'has_archive' => true,
        'supports' => array('editor','title'),
        'menu_position' => 7
        )
    );
    register_post_type( 'albums',
    array(
        'labels' => array(
            'name' => __( 'Albums' )
        ),
        'public' => true,
        'show_in_rest' => true,
        // 'taxonomies' => array('category'),
        'has_archive' => true,
        'supports' => array('editor','title'),
        'menu_position' => 8
        )
    );
}

// IMAGE OBJECT

    // ADD CUSTOM IMAGE SIZES
add_theme_support( 'post-thumbnails' );
add_image_size( 'extralarge', 1200, 1200 );

// MAKE THEME PATH ACCESSIBLE TO JS FILES

wp_register_script('custom-js', get_stylesheet_directory_uri().'/js/custom.js', array(),NULL, true);
wp_enqueue_script('custom-js');

$ltv_custom = array( 
    'stylesheet_directory_uri'  => get_stylesheet_directory_uri(),
    'root_uri'                  => get_bloginfo( 'url' )
);
wp_localize_script( 'custom-js', 'directory_uri', $ltv_custom );

function ltv_image_object( $image, $class ) {
    if( !empty($image) ): 
        $width = $image['sizes'][ 'thumbnail-width' ];
        $height = $image['sizes'][ 'thumbnail-height' ];
        $thumb = $image['sizes'][ "thumbnail" ]; // 300
        $medium = $image['sizes'][ "medium" ]; // 600
        $mediumlarge = $image['sizes'][ "medium_large" ]; 
        $large = $image['sizes'][ "large" ]; // 900
        $extralarge = $image['sizes'][ "extralarge" ]; // 1200
        $id = $image["id"];
        // PORTRAIT
        if ( $height > $width ) {
            $class = "portrait";
            $thumb = $image['sizes'][ "medium" ];
            $medium = $image['sizes'][ "large" ];
            $large = $image['sizes'][ "extralarge" ]; 
        } else {
            $class = "landscape";
        }
        echo "<img class='" . $class . " ' 
            alt='Le Ton Vertical' 
            width='" . $width . "' 
            height='" . $height . "' 
            data-thm='" . $thumb . "' 
            data-med='" . $medium . "' 
            data-mdl='" . $mediumlarge . "' 
            data-lrg='" . $large . "' 
            data-xlg='" . $extralarge . "' 
            src=' " . $thumb . "' />";
    endif;
}

// INCLUDE CONTENT FUNCTIONS

include("includes/end_points.php");

// GET PROJECTS FOR MENU

function sidebar_get_projects () {

    $projects_query = new WP_Query( "post_type=projects" ); 
    if ( $projects_query->have_posts() ) :
        while ( $projects_query->have_posts() ) : $projects_query->the_post(); 
            ?>
            <li><a href="#_projects/<?php the_ID(); ?>"><?php the_title(); ?></a></li>
        <?php
        endwhile;  
    endif; 

}

// GET EMAIL FOR SIDEBAR

function get_email () {
    $email_query = new WP_Query( "name=contact" ); 
    if ( $email_query->have_posts() ) :
        while ( $email_query->have_posts() ) : $email_query->the_post(); ?>
            <a href="mailto:<?php the_field("contact_main"); ?>">
                <?php the_field("contact_main"); ?>
            </a>
        <?php
        endwhile;  
    endif;    
}

?>