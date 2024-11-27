<article class="movie-single">
    <div class="movie-single__img">
        <?=get_the_post_thumbnail()?>
    </div>
    <div class="movie-single__content">
        <h1 class="movie-single__title">
            <? the_title(); ?>
        </h1>
        <div class="movie-single__params">
            <p>Genre: <?=get_field('release_date')?></p>
            <p>Release date: <?=get_field('release_date')?></p>
        </div>
        <div class="movie-single__description">
            <? the_content(); ?>
        </div>
    </div>
</article>