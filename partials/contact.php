<section class="contact">
    <article>

    </article>

    <article>
        <h2><?php get_field('info_phone')?></h2>
        <?php if( have_rows('phones') ): ?>
        <ul class="phones">
            <?php while( have_rows('phones') ): the_row();?>
                <li><?php the_sub_field('phone')?></li>
            <?php endwhile; ?>
        </ul>
        <?php endif; ?>

        <h2><?php get_field('info_team')?></h2>
        <?php if( have_rows('teams') ): ?>
        <ul class="teams">
            <?php 
                while( have_rows('temas') ): the_row(); 
            ?>
                <li>
                    <?php the_sub_field('email_member')?><br/>
                    <?php the_sub_field('phone_member')?>
                </li>
            <?php endwhile; ?>
        </ul>
        <?php endif; ?>
    </article>

    <article>
        <h2><?php get_field('info_mails')?></h2>
        <?php if( have_rows('mails') ): ?>
            <ul class="mails">
                <?php while( have_rows('mails') ): the_row();?>
                    <li><a><?php the_sub_field('mail')?></a></li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>

        <h2>Local</h2>
        <address>
            <?php the_field('address');?>
            <nav>
                <?php if( have_rows('networks') ): ?>
                    <?php while( have_rows('networks') ): the_row();?>
                        <a href="<?php the_field('url_network');?>" title="<?php the_field('name_network');?>">
                            <img src="<?php the_field('url_icon');?>" alt="<?php the_field('name_network')?>" width="24px" height="24px">
                        </a>
                    <?php endwhile; ?>
                <?php endif; ?>
            </nav>
        </address>
    </article>
</section>