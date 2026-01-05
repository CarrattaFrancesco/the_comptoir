<?php
/**
 * Header Template
 * 
 * @package Le_Comptoir_Suisse
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Navigation -->
<nav class="navbar">
    <div class="logo">
        <?php
        if (has_custom_logo()) {
            the_custom_logo();
        } else {
            echo '<img src="' . esc_url(get_template_directory_uri() . '/assets/images/logo.svg') . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
        }
        ?>
    </div>
    <div class="nav-left">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class'     => '',
            'fallback_cb'    => false,
            'items_wrap'     => '%3$s',
            'depth'          => 2,
            'walker'         => new Comptoir_Nav_Walker()
        ));
        ?>
    </div>
    <div class="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>
</nav>

<!-- Mobile Menu -->
<div class="mobile-menu">
    <div class="mobile-menu-items">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class'     => '',
            'fallback_cb'    => false,
            'items_wrap'     => '%3$s',
            'depth'          => 2,
            'walker'         => new Comptoir_Mobile_Nav_Walker()
        ));
        ?>
    </div>
</div>
