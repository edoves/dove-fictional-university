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
                        href="<?php echo get_post_type_archive_link('event');?>"> 
                        <i class="fa fa-home" aria-hidden="true"></i> Events Home
                    </a> 
                    <span class="metabox__main"><?php the_title(); ?></span>
                </p>
            </div>

            <div class="generic-content">
                <?php the_content(); ?>
            </div>
            <?php 
                // relation ship field type output
                $related_programs = get_field( 'related_programs' ); // ACF field name related_programs
                // echo '<pre>';
                // print_r($related_programs); //check to see the return value of the variable $related_programs
                // echo '</pre>';
                // if has a related programs run this code
                if( $related_programs ) {
                    echo '<hr class="section-break">';
                    echo '<h2 class="headline headline--medium">Realted Program(s)</h2>';
                    echo '<ul class="link-list min-list">';
                    // loop through $related_programs
                    foreach( $related_programs as $program) { ?>
                    <li><a href="<?php echo get_the_permalink($program); ?>"><?php echo get_the_title($program); ?></a></li>
                    <?php  }
                    echo '</ul>';
                   
                }
            ?>
           
        </div>

<?php } ?>


<?php get_footer(); ?>