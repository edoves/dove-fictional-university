<?php get_header(); ?>

<?php
    while( have_posts() ) {
      the_post(  ); 
      page_banner();
      ?>


        <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" 
                    href="<?php echo get_post_type_archive_link('program');?>"> 
                    <i class="fa fa-home" aria-hidden="true"></i> All Programs
                </a> 
                <span class="metabox__main"><?php the_title(); ?></span>
            </p>
        </div>
            <div class="generic-content">
                <?php the_content(); ?>
            </div> 

            <?php 
                $today = date('Ymd');
                //Show list of Professor that teaches a specific topics related to the program post
                $related_professors =  new WP_Query( array(
                    'posts_per_page' => -1, /// show all post when you put
                    'post_type'      => 'professor',
                    'orderby'        => 'title', // order by alphabetically
                    'order'          => 'ASC',
                    'meta_query'     => array( 
                        array(
                            'key'     => 'related_programs', // if the array of related_prorams...
                            'compare' => 'LIKE', //contains or like...
                            'value'   => '"' . get_the_ID() . '"' //the ID number of the current program post
                        )
                    )
                ));
                // if there is a related events run this code
                if ( $related_professors->have_posts() ) {
                    echo '<hr class="section-break">';
 
                    echo '<h2 class="headline headline--medium">' . get_the_title() . ' Professors</h2>';
                    echo '<ul class="professor-cards">';

                    while( $related_professors->have_posts() ) {
                    $related_professors->the_post(); ?>

                    <li class="professor-card__list-item">
                        <a class="professor-card" href="<?php the_permalink(); ?>">
                            <img class="professor-card__image" src="<?php the_post_thumbnail_url('professor_portrait'); ?>" alt="Professors">
                            <span class="professor-card__name"><?php the_title(); ?></span>
                        </a>
                    </li>

                <?php }
                echo '</ul>';
                }

                wp_reset_postdata();

                // show the most recent event and hide the past event
                $today = date('Ymd');
                $home_page_events =  new WP_Query( array(
                    'posts_per_page' => 2, /// show all post when you put
                    'post_type'      => 'event',
                    'meta_key'       => 'event_date', // ACF meta_key is to spell out the event field created on ACF
                    'orderby'        => 'menu_value_num', // sorting numbers
                    'order'          => 'ASC',
                    'meta_query'     => array(
                        array(
                            'key'     => 'event_date', //custom field
                            'compare' => '>=', // compare
                            'value'   => $today,
                            'type'    => 'numeric' // tell wordpress what what type you going to compare
                        ),
                        array(
                            'key'     => 'related_programs', //if the array of related_prorams...
                            'compare' => 'LIKE', //contains or like...
                            'value'   => '"' . get_the_ID() . '"' //the ID number of the current program post
                        )
                    )
                ));
                // if there is a related events run this code
                if ( $home_page_events->have_posts() ) {
                    echo '<hr class="section-break">';
                    echo '<h2 class="headline headline--medium">Upcoming ' . get_the_title() . ' Events</h2>';
                    while( $home_page_events->have_posts() ) {
                    $home_page_events->the_post(); ?>
        
                     <?php get_template_part( 'template-parts/content', 'event' )?>
                     
                <?php }
                }
            ?>  
        </div>

<?php } ?>


<?php get_footer(); ?>