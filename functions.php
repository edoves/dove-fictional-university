<?php

//page header background
function page_banner( $args = NULL ) {
    // $subtitle = get_field('page_banner_subtitle');
    //php logice will live here
    if( !$args['title'] ) {
        $args['title'] = get_the_title();
    }


    if( !$args['sub_title'] ) {
        $args['sub_title'] = get_field('page_banner_subtitle');
    }



    if( !$args['photo'] ) {
        if( get_field('page_banner_background_image') ) {
            $args['photo'] = get_field('page_banner_background_image')['sizes']['page_banner'];
        } else {
            $args['photo'] = get_theme_file_uri( '/images/ocean.jpg' );
        }
    }

    ?>
        <div class="page-banner">
            <div class="page-banner__bg-image" 
                style="background-image: url(
                    <?php 
                        echo $args['photo'];
                    ?>);">           
            </div>
                <div class="page-banner__content container container--narrow">
            
                    <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
                    <div class="page-banner__intro">
                        <p><?php echo $args['sub_title'];?></p>
                    </div>
            </div>  
       </div>

<?php }

/**
 *  Add Theme support
 */
add_action( 'after_setup_theme', 'university_features');
function university_features() {
    /**
     *  <title> tag support
     */
    add_theme_support( 'title-tag' );

    /**
     * Support feature image
     */
    add_theme_support( 'post-thumbnails' );

    /**
     * Add image size
     */
    add_image_size( 'professor_landscape', 400, 200, true );
    add_image_size( 'professor_portrait', 480, 650, true );
    add_image_size( 'page_banner', 1500, 350, true );

}

add_action( 'wp_enqueue_scripts', 'university_files');
function university_files() {
    wp_enqueue_style( 'custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i' );
    wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );    
    // wp_enqueue_style( 'university_main_styles', get_stylesheet_uri() );

    // development setup to avoid css caching use microtime function in version depencedy paramater
    wp_enqueue_style( 'university_main_styles', get_stylesheet_uri(), NULL, microtime() );

    // wp_enqueue_script( 'main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true );
    // development setup to avoid javascript  caching use microtime function in version depencedy paramater
    wp_enqueue_script( 'main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true );
}


// edit default quries or Manipulating Default URL Based Queries
add_action( 'pre_get_posts', 'university_adjust_query' );
function university_adjust_query( $query ) {
    if( !is_admin() && is_post_type_archive( 'program' ) && $query->is_main_query() ) {
        $query->set('orderby', 'title');
        $query->set('order', 'DESC');
        $query->set('posts_per_page', -1);
    }

    if( !is_admin() && is_post_type_archive( 'event' ) && $query->is_main_query( ) ) {
        $today = date('Ymd');
        $query->set('meta_key','event_date');
        $query->set('orderby','menu_value_num');
        $query->set('order','ASC');
        $query->set('meta_query', array(
            array(
              'key'     => 'event_date',
              'compare' => '>=',
              'value'   => $today,
              'type'    => 'numeric'
            )
          ));
    }     
}
 
 