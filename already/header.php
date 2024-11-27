<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<header>
    <div class="container">
        <div class="header">
            <a href="/" class="logo">
                <img src="<?= get_template_directory_uri() ?>/assets/img/logo.svg" alt="" class="logo__img">
                <span class="logo__title"><?=get_bloginfo('name')?></span>
            </a>
            <div class="top-menu">
                <?php wp_nav_menu(['theme_location'=>'top'])?>
            </div>
            <div class="both"></div>
        </div>
    </div>
</header>

<main>