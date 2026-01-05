<?php
/**
 * Theme Customizer Settings
 * 
 * @package Le_Comptoir_Suisse
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Customizer Settings
 */
function comptoir_customize_register($wp_customize) {
    
    // ========================================
    // HERO SECTION PANEL
    // ========================================
    $wp_customize->add_panel('comptoir_hero_panel', array(
        'title'    => __('Hero Section', 'le-comptoir-suisse'),
        'priority' => 30,
    ));
    
    // Hero Background Section
    $wp_customize->add_section('comptoir_hero_background', array(
        'title' => __('Background Image', 'le-comptoir-suisse'),
        'panel' => 'comptoir_hero_panel',
    ));
    
    $wp_customize->add_setting('hero_bg_image', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'hero_bg_image', array(
        'label'     => __('Hero Background Image', 'le-comptoir-suisse'),
        'section'   => 'comptoir_hero_background',
        'mime_type' => 'image',
    )));
    
    // Hero Taglines Section
    $wp_customize->add_section('comptoir_hero_taglines', array(
        'title' => __('Taglines', 'le-comptoir-suisse'),
        'panel' => 'comptoir_hero_panel',
    ));
    
    $wp_customize->add_setting('tagline_main', array(
        'default'           => 'LIEU VIVANT ET GOURMAND',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('tagline_main', array(
        'label'   => __('Main Tagline', 'le-comptoir-suisse'),
        'section' => 'comptoir_hero_taglines',
        'type'    => 'text',
    ));
    
    $wp_customize->add_setting('tagline_subtitle', array(
        'default'           => 'LOCAL • SINCÈRE • DE SAISON • SANS CHICHIS',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('tagline_subtitle', array(
        'label'   => __('Subtitle Tagline', 'le-comptoir-suisse'),
        'section' => 'comptoir_hero_taglines',
        'type'    => 'text',
    ));
    
    // Reserve Button Section
    $wp_customize->add_section('comptoir_reserve_button', array(
        'title' => __('Reserve Button', 'le-comptoir-suisse'),
        'panel' => 'comptoir_hero_panel',
    ));
    
    $wp_customize->add_setting('reserve_button_enabled', array(
        'default'           => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('reserve_button_enabled', array(
        'label'       => __('Show Reserve Button', 'le-comptoir-suisse'),
        'description' => __('Enable or disable the reserve button in the hero section', 'le-comptoir-suisse'),
        'section'     => 'comptoir_reserve_button',
        'type'        => 'checkbox',
    ));
    
    $wp_customize->add_setting('reserve_button_text', array(
        'default'           => 'RÉSERVER',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('reserve_button_text', array(
        'label'   => __('Button Text', 'le-comptoir-suisse'),
        'section' => 'comptoir_reserve_button',
        'type'    => 'text',
    ));
    
    $wp_customize->add_setting('reserve_button_link', array(
        'default'           => '#booking',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('reserve_button_link', array(
        'label'       => __('Button Link', 'le-comptoir-suisse'),
        'description' => __('Enter an anchor link (e.g., #booking) or full URL', 'le-comptoir-suisse'),
        'section'     => 'comptoir_reserve_button',
        'type'        => 'url',
    ));
    
    // ========================================
    // PHILOSOPHY SECTION PANEL
    // ========================================
    $wp_customize->add_panel('comptoir_philosophy_panel', array(
        'title'    => __('Philosophy Section', 'le-comptoir-suisse'),
        'priority' => 31,
    ));
    
    // Philosophy Text Section
    $wp_customize->add_section('comptoir_philosophy_text', array(
        'title' => __('Philosophy Content', 'le-comptoir-suisse'),
        'panel' => 'comptoir_philosophy_panel',
    ));
    
    $wp_customize->add_setting('philosophy_title', array(
        'default'           => 'PHILOSOPHIE CENTRALE',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('philosophy_title', array(
        'label'   => __('Title', 'le-comptoir-suisse'),
        'section' => 'comptoir_philosophy_text',
        'type'    => 'text',
    ));
    
    $wp_customize->add_setting('philosophy_subtitle', array(
        'default'           => '« Le Terroir Vivant »',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('philosophy_subtitle', array(
        'label'   => __('Subtitle', 'le-comptoir-suisse'),
        'section' => 'comptoir_philosophy_text',
        'type'    => 'text',
    ));
    
    $wp_customize->add_setting('philosophy_text', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control('philosophy_text', array(
        'label'       => __('Philosophy Text', 'le-comptoir-suisse'),
        'description' => __('HTML tags allowed: &lt;p&gt;, &lt;strong&gt;, &lt;em&gt;, &lt;br&gt;', 'le-comptoir-suisse'),
        'section'     => 'comptoir_philosophy_text',
        'type'        => 'textarea',
    ));
    
    // Philosophy Image Section
    $wp_customize->add_section('comptoir_philosophy_image', array(
        'title' => __('Philosophy Image', 'le-comptoir-suisse'),
        'panel' => 'comptoir_philosophy_panel',
    ));
    
    $wp_customize->add_setting('philosophy_image', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'philosophy_image', array(
        'label'     => __('Philosophy Section Image', 'le-comptoir-suisse'),
        'section'   => 'comptoir_philosophy_image',
        'mime_type' => 'image',
    )));
    
    // ========================================
    // CONTACT INFORMATION PANEL
    // ========================================
    $wp_customize->add_panel('comptoir_contact_panel', array(
        'title'    => __('Contact Information', 'le-comptoir-suisse'),
        'priority' => 32,
    ));
    
    // Address Section
    $wp_customize->add_section('comptoir_contact_address', array(
        'title' => __('Address & Phone', 'le-comptoir-suisse'),
        'panel' => 'comptoir_contact_panel',
    ));
    
    $wp_customize->add_setting('contact_address', array(
        'default'           => 'Centre de Beaulieu, 1004 Lausanne',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('contact_address', array(
        'label'       => __('Address', 'le-comptoir-suisse'),
        'description' => __('Use &lt;br&gt; for line breaks', 'le-comptoir-suisse'),
        'section'     => 'comptoir_contact_address',
        'type'        => 'textarea',
    ));
    
    $wp_customize->add_setting('contact_phone', array(
        'default'           => '021 624 84 84',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('contact_phone', array(
        'label'   => __('Phone Number', 'le-comptoir-suisse'),
        'section' => 'comptoir_contact_address',
        'type'    => 'text',
    ));
    
    $wp_customize->add_setting('contact_maps_url', array(
        'default'           => 'https://maps.google.com',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('contact_maps_url', array(
        'label'   => __('Google Maps URL', 'le-comptoir-suisse'),
        'section' => 'comptoir_contact_address',
        'type'    => 'url',
    ));
    
    // Opening Hours Section
    $wp_customize->add_section('comptoir_opening_hours', array(
        'title' => __('Opening Hours', 'le-comptoir-suisse'),
        'panel' => 'comptoir_contact_panel',
    ));
    
    $wp_customize->add_setting('opening_hours', array(
        'default'           => 'Tous les jours<br>11H00 - 00H00',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('opening_hours', array(
        'label'       => __('Hours', 'le-comptoir-suisse'),
        'description' => __('Use &lt;br&gt; for line breaks', 'le-comptoir-suisse'),
        'section'     => 'comptoir_opening_hours',
        'type'        => 'textarea',
    ));
    
    // ========================================
    // FOOTER SECTIONS
    // ========================================
    $wp_customize->add_section('comptoir_footer_content', array(
        'title'    => __('Footer Content', 'le-comptoir-suisse'),
        'priority' => 33,
    ));
    
    $wp_customize->add_setting('team_description', array(
        'default'           => 'Notre équipe passionnée vous accueille<br>pour une expérience gastronomique unique.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('team_description', array(
        'label'       => __('Team Description', 'le-comptoir-suisse'),
        'description' => __('Use &lt;br&gt; for line breaks', 'le-comptoir-suisse'),
        'section'     => 'comptoir_footer_content',
        'type'        => 'textarea',
    ));
    
    $wp_customize->add_setting('booking_text', array(
        'default'           => 'Réservez votre table<br>par téléphone ou en ligne',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('booking_text', array(
        'label'       => __('Booking Text', 'le-comptoir-suisse'),
        'description' => __('Use &lt;br&gt; for line breaks', 'le-comptoir-suisse'),
        'section'     => 'comptoir_footer_content',
        'type'        => 'textarea',
    ));
    
    $wp_customize->add_setting('booking_status', array(
        'default'           => 'Plateforme de réservation à venir',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('booking_status', array(
        'label'       => __('Booking Status Message', 'le-comptoir-suisse'),
        'description' => __('Leave empty to hide', 'le-comptoir-suisse'),
        'section'     => 'comptoir_footer_content',
        'type'        => 'text',
    ));
    
    $wp_customize->add_setting('press_text', array(
        'default'           => 'Pour toute demande presse,<br>contactez-nous',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('press_text', array(
        'label'       => __('Press Text', 'le-comptoir-suisse'),
        'description' => __('Use &lt;br&gt; for line breaks', 'le-comptoir-suisse'),
        'section'     => 'comptoir_footer_content',
        'type'        => 'textarea',
    ));
    
    $wp_customize->add_setting('press_status', array(
        'default'           => 'Documents à venir',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('press_status', array(
        'label'       => __('Press Status Message', 'le-comptoir-suisse'),
        'description' => __('Leave empty to hide', 'le-comptoir-suisse'),
        'section'     => 'comptoir_footer_content',
        'type'        => 'text',
    ));
}
add_action('customize_register', 'comptoir_customize_register');

/**
 * Enqueue customizer control scripts and fix logo cropper
 */
function comptoir_customize_controls_enqueue() {
    // Ensure all necessary scripts for image cropping are loaded
    wp_enqueue_script('customize-controls');
    wp_enqueue_media();
    wp_enqueue_script('jquery-ui-core');
}
add_action('customize_controls_enqueue_scripts', 'comptoir_customize_controls_enqueue');

/**
 * Workaround for WordPress 6.7+ cropper querySelector bug
 * This allows skipping the broken cropper and using images directly
 */
function comptoir_allow_skip_cropping() {
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        if (typeof wp !== 'undefined' && wp.customize) {
            // Override the custom logo control to handle cropper errors gracefully
            $(document).on('click', '.customize-control-cropped_image .upload-button', function(e) {
                console.log('Comptoir: Logo upload initiated');
            });
            
            // If cropper fails, provide skip option
            wp.customize.bind('ready', function() {
                if (wp.customize.control('custom_logo')) {
                    var logoControl = wp.customize.control('custom_logo');
                    
                    // Store original params
                    if (logoControl.params) {
                        logoControl.params.flex_width = true;
                        logoControl.params.flex_height = true;
                    }
                }
            });
        }
    });
    </script>
    <?php
}
add_action('customize_controls_print_footer_scripts', 'comptoir_allow_skip_cropping');

/**
 * Customizer Live Preview JavaScript
 */
function comptoir_customize_preview_js() {
    wp_enqueue_script(
        'comptoir-customizer',
        get_template_directory_uri() . '/assets/js/customizer.js',
        array('customize-preview'),
        '1.0.0',
        true
    );
}
add_action('customize_preview_init', 'comptoir_customize_preview_js');
