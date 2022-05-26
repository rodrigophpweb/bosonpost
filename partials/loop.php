<?php 
    if ( have_posts() ) : 
        while ( have_posts() ) : the_post(); 
            if(is_page('contato')):
                get_template_part('partials/contact');
            elseif(is_page('sobre-nos')):
                get_template_part('partials/about');
                elseif(is_page('repertorio')):
                    get_template_part('partials/rell');
            endif;
        endwhile; 
    endif; 
