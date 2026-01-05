<?php
/**
 * Le Comptoir Suisse Theme Functions
 * 
 * @package Le_Comptoir_Suisse
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Theme Setup
 */
function comptoir_theme_setup() {
    // Enable title tag support
    add_theme_support('title-tag');
    
    // Enable featured images
    add_theme_support('post-thumbnails');
    
    // Enable custom logo - flexible dimensions, no forced cropping
    // Due to WordPress 6.7+ cropper bug, we allow direct upload without cropping
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Alternative: Use custom header image for logo to bypass cropper issues
    add_theme_support('custom-header', array(
        'width'       => 400,
        'height'      => 100,
        'flex-width'  => true,
        'flex-height' => true,
        'header-text' => false,
    ));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'le-comptoir-suisse'),
    ));
    
    // Load text domain for translations
    load_theme_textdomain('le-comptoir-suisse', get_template_directory() . '/languages');
    
    // Add custom image sizes
    add_image_size('gallery-thumbnail', 400, 300, true);
    add_image_size('hero-background', 1920, 1080, false);
    add_image_size('philosophy-image', 800, 800, false);
}
add_action('after_setup_theme', 'comptoir_theme_setup');

/**
 * Enable SVG Upload Support
 */
function comptoir_enable_svg_upload($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'comptoir_enable_svg_upload');

/**
 * Fix SVG Display in Media Library
 */
function comptoir_fix_svg_display($response, $attachment, $meta) {
    if ($response['type'] === 'image' && $response['subtype'] === 'svg+xml' && class_exists('SimpleXMLElement')) {
        try {
            $path = get_attached_file($attachment->ID);
            if (@file_exists($path)) {
                $svg = @file_get_contents($path);
                if ($svg !== false) {
                    $svg = @simplexml_load_string($svg);
                    if ($svg !== false) {
                        $src = $response['url'];
                        $width = intval($svg['width']);
                        $height = intval($svg['height']);
                        
                        if (!$width || !$height) {
                            $width = 400;
                            $height = 400;
                        }
                        
                        $response['sizes'] = array(
                            'full' => array(
                                'url' => $src,
                                'width' => $width,
                                'height' => $height,
                                'orientation' => $width > $height ? 'landscape' : 'portrait'
                            )
                        );
                    }
                }
            }
        } catch (Exception $e) {
            // Silently fail - SVG will still upload but may not display perfectly
        }
    }
    return $response;
}
add_filter('wp_prepare_attachment_for_js', 'comptoir_fix_svg_display', 10, 3);

/**
 * Disable SVG for logo uploads to ensure cropper works
 */
function comptoir_disable_svg_for_logo($mimes) {
    // Check if we're in the customizer logo context
    if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'customize-header-crop') {
        // Remove SVG from allowed mimes during logo upload
        unset($mimes['svg']);
        unset($mimes['svgz']);
    }
    return $mimes;
}
add_filter('upload_mimes', 'comptoir_disable_svg_for_logo', 99);

/**
 * Prevent SVG files from being used as custom logo
 */
function comptoir_prevent_svg_logo($file) {
    // Only check during customizer operations
    if (!empty($_POST['wp_customize']) && isset($_POST['customize_image_header_nonce'])) {
        if (isset($file['type']) && in_array($file['type'], array('image/svg+xml'))) {
            $file['error'] = __('SVG files cannot be cropped. Please use PNG, JPG, or WEBP format for logos.', 'le-comptoir-suisse');
        }
    }
    return $file;
}
add_filter('wp_handle_upload_prefilter', 'comptoir_prevent_svg_logo', 1);

/**
 * Sanitize SVG on Upload
 */
function comptoir_sanitize_svg($file) {
    if ($file['type'] === 'image/svg+xml') {
        // Basic sanitization - remove script tags and event handlers
        $svg_content = @file_get_contents($file['tmp_name']);
        if ($svg_content !== false) {
            // Remove script tags
            $svg_content = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $svg_content);
            // Remove event handlers
            $svg_content = preg_replace('/ on\w+="[^"]*"/i', '', $svg_content);
            @file_put_contents($file['tmp_name'], $svg_content);
        }
    }
    return $file;
}
add_filter('wp_handle_upload_prefilter', 'comptoir_sanitize_svg');

/**
 * Enqueue Styles and Scripts
 */
function comptoir_enqueue_assets() {
    // Main CSS
    wp_enqueue_style(
        'comptoir-main-style',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        '1.0.0'
    );
    
    // Main JavaScript
    wp_enqueue_script(
        'comptoir-main-script',
        get_template_directory_uri() . '/assets/js/main.js',
        array('jquery'),
        '1.0.0',
        true
    );
    
    // Pass WordPress data to JavaScript including popup data
    $popup_data = array(
        'enabled' => get_theme_mod('popup_enabled', false),
        'title' => get_theme_mod('popup_title', __('Important Notice', 'le-comptoir-suisse')),
        'message' => get_theme_mod('popup_message', ''),
        'buttonText' => get_theme_mod('popup_button_text', __('Got it!', 'le-comptoir-suisse')),
        'linkUrl' => get_theme_mod('popup_link_url', ''),
        'linkText' => get_theme_mod('popup_link_text', __('Learn More', 'le-comptoir-suisse')),
        'hash' => md5(get_theme_mod('popup_message', '') . get_theme_mod('popup_title', '')),
    );
    
    wp_localize_script('comptoir-main-script', 'comptoirData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'siteUrl' => home_url('/'),
        'popup' => $popup_data,
    ));
}
add_action('wp_enqueue_scripts', 'comptoir_enqueue_assets');

/**
 * Enqueue Admin Styles and Scripts
 */
function comptoir_enqueue_admin_assets($hook) {
    // Only load on our settings page
    if ($hook !== 'toplevel_page_comptoir-settings') {
        return;
    }
    
    // Enqueue WordPress media uploader
    wp_enqueue_media();
    
    // Enqueue jQuery UI Sortable for future gallery enhancement
    wp_enqueue_script('jquery-ui-sortable');
}
add_action('admin_enqueue_scripts', 'comptoir_enqueue_admin_assets');

/**
 * Include Theme Files
 */
$nav_walker_file = get_template_directory() . '/inc/nav-walker.php';
$customizer_file = get_template_directory() . '/inc/customizer.php';
$admin_settings_file = get_template_directory() . '/inc/admin-settings.php';

if (file_exists($nav_walker_file)) {
    require_once $nav_walker_file;
} else {
    add_action('admin_notices', function() {
        echo '<div class="error"><p>Le Comptoir Suisse Theme Error: nav-walker.php file is missing from inc/ folder.</p></div>';
    });
}

if (file_exists($customizer_file)) {
    require_once $customizer_file;
} else {
    add_action('admin_notices', function() {
        echo '<div class="error"><p>Le Comptoir Suisse Theme Error: customizer.php file is missing from inc/ folder.</p></div>';
    });
}

if (file_exists($admin_settings_file)) {
    require_once $admin_settings_file;
} else {
    add_action('admin_notices', function() {
        echo '<div class="error"><p>Le Comptoir Suisse Theme Error: admin-settings.php file is missing from inc/ folder.</p></div>';
    });
}

/**
 * Set default theme options on activation (only if not already set)
 * This preserves existing settings when theme is re-uploaded
 */
function comptoir_set_default_options() {
    // Only set defaults if this is truly a first activation
    // Check if any customizer value exists - if yes, user has configured the theme
    $has_existing_settings = get_theme_mod('tagline_main') || 
                            get_theme_mod('contact_phone') || 
                            get_option('comptoir_gallery');
    
    // If settings exist, don't overwrite anything
    if ($has_existing_settings) {
        return;
    }
    
    // Set default Customizer values ONLY on first activation
    $defaults = array(
        'tagline_main' => 'LIEU VIVANT ET GOURMAND',
        'tagline_subtitle' => 'LOCAL • SINCÈRE • DE SAISON • SANS CHICHIS',
        'philosophy_title' => 'PHILOSOPHIE CENTRALE',
        'philosophy_subtitle' => '« Le Terroir Vivant »',
        'philosophy_text' => '<p><strong>Basé sur des produits locaux et saisonniers</strong> — interprété avec créativité et finesse, loin des clichés rustiques.</p>
<p><strong>Savoir-faire culinaire de Benjamin et son équipe</strong> : une cuisine authentique qui révèle l\'essence de chaque ingrédient du terroir suisse.</p>
<p><strong>Format du menu :</strong> Court, rotatif, guidé par le marché. « Le plat du Comptoir » change chaque semaine, reflétant la saisonnalité et les trouvailles du marché.</p>
<p><strong>Lieu de vie entre 11h00 et 00h00</strong> — Un espace convivial où tradition et modernité se rencontrent dans l\'esprit brasserie moderne, chaleureux et épuré.</p>',
        'contact_address' => 'Centre de Beaulieu, 1004 Lausanne',
        'contact_phone' => '021 624 84 84',
        'contact_maps_url' => 'https://maps.google.com',
        'opening_hours' => 'Tous les jours<br>11H00 - 00H00',
        'team_description' => 'Notre équipe passionnée vous accueille<br>pour une expérience gastronomique unique.',
        'booking_text' => 'Réservez votre table<br>par téléphone ou en ligne',
        'booking_status' => 'Plateforme de réservation à venir',
        'press_text' => 'Pour toute demande presse,<br>contactez-nous',
        'press_status' => 'Documents à venir',
        'reserve_button_text' => 'RÉSERVER',
        'reserve_button_link' => '#booking',
    );
    
    foreach ($defaults as $key => $value) {
        set_theme_mod($key, $value);
    }
    
    // Set default options for gallery and menus
    update_option('comptoir_gallery', '');
    update_option('comptoir_menus', array(
        'theatre_menu' => '',
        'after_theatre_menu' => '',
        'normal_menu' => '',
    ));
}
add_action('after_switch_theme', 'comptoir_set_default_options');
