<?php

$get_films = new WP_Query([
    'post_type' => 'movies',
    'posts_per_page' => 2,
]);

?>
<div class="film-list-wrapper">
    <div class="film-list" id="films">
        <? if ($get_films->have_posts()): ?>
            <?
            while ($get_films->have_posts()) {
                $get_films->the_post();
                get_template_part('template-parts/film', 'post');
            }
            ?>
        <? endif; ?>
    </div>

    <span class="btn btn-brown js-load-more <?= $get_films->found_posts > 2 ? 'is-show': ''?>" data-page="1">Load more</span>
</div>