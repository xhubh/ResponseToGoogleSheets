<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header>
        <div class="container">
            <div class="logo"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/OKMGLOGO.png" alt="OKMG Logo">
                </a></div>
            <div id="hamburger-menu">
                <svg width="31" height="20" viewBox="0 0 31 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.379395" y="15.8252" width="30.6204" height="3.82755" rx="1.91378" fill="#222222" />
                    <rect x="0.379395" y="8.25836" width="30.6204" height="3.82755" rx="1.91378" fill="#222222" />
                    <rect x="0.379395" y="0.691467" width="30.6204" height="3.82755" rx="1.91378" fill="#222222" />
                </svg>
            </div>

            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'nav-menu',
                'menu_id' => 'nav-links'
            ));
            ?>
        </div>
    </header>
    <div id="content" class="container">