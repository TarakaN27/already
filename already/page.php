<?php get_header(); ?>

    <section class="page">
        <div class="container">
            <?php
            if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post();
                    get_template_part('template-parts/content/content', get_post_type());
                }
            } else {
                get_template_part('template-parts/content/content', 'none');
            }
            ?>
        </div>
    </section>

<?php get_footer(); ?>