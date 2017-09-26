<?php

// SOUNDCLOUD PLAYLIST

function ltv_get_playlist () {
   
    $playlist_query = new WP_Query( "name=home" );
    if ( $playlist_query->have_posts() ) :
        while ( $playlist_query->have_posts() ) : $playlist_query->the_post(); ?>  
         
            <div id="sidebar_playlist">
                <?php 
                $media = str_replace( "src=", "data-src=", get_field("home_soundcloud") );
                echo strip_tags( $media, '<iframe>' );
                ?>
            </div>

        <?php
        endwhile;
        wp_reset_postdata();
    endif;

}

// NEWS 

function ltv_get_news () {

    $news_query = new WP_Query( "post_type=news" );
    // LOOP THROUGH POSTS
    if ( $news_query->have_posts() ) :
        while ( $news_query->have_posts() ) : $news_query->the_post(); ?>  
         
            <div class="main_item">

                <!-- IMAGE -->
                <div class="main_image">
                    <?php 
                    $image = get_field("news_image");
                    $image_class = get_field("news_image_size");
                    ltv_image_object( $image, $image_class );
                    ?>
                </div>

                <div class="item_content">
                    <!-- IMAGE CREDITS -->
                    <h4 class="image_credit"><?php the_field("news_image_credits"); ?></h4>
                    <!-- TITLE -->
                    <h1 class="news_title">
                        <span class="fr"><?php the_title(); ?></span>
                        <span class="en">
                            <?php if ( get_field("news_title_en") ) {
                                the_field("news_title_en"); 
                            } else {
                                the_title();
                            } ?>    
                        </span>
                    </h1>
                    <!-- TEXT -->
                    <div class="text_block">
                        <div class="fr"><?php the_field("news_text"); ?></div>
                        <div class="en">
                            <?php 
                            if ( get_field("news_text_en") ) {
                                the_field("news_text_en");
                            } else {
                                echo "No English translation.";
                            } ?> 
                        </div>
                    </div>
                    <!-- ADDITIONAL MEDIA -->
                    <?php if ( get_field("news_media") ) { ?>
                        <div class="text_block">
                            <?php 
                            // LAZYLOAD MEDIA
                            $media = str_replace( "src=", "data-src=", get_field("news_media") );
                            echo strip_tags( $media, '<iframe>' );
                            // the_field("news_media"); 
                            ?>
                        </div>
                    <?php } ?>
                </div>

            </div>

        <?php
        endwhile;
        wp_reset_postdata();
    endif;

}

// ABOUT 

function ltv_get_about () {

    $about_query = new WP_Query( "name=about" );
    // LOOP THROUGH POSTS
    if ( $about_query->have_posts() ) :
        while ( $about_query->have_posts() ) : $about_query->the_post(); ?>   

            <div class="main_item">

                <!-- IMAGE -->
                <div class="main_image">
                    <?php
                    $image = get_field("about_image");
                    $image_class = get_field("about_image_size");
                    ltv_image_object( $image, $image_class );
                    ?>
                </div>

                <div class="item_content">

                    <!-- IMAGE CREDITS -->
                    <h4 class="image_credit"><?php the_field("about_image_credits"); ?></h4>
                     
                    <div class="title_wrapper">
                        <h1>
                            <span class="fr">À propos</span>
                            <span class="en">About</span>
                        </h1>
                    </div>

                    <!-- TEXT -->
                    <div class="text_block">
                        <div class="fr"><?php the_field("about_text"); ?></div>
                        <div class="en">
                            <?php if ( get_field("about_text_en") ) {
                                the_field("about_text_en"); 
                            } else {
                                echo "No English translation.";
                            } ?>        
                        </div>
                    </div>

                </div>  

            </div>

        <?php
        endwhile;
        wp_reset_postdata();
    endif;

}

// PROJECTS 

function ltv_get_projects () {

    $projects_query = new WP_Query( "post_type=projects" );
    // LOOP THROUGH POSTS
    if ( $projects_query->have_posts() ) : ?>

        <div class="main_item">

            <div class="">
                         
                <div class="title_wrapper">
                    <h1>
                        <span class="fr">Projets</span>
                        <span class="en">Projects</span>
                    </h1>
                </div>

                <ul id="project_list">

                    <?php 
                    while ( $projects_query->have_posts() ) : $projects_query->the_post(); 
                        global $post;
                        $post_slug = $post->post_name;
                        ?>   

                        <li>
                            <a href="#projects/<?php echo $post_slug; ?>" data-title="<?php echo $post_slug; ?>"><?php the_title(); ?></a>
                        </li>

                    <?php 
                    endwhile;
                    wp_reset_postdata(); ?>

                </ul>

                <div id="project_wrapper"></div>

            </div>

        </div>

    <?php 
    endif;

}

function ltv_get_project_item ( $request_data ) {

    $parameters = $request_data->get_params();

    $projects_query = new WP_Query( array( 
        // 'p' => $parameters["id"],
        'name'      => $parameters["name"], 
        'post_type' => 'projects' 
    ) );

    $data = array();
    // LOOP THROUGH POSTS
    if ( $projects_query->have_posts() ) :
        while ( $projects_query->have_posts() ) : $projects_query->the_post();  
            global $post;
            $post_slug = $post->post_name;  
            $data[] = array(
                'title'             => get_the_title(),
                'slug'              => $post_slug,
                'id'                => get_the_ID(), 
                'image'             => get_field("project_image"),
                'image_class'       => get_field("project_image_size"),
                'image_credit'      => get_field("project_image_credits"),
                'text'              => get_field("project_text"),
                'text_en'           => get_field("project_text_en"),
                'musicians'         => get_field("project_musicians"),
                'musicians_en'      => get_field("project_musicians_en"),
                'playlist'          => get_field("project_playlist"),
                'media'             => get_field("project_media"),
                'documents'         => get_field("project_documents"),
                'social_media'      => get_field("project_social_media")
            );
        endwhile;
        wp_reset_postdata();
    endif;
    // RETURN DATA
    if ( empty( $data ) ) {
        return null;
    }   
    return $data;

}

// CONCERTS

