<article class="film-item">
    <a href="<?php the_permalink() ?>" class="film-item__img">
        <span class="film-item__rating"><?=get_field('rating')?></span>
        <?=get_the_post_thumbnail()?>
    </a>
    <a href="<?php the_permalink() ?>" class="film-item__title"><?php the_title() ?></a>
    <a href="<?php the_permalink() ?>" class="btn btn-yellow btn-outlined">Read more</a>
</article>