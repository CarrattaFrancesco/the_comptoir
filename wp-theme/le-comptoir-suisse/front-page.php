<?php
/**
 * Front Page Template
 * 
 * @package Le_Comptoir_Suisse
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<!-- Hero Section -->
<section class="hero" id="home">
    <?php
    $hero_bg_id = get_theme_mod('hero_bg_image');
    if ($hero_bg_id) {
        echo wp_get_attachment_image($hero_bg_id, 'full', false, array('class' => 'hero-background', 'alt' => get_bloginfo('name')));
    } else {
        // Fallback to default image if available
        $default_hero = get_template_directory_uri() . '/assets/images/hero_background.jpg';
        echo '<img src="' . esc_url($default_hero) . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="hero-background">';
    }
    ?>
    <div class="hero-content">
        <div class="hero-left">
            <?php
            if (has_custom_logo()) {
                the_custom_logo();
            } else {
                echo '<img src="' . esc_url(get_template_directory_uri() . '/assets/images/logo.svg') . '" alt="' . esc_attr(get_bloginfo('name')) . ' Logo" class="hero-logo">';
            }
            ?>
        </div>
        <div class="hero-center">
        </div>
        <div class="hero-right">
            <?php
            $reserve_enabled = get_theme_mod('reserve_button_enabled', true);
            if ($reserve_enabled) :
                $reserve_text = get_theme_mod('reserve_button_text', 'RÉSERVER');
                $reserve_link = get_theme_mod('reserve_button_link', '#booking');
            ?>
                <a href="<?php echo esc_url($reserve_link); ?>" class="reserve-button"><?php echo esc_html($reserve_text); ?></a>
            <?php endif; ?>
        </div>
    </div>
    <div class="hero-tagline">
        <h2><?php echo esc_html(get_theme_mod('tagline_main', 'LIEU VIVANT ET GOURMAND')); ?></h2>
        <h3><?php echo esc_html(get_theme_mod('tagline_subtitle', 'LOCAL • SINCÈRE • DE SAISON • SANS CHICHIS')); ?></h3>
    </div>
</section>

<!-- Philosophy Section -->
<section class="chef-section">
    <div class="chef-content">
        <div class="chef-text">
            <h2><?php echo esc_html(get_theme_mod('philosophy_title', 'PHILOSOPHIE CENTRALE')); ?></h2>
            <h3><?php echo esc_html(get_theme_mod('philosophy_subtitle', '« Le Terroir Vivant »')); ?></h3>
            <div class="chef-description">
                <?php echo wp_kses_post(get_theme_mod('philosophy_text', '')); ?>
            </div>
            <div class="carte-button">
                <?php
                $menus = get_option('comptoir_menus', array());
                $normal_menu_id = isset($menus['normal_menu']) ? $menus['normal_menu'] : '';
                $normal_menu_url = $normal_menu_id ? wp_get_attachment_url($normal_menu_id) : '#';
                
                // If normal menu is not set, try to use any available menu
                if ($normal_menu_url === '#') {
                    $theatre_menu_id = isset($menus['theatre_menu']) ? $menus['theatre_menu'] : '';
                    $after_theatre_menu_id = isset($menus['after_theatre_menu']) ? $menus['after_theatre_menu'] : '';
                    
                    if ($theatre_menu_id) {
                        $normal_menu_url = wp_get_attachment_url($theatre_menu_id);
                    } elseif ($after_theatre_menu_id) {
                        $normal_menu_url = wp_get_attachment_url($after_theatre_menu_id);
                    }
                }
                ?>
                <button onclick="window.open('<?php echo esc_url($normal_menu_url); ?>', '_blank')"><?php esc_html_e('DÉCOUVRIR LA CARTE', 'le-comptoir-suisse'); ?></button>
            </div>
        </div>
        <div class="chef-dishes">
            <?php
            $philosophy_img_id = get_theme_mod('philosophy_image');
            if ($philosophy_img_id) {
                echo wp_get_attachment_image($philosophy_img_id, 'large', false, array('class' => 'dishes-image', 'alt' => esc_attr__('Produits du terroir suisse', 'le-comptoir-suisse')));
            } else {
                // Fallback to default image
                $default_img = get_template_directory_uri() . '/assets/images/img2.avif';
                echo '<img src="' . esc_url($default_img) . '" alt="' . esc_attr__('Produits du terroir suisse', 'le-comptoir-suisse') . '" class="dishes-image">';
            }
            ?>
        </div>
    </div>
</section>

<!-- Auto-Scrolling Gallery Section -->
<section class="scrolling-gallery">
    <div class="scrolling-gallery-track">
        <?php
        $gallery_ids = get_option('comptoir_gallery', '');
        
        // Convert comma-separated string to array
        if (!empty($gallery_ids)) {
            $gallery_array = array_filter(array_map('trim', explode(',', $gallery_ids)));
            
            if (!empty($gallery_array)) {
                // Display images twice for seamless infinite loop
                for ($loop = 0; $loop < 2; $loop++) {
                    foreach ($gallery_array as $image_id) {
                        $image_id = intval($image_id);
                        if ($image_id) {
                            $image_url = wp_get_attachment_image_url($image_id, 'large');
                            $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                            
                            if ($image_url) {
                                echo '<div class="scrolling-gallery-item" data-image="' . esc_url($image_url) . '">';
                                echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt ? $image_alt : 'Gallery Image') . '">';
                                echo '</div>';
                            }
                        }
                    }
                }
            }
        }
        
        // If no gallery images, show placeholder message or default images
        if (empty($gallery_ids)) {
            // You can add default gallery images here or leave it empty
            echo '<!-- No gallery images configured. Add images in WordPress Admin → Comptoir Settings -->';
        }
        ?>
    </div>
</section>

<?php
get_footer();