function isPast ( $date ) {
    // CURRENT DATE
    $today = explode( "/", date("d/m/Y") );
    $today_day = $today[0];
    $today_month = $today[1];
    $today_year = $today[2];
    // INPUT DATE // FORMAT: 2017-03-31 19:00:00
    $show = explode( "-", $date );
    $show_year = $show[0];
    $show_month = $show[1];
    $show_day = $show[2];

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

function ltv_get_upcoming () {

    $agenda_query = new WP_Query( "post_type=concerts" );
    // LOOP THROUGH POSTS
    if ( $agenda_query->have_posts() ) :
        while ( $agenda_query->have_posts() ) : $agenda_query->the_post(); 
        
            // FILTER USING ISPAST FILTER
            if ( !isPast( get_field("concert_date") ) ) { ?>
                
                <div class="concert">
                    <div class="concert_date"><h2><?php the_field("concert_date"); ?></h2></div>
                    <div class="concert_info">
                        <p class="concert_group">
                            <?php $group = get_field("concert_group"); ?>
                            <a href="#projects/<?php echo $group[0]->post_name; ?>">
                                <?php echo $group[0]->post_name; ?>
                            </a>
                        </p>
                        <p><a target="_blank" href="<?php the_field('concert_venue_link'); ?>"><?php the_field("concert_venue_name"); ?></a></p>
                    </div>
                </div>

            <?php 
            }

        endwhile;
        wp_reset_postdata();
    endif;

}

function ltv_get_upcoming_data () {

    $agenda_query = new WP_Query( "post_type=concerts" );
    $data = array();
    // LOOP THROUGH POSTS
    if ( $agenda_query->have_posts() ) :
        $i = 0;
        while ( $agenda_query->have_posts() ) : $agenda_query->the_post(); 
            // FILTER USING ISPAST FILTER
            if ( !isPast( get_field("concert_date") ) ) {
                $data[] = array(
                    'title'     => get_the_title(),
                    'date'      => get_field("concert_date"),
                    'venue'     => get_field("concert_venue_name"),
                    'link'      => get_field("concert_venue_link"),
                    'group'     => get_field("concert_group")
                );
            }
        endwhile;
        wp_reset_postdata();
    endif;
    // RETURN DATA
    if ( empty( $data ) ) {
        return null;
    }    
    return $data;

}

function ltv_get_previous () {

    $agenda_query = new WP_Query( "post_type=concerts" );
    // LOOP THROUGH POSTS
    if ( $agenda_query->have_posts() ) :
        while ( $agenda_query->have_posts() ) : $agenda_query->the_post(); 

            // FILTER USING ISPAST FILTER
            if ( isPast( get_field("concert_date") ) ) { ?>
                
                <div class="concert">
                    <div class="concert_date"><h2><?php the_field("concert_date"); ?></h2></div>
                    <div class="concert_info">
                        <p class="concert_group">
                            <?php $group = get_field("concert_group"); ?>
                            <a href="#projects/<?php echo $group[0]->post_name; ?>">
                                <?php echo $group[0]->post_name; ?>
                            </a>
                        </p>
                        <p><a target="_blank" href="<?php the_field('concert_venue_link'); ?>"><?php the_field("concert_venue_name"); ?></a></p>
                    </div>
                </div>   

            <?php }

        endwhile;
        wp_reset_postdata();
    endif;

}

function ltv_get_previous_data () {

    $agenda_query = new WP_Query( "post_type=concerts" );
    $data = array();
    // LOOP THROUGH POSTS
    if ( $agenda_query->have_posts() ) :
        $i = 0;
        while ( $agenda_query->have_posts() ) : $agenda_query->the_post(); 
            // FILTER USING ISPAST FILTER
            // echo get_field("concert_date") . ", ";
            if ( isPast( get_field("concert_date") ) ) {
                $data[] = array(
                    'title'     => get_the_title(),
                    'date'      => get_field("concert_date"),
                    'venue'     => get_field("concert_venue_name"),
                    'link'      => get_field("concert_venue_link"),
                    'group'     => get_field("concert_group")
                );
            }
        endwhile;
        wp_reset_postdata();
    endif;
    // RETURN DATA
    if ( empty( $data ) ) {
        return null;
    }    
    return $data;

}

function ltv_get_concerts () { ?>

    <div class="main_item">

        <div class="item_content">
            
            <div class="title_wrapper">
                <h1>
                    <span class="fr">Concerts à venir</span>
                    <span class="en">Upcoming Concerts</span>
                </h1>
            </div>
            <div class="filter"></div>
            <div id="concerts_upcoming">
                <?php ltv_get_upcoming(); ?>
            </div>

            <div class="title_wrapper">
                <h1>
                    <span class="fr">Concerts passés</span>
                    <span class="en">Previous Concerts</span>
                </h1>
            </div>
            <div class="filter"></div>
            <div id="concerts_previous">
                <?php ltv_get_previous(); ?>   
            </div>

        </div> 

    </div>

<?php 
}

// DISCOGRAPHY

function ltv_get_discography () {

    $albums_query = new WP_Query( "post_type=albums" );
    // LOOP THROUGH POSTS
    if ( $albums_query->have_posts() ) : ?>

        <div class="main_item">
             
            <div class="item_content">

                <div class="title_wrapper">
                    <h1>
                        <span class="fr">Discographie</span>
                        <span class="en">Discography</span>
                    </h1>
                </div>    

                    <?php while ( $albums_query->have_posts() ) : $albums_query->the_post(); ?>    
                        
                        <div class="album">
                            
                            <div class="album_column">

                                <div class="album_image">
                                    <?php
                                    $image = get_field("album_cover");
                                    ltv_image_object( $image, $image_class );
                                    ?>
                                </div>

                                <p class="album_title"><?php the_title(); ?></p>
                                <p>
                                    <?php $group = get_field("album_group"); ?>
                                    <a href="#projects/<?php echo $group[0]->post_name; ?>">
                                        <?php echo $group[0]->post_title; ?>
                                    </a>
                                </p>
                                <p>
                                    <a target="_blank" href="<?php the_field('album_link_label'); ?>"><?php the_field('album_label'); ?></a>
                                </p>
                                <p><?php the_field('album_year'); ?></p>

                            </div>

                            <div class="album_column">

                                <div class="album_info">
                                    
                                    <div class="fr"><?php the_field('album_musicians'); ?></div>
                                    <div class="en">
                                        <?php if ( get_field('album_musicians_en') ) {
                                            the_field('album_musicians_en');
                                        } else {
                                            the_field('album_musicians');
                                        } ?>                                            
                                    </div>

                                    <div class="fr"><?php the_field('album_other_info'); ?></div>
                                    <div class="en">
                                        <?php if ( get_field('album_other_info_en') ) {
                                            the_field('album_other_info'); 
                                        } else {
                                            echo "No English translation.";
                                        } ?>                                            
                                    </div>

                                </div>
                                <h1>
                                    <a class="album_buy" target="_blank" href="<?php the_field('link_buy_online'); ?>">
                                        <span class="fr">Acheter en ligne</span>
                                        <span class="en">Buy Online</span>
                                    </a>
                                </h1>

                            </div>

                        </div>

                        <?php 

                        //     'reviews'           => get_field("album_online_reviews"),
                        //     'prizes'            => get_field("album_prizes"),

                        ?>
               
                    <?php 
                    endwhile;
                    wp_reset_postdata(); ?>

            </div>

        </div><!-- END OF .MAIN_ITEM -->
    
    <?php 
    endif;

}

function ltv_get_album_data () {
    $albums_query = new WP_Query( "post_type=albums" );
    $data = array();
    // LOOP THROUGH POSTS
    if ( $albums_query->have_posts() ) :
        while ( $albums_query->have_posts() ) : $albums_query->the_post();    
            $data[] = array(
                'title'             => get_the_title(),
                'image'             => get_field("album_cover"),
                'group'             => get_field("album_group"),
                'year'              => get_field("album_year"),
                'label'             => get_field("album_label"),
                'label_link'        => get_field("album_link_label"),
                'musicians'         => get_field("album_musicians"),
                'other_info'        => get_field("album_other_info "),
                'buy'               => get_field("link_buy_online "),
                'reviews'           => get_field("album_online_reviews"),
                'prizes'            => get_field("album_prizes"),
            );
        endwhile;
        wp_reset_postdata();
    endif;
    // RETURN DATA
    if ( empty( $data ) ) {
        return null;
    }   
    return $data;
}

// LINKS

function ltv_get_links () {

    $links_query = new WP_Query( "name=links" );
    // LOOP THROUGH POSTS
    if ( $links_query->have_posts() ) :
        while ( $links_query->have_posts() ) : $links_query->the_post(); ?>

            <div class="main_item">

                <div class="item_content">
                             
                    <div class="title_wrapper">
                        <h1>
                            <span class="fr">Liens</span>
                            <span class="en">Links</span>
                        </h1>
                    </div>

                    <div class="text_block">
                        <!-- GROUPS -->
                        <?php if ( have_rows("links_groups") ) { ?>
                            <h2>Groups</h2>
                            <ul>
                                <?php while ( have_rows("links_groups") ) : the_row("links_groups"); ?>
                        
                                    <li><a target="_blank" href="<?php the_sub_field("link_url"); ?>"><?php the_sub_field("link_title"); ?></a></li>  
                                
                                <?php endwhile; ?>
                            </ul>
                        <?php } ?>

                        <!-- LABELS -->
                        <?php if ( have_rows("links_labels") ) { ?>
                            <h2>Labels</h2>
                            <ul>
                                <?php while ( have_rows("links_labels") ) : the_row("links_labels"); ?>
                        
                                    <li><a target="_blank" href="<?php the_sub_field("link_url"); ?>"><?php the_sub_field("link_title"); ?></a></li>  
                                
                                <?php endwhile; ?>
                            </ul>
                        <?php } ?>

                        <!-- OTHER -->
                        <?php if ( have_rows("links_other") ) { ?>
                            <h2>Other</h2>
                            <ul>
                                <?php while ( have_rows("links_other") ) : the_row("links_other"); ?>
                        
                                    <li><a target="_blank" href="<?php the_sub_field("link_url"); ?>"><?php the_sub_field("link_title"); ?></a></li>  
                                
                                <?php endwhile; ?>
                            </ul>
                        <?php } ?>

                    </div><!-- END OF .TEXT_BLOCK -->

                </div>  
            </div>

        <?php 
        endwhile;
        wp_reset_postdata();
    endif;

}

// CONTACT

function ltv_get_contact () {

    $contact_query = new WP_Query( "name=contact" );
    // LOOP THROUGH POSTS
    if ( $contact_query->have_posts() ) :
        while ( $contact_query->have_posts() ) : $contact_query->the_post(); ?>    

            <div class="main_item">

                <div class="item_content">

                    <div class="text_block">        
                        <div class="title_wrapper">
                            <h1>
                                <span>Contact</span>
                            </h1>
                        </div>

                        <div>
                            <a href="mailto:<?php the_field('contact_main'); ?>"><?php the_field('contact_main'); ?></a>
                        </div>
                    </div>

                </div>  

            </div>
        
        <?php
        endwhile;
        wp_reset_postdata();
    endif;

}

// SOCIAL MEDIA

function ltv_social_media () {

    $social_media_query = new WP_Query( "name=home" );
    // LOOP THROUGH POSTS
    if ( $social_media_query->have_posts() ) :
        while ( $social_media_query->have_posts() ) : $social_media_query->the_post(); 
        
            if ( have_rows("home_social_media_links") ) {
                while ( have_rows("home_social_media_links") ) : the_row("home_social_media_links"); ?>    

                    <a target="_blank" href="<?php the_sub_field("home_social_media_link"); ?>">
                        <?php // GET ICON
                        $link = get_sub_field("home_social_media_link");
                        if ( strpos ( $link, "youtube" ) !== false ) {
                            $imgSrc = get_bloginfo('template_url') . "/assets/img/youtube.svg";
                        } else if ( strpos ( $link, "vimeo" ) !== false ) {
                            $imgSrc = get_bloginfo('template_url') . "/assets/img/vimeo.svg";
                        } else if ( strpos ( $link, "soundcloud" ) !== false ) {
                            $imgSrc = get_bloginfo('template_url') . "/assets/img/soundcloud.svg";
                        } else if ( strpos ( $link, "facebook" ) !== false ) {
                            $imgSrc = get_bloginfo('template_url') . "/assets/img/facebook.svg";
                        } ?>
                        <img src="<?php echo $imgSrc; ?>" />
                    </a>

                <?php
                endwhile;
            } 
    
        endwhile;
        wp_reset_postdata();
    endif;

}


// REGISTER END POINTS

add_action( 'rest_api_init', function () {

    // PROJECTS
    register_rest_route( 'custom/v1', '/projects/', array(
        'methods'   => 'GET',
        'callback'  => 'ltv_get_project_item',
        'args'      => array(
            'name' => array(
                'default' => false,
                'sanitize_callback' => 'sanitize_title',
            )
        ),
    ) );
    // CONCERTS
    register_rest_route( 'custom/v1', '/upcoming/', array(
        'methods' => 'GET',
        'callback' => 'ltv_get_upcoming_data',
    ) );
    register_rest_route( 'custom/v1', '/previous/', array(
        'methods' => 'GET',
        'callback' => 'ltv_get_previous_data',
    ) );
    // ALBUMS
    register_rest_route( 'custom/v1', '/albums/', array(
        'methods' => 'GET',
        'callback' => 'ltv_get_album_data',
    ) );

} );

?>