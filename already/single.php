<?php get_header(); ?>

<section class="page">
    <div class="container">
        <a href="/" class="btn btn-brown move-back">Назад</a>
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