<?php get_header(); ?>

<?php
    while( have_posts() ) {
      the_post(  ); 
      
      page_banner();

      ?>


        <div class="container container--narrow page-section">
        <?php 
                // echo '<pre>';
                // print_r($page_banner_image); //check to see the return value of the variable $related_programs
                // echo '</pre>';
            ?>
            <div class="generic-content">
                <div class="row group">

                    <div class="one-third">
                    <!-- it willl echo the iamge on the front end -->
                    <?php the_post_thumbnail('professor_portrait'); ?>
                    </div>

                    <div class="two-thirds">
                    <?php the_content(); ?>
                    </div>
                </div>
            </div>
            <?php 
                // realtion ship field type output
                $related_programs = get_field( 'related_programs' ); // ACF field name related_programs
                // echo '<pre>';
                // print_r($related_programs); //check to see the return value of the variable $related_programs
                // echo '</pre>';
                // if has a related programs run this code
                if( $related_programs ) {
                    echo '<hr class="section-break">';
                    echo '<h2 class="headline headline--medium">Subject(s) Taught</h2>';
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