<?php get_header(); ?>

    <?php
    while(have_posts()) {
        the_post(); 

        page_banner();

        ?>
        
        <div class="container container--narrow page-section">
        <?php 
           $the_parent = wp_get_post_parent_id( get_the_ID() ); // it will return 0 if you are in a parent page it will return true if you are on the child page
           if ( $the_parent ) { ?>
           <?php echo $the_parent; ?>
             <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                    <a class="metabox__blog-home-link" 
                        href="<?php echo get_the_permalink($the_parent); ?>">
                        <i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($the_parent); ?> 
                    </a> 
                    <span class="metabox__main"><?php the_title(); ?></span></p>
            </div>

        <?php } ?>
           
            <?php 
                $testArray = get_pages( array(
                    'child_of'  => get_the_ID()
                ));

            if ( $the_parent || $testArray) { ?>
                <div class="page-links">
                    <?php if ( $the_parent ) { ?>
                        <h2 class="page-links__title">
                            <a href="<?php echo get_the_permalink( $the_parent );?>">
                            <?php echo get_the_title( $the_parent ); ?>
                            </a>
                        </h2>
                    <?php } ?> 
                    <ul class="min-list">
                        <?php 
                        if ( $the_parent ) {
                            $find_the_childrenof = $the_parent;
                        } else {
                            $find_the_childrenof = get_the_ID();
                        }
                        wp_list_pages( array(
                                'title_li'    => '',
                                'child_of' => $find_the_childrenof,
                                'sort_column' => 'menu_order'
                            ));
                        ?>
                        <!-- <li class="current_page_item"><a href="#">Our History</a></li>
                        <li><a href="#">Our Goals</a></li> -->
                    </ul>
                </div>
            <?php }?>

            <div class="generic-content">
                <?php the_content(); ?>
            </div>

        </div>
    
     <?php } ?>
    


<?php get_footer(); ?>;