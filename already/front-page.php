<?php get_header(); ?>

    <section class="main-block bg-light-yellow">
        <div class="container">
            <div class="main-block__wrapper">
                <div class="main-block__content">
                    <h1 class="section-title">
                        Explore a <strong>World</strong> of Cinematic Wonders
                    </h1>
                    <h3 class="section-descr">
                        Our database not only includes blockbusters but also independent films, documentary features, and works
                        from talented directors worldwide.
                    </h3>
                    <div class="main-block__actions">
                        <a href="#" class="btn btn-brown">Register now</a>
                        <a href="#" class="btn btn-small">About us</a>
                    </div>
                </div>
                <div class="main-block__img">
                    <img src="<?= get_template_directory_uri() ?>/assets/img/img-hero.svg" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="catalog">
        <div class="container">
            <h2 class="section-title">
                Discover a <strong>Universe</strong> of Cinematic Marvels
            </h2>
            <div class="catalog__wrapper">
                <div class="catalog-sidebar">
                    <div class="catalog-search">
                        <span class="icon icon-search"></span>
                        <label class="input-sizer">
                            <input type="text" id="catalog-search" onInput="this.parentNode.dataset.value = this.value" size="10" placeholder="Search by name">
                        </label>
                    </div>
                    <div class="catalog-filter">
                        <span class="catalog-filter__name">Filter:</span>
                        <? get_template_part('template-parts/filter')?>
                    </div>
                </div>
                <div class="catalog-container">
                    <div class="catalog-container__sort">
                        <span class="sort-title">Sort by:</span>
                        <select class="form-control" name="sort">
                            <option selected value="rating|asc">Rating (ASC)</option>
                            <option selected value="rating|desc">Rating (DESC)</option>
                            <option value="release_date|asc">Release date (ASC)</option>
                            <option value="release_date|desc">Release date (DESC)</option>
                        </select>
                    </div>
                    <? get_template_part('template-parts/film', 'list') ?>
                </div>
            </div>
        </div>
    </section>

<?php get_footer();