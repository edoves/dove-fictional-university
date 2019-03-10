<?php get_header(); ?>

<?php   
    page_banner(array(
        'title' => 'All Programs',
        'sub_title' => 'There is something for everyone. Have a look around.'
    ));
?>

<?php 
// echo '<pre>';
// print_r($post); 
// echo '<pre>';

?>
<div class="container container--narrow page-section">
    <ul class="link-list min-list">
        <?php
            while( have_posts() ) {
                the_post(); ?>

                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

            <?php } 
            echo paginate_links();
        ?>
    </ul>
</div>

<?php get_footer(); ?>