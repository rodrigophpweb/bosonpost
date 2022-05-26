<section>
    <?php the_title('<h2>', '<h2>');?>
    <?php the_content();?>
    <article>
        <?php if( have_rows('clients') ): ?>
            <figure class="clients">
                <?php while( have_rows('clients') ): the_row(); 
                    $image = get_sub_field('image');
                    if( !empty( $image ) ): ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    <?php endif; ?>
                <?php endwhile; ?>
            </figure>
        <?php endif; ?>
    </article>
</section>