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
    wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js');
//    wp_register_script( 'jquery', get_template_directory_uri() . '/js/_jquery.js');
    wp_enqueue_script( 'jquery' );  
    
//    wp_enqueue_script('jquery', get_template_directory_uri() . '/js/_jquery.js', true);
    wp_enqueue_script('all-scripts', get_template_directory_uri() . '/js/scripts.min.js', array('jquery'), true);

    wp_register_script( "custom_ajax", get_template_directory_uri() . '/js/custom_ajax.js', array('jquery') );
    wp_localize_script( "custom_ajax", "myAjax", array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );        
    wp_enqueue_script( "custom_ajax" );

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
        // 'taxonomies' => array('archive-cat'),
        'has_archive' => true,
        'supports' => array('editor','title'),
        'menu_position' => 5
        )
    );
    register_post_type( 'concerts',
    array(
        'labels' => array(
            'name' => __( 'Concerts' )
        ),
        'public' => true,
        // 'taxonomies' => array('category'),
        'has_archive' => true,
        'supports' => array('editor','title'),
        'menu_position' => 6
        )
    );
}

// AJAX LAZY LOADING

add_action( 'wp_ajax_loader', 'ajax_load' );
add_action( 'wp_ajax_nopriv_loader', 'ajax_load' );

function ajax_load () {
    if ( isset($_REQUEST) ) {
        // THE $_REQUEST CONTAINS ALL THE DATA SENT VIA AJAX
        $section = $_REQUEST['section'];
        switch ( $section ) {
            case "about" : 
                $new_data = include( "includes/03_about.php" );
                break;
            case "concerts" : 
                $new_data = include( "includes/04_concerts.php" );
                break;
            case "media" : 
                $new_data = include( "includes/05_media.php" );
                break;
            case "links" : 
                $new_data = include( "includes/06_links.php" );
                break;
            case "partners" : 
                $new_data = include( "includes/07_partners.php" );
                break;
            default: 
                $new_data = include( "includes/02_news.php" );
        }
        echo $new_data;  
        // FOR DEBUGGING
        // print_r($_REQUEST);
    }
    // ALWAYS DIE IN FUNCTIONS ECHOING AJAX CONTENT
    wp_die();
}

// IMAGE OBJECT

    // ADD CUSTOM IMAGE SIZES
add_theme_support( 'post-thumbnails' );
add_image_size( 'extralarge', 1200, 1200 );

function image_object( $image ) {
    if( !empty($image) ): 
        $width = $image['sizes'][ 'thumbnail-width' ];
        $height = $image['sizes'][ 'thumbnail-height' ];
        $thumb = $image['sizes'][ "thumbnail" ]; // 300
        $medium = $image['sizes'][ "medium" ]; // 600
        $large = $image['sizes'][ "large" ]; // 900
        $extralarge = $image['sizes'][ "extra-large" ]; // 1200
        $id = $image["id"];
        // DEFAULT IS FULL WIDTH
        if ( $height / $width >= 0.5 && $height / $width < 1 ) {
            $class = "two-thirds";
        } else if ( $height / $width >= 1 ) {
            $class = "one-third";
            // PORTRAIT MODE
            // $thumb = $image['sizes'][ "medium" ];
            // $medium = $image['sizes'][ "large" ];
            // $large = $image['url']; 
            // $extralarge =
        } else {
            $class = "full-width"; 
        }
        echo "<img class='" . $class . " ' 
            alt='Le Ton Vertical' 
            width='" . $width . "' 
            height='" . $height . "' 
            data-thm='" . $thumb . "' 
            data-med='" . $medium . "' 
            data-lrg='" . $large . "' 
            data-xlg='" . $extralarge . "' 
            src=' " . $thumb . "' />";
    endif;
}

// ADD CUSTOM QUERY

function add_custom_query_var( $vars ){
    $vars[] = "p";
    return $vars;
}
add_filter( 'query_vars', 'add_custom_query_var' );

// PAGE REDIRECT

function page_redirect ($query) {
    switch ($query) {
        case "about":
            include("includes/03_about.php");       
            break;
        case "concerts":
            include("includes/04_concerts.php");
            break;
        case "media":
            include("includes/05_media.php");
            break;
        case "links":
            include("includes/06_links.php");
            break;
        case "partners":
            include("includes/07_partners.php");
            break;
        default:
            include("includes/02_news.php");
            // CLEAR QUERY WITH JAVASCRIPT
            break;
    }    
}

// AGENDA / ARCHIVE

    // DATE CHECKER

function isPast ( $date ) {
    // CURRENT DATE
    $today = explode( "/", date("d/m/Y") );
    $today_day = $today[0];
    $today_month = $today[1];
    $today_year = $today[2];
    // INPUT DATE
    $show = explode( "–", $date );
    $show_day = $show[0];
    $show_month = $show[1];
    $show_year = $show[2];

    $past = false;
    // IF YEAR IS IN PAST
    if ( $show_year < $today_year ) {
        $past = true;
    // IF YEAR IS CURRENT
    } else if ( $show_year === $today_year ) {
        // IF MONTH IS IN PAST
        if ( $show_month < $today_month ) {
            $past = true;
        } else if ( $show_month === $today_month ) {
            // IF DAY IS IN PAST
            if ( $show_day < $today_day ) {
                $past = true; 
            }
        } 
    } 
    return $past;
}

function get_future_concerts () {
    $agenda_query = new WP_Query( "post_type=concerts" );
    if ( $agenda_query->have_posts() ) :
        echo "<ul>";
        while ( $agenda_query->have_posts() ) : $agenda_query->the_post(); 
            $date = get_field("concert_date");
            ?>
            <li>
                <?php // IF IN FUTURE
                if ( !isPast( $date ) ) {
                    the_title();
                    the_field("concert_date");
                } ?>
            </li>
            <?php
        endwhile;
        echo "</ul>";
        wp_reset_postdata();
    endif;
}

function get_past_concerts () {
    $agenda_query = new WP_Query( "post_type=concerts" );
    if ( $agenda_query->have_posts() ) :
        echo "<ul>";
        while ( $agenda_query->have_posts() ) : $agenda_query->the_post(); 
            $date = get_field("concert_date");
            ?>
            <li>
                <?php // IF IN PAST
                if ( isPast( $date ) ) {
                    the_title();
                    the_field("concert_date");
                } ?>
            </li>
            <?php
        endwhile;
        echo "</ul>";
        wp_reset_postdata();
    endif;
}

?>