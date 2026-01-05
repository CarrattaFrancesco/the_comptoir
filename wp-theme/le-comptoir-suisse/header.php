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
    <div class="nav-right">
        <?php
        $instagram_link = get_theme_mod('instagram_link', '');
        if (!empty($instagram_link)) :
        ?>
            <a href="<?php echo esc_url($instagram_link); ?>" class="instagram-link" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" fill="currentColor"/>
                </svg>
            </a>
        <?php endif; ?>
    </div>
    <?php
    // Check if menu has items before showing hamburger
    $menu_name = 'primary';
    $locations = get_nav_menu_locations();
    $menu = isset($locations[$menu_name]) ? wp_get_nav_menu_object($locations[$menu_name]) : false;
    $menu_items = $menu ? wp_get_nav_menu_items($menu->term_id) : array();
    
    if (!empty($menu_items)) :
    ?>
    <div class="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <?php endif; ?>
</nav>

<!-- Mobile Menu -->
<?php if (!empty($menu_items)) : ?>
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
<?php endif; ?>
