<?php get_header(); ?>


<?php   
    page_banner(array(
        'title' => 'Past Events',
        'sub_title' => 'A recap of our past events.'
    ));
?>

<div class="container container--narrow page-section">
  <?php

        $today = date('Ymd');
        $past_events =  new WP_Query( array(
            'paged' => get_query_var( 'paged', 1 ), // this tells the custom query which page number of result it should be on
            'post_type'      => 'event',
            'meta_key'       => 'event_date', // ACF meta_key is to spell out the event field created on ACF
            'orderby'        => 'menu_value_num', // sorting numbers
            'order'          => 'ASC',
            'meta_query'     => array(
                    array(
                    'key'     => 'event_date', // only give us post if the "key" ACF event_date...
                    'compare' => '<', // is less than...
                    'value'   => $today, // in todays date.
                    'type'    => 'numeric' // // tell wordpress what type of value you gonna be comparing
                )
            )
        ));
    while( $past_events->have_posts() ) {
        $past_events->the_post(  ); ?>

        <?php get_template_part( 'template-parts/content', 'event' )?>

        <?php } 
        echo paginate_links( array( //give this function information about the custom query
            'total' => $past_events->max_num_pages
        ));
        ?>
</div>

<?php get_footer(); ?>