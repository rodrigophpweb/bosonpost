<?php 
    get_header();
    $args = [
        'post_type' => 'rell',
        'posts_per_page' => -1,
    ];
    $the_query = new WP_Query( $args ); 
    if ( $the_query->have_posts() ) : ?>
        <section class="rells">
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <div class="rell">
                    <?php the_field('rell');?>
                </div>
            <?php endwhile; wp_reset_postdata();?>
        </section>
    <?php endif;?>

<?php get_footer();