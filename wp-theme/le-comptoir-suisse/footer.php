<?php
/**
 * Footer Template
 * 
 * @package Le_Comptoir_Suisse
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<!-- Lightbox Modal -->
<div class="lightbox" id="lightbox">
    <button class="lightbox-close" id="lightbox-close">&times;</button>
    <img src="" alt="<?php esc_attr_e('Full size image', 'le-comptoir-suisse'); ?>" id="lightbox-image">
</div>

<!-- Notification Popup -->
<?php if (get_theme_mod('popup_enabled', false)) : ?>
<div class="notification-popup-overlay" id="notification-popup">
    <div class="notification-popup">
        <button class="notification-popup-close" aria-label="<?php esc_attr_e('Close', 'le-comptoir-suisse'); ?>">&times;</button>
        <div class="notification-popup-content">
            <h3 class="notification-popup-title"><?php echo wp_kses_post(get_theme_mod('popup_title', __('Important Notice', 'le-comptoir-suisse'))); ?></h3>
            <div class="notification-popup-message">
                <?php echo wp_kses_post(get_theme_mod('popup_message', '')); ?>
            </div>
            <div class="notification-popup-actions">
                <?php 
                $popup_link_url = get_theme_mod('popup_link_url', '');
                if ($popup_link_url) : 
                ?>
                    <a href="<?php echo esc_url($popup_link_url); ?>" class="notification-popup-link" target="_blank">
                        <?php echo esc_html(get_theme_mod('popup_link_text', __('Learn More', 'le-comptoir-suisse'))); ?>
                    </a>
                <?php endif; ?>
                <?php 
                $popup_button_text = get_theme_mod('popup_button_text', __('Got it!', 'le-comptoir-suisse'));
                if ($popup_button_text) : 
                ?>
                    <button class="notification-popup-button">
                        <?php echo esc_html($popup_button_text); ?>
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Footer -->
<footer class="footer" id="contact">
    <div class="footer-content">
        <div class="footer-section">
            <h4><?php esc_html_e('ADRESSE', 'le-comptoir-suisse'); ?></h4>
            <p><?php echo wp_kses_post(get_theme_mod('contact_address', 'Centre de Beaulieu,<br>1004 Lausanne')); ?></p>
            <?php
            $maps_url = get_theme_mod('contact_maps_url', 'https://maps.google.com');
            if ($maps_url) :
            ?>
                <a href="<?php echo esc_url($maps_url); ?>" target="_blank" class="google-maps" id="maps"><?php esc_html_e('Google Maps', 'le-comptoir-suisse'); ?></a>
            <?php endif; ?>
        </div>
        
        <div class="footer-section" id="opening-hours">
            <h4><?php esc_html_e('HORAIRES', 'le-comptoir-suisse'); ?></h4>
            <p><?php echo wp_kses_post(get_theme_mod('opening_hours', 'Tous les jours<br>11H00 - 00H00')); ?></p>
        </div>
        
        <div class="footer-section" id="booking">
            <h4><?php esc_html_e('RÉSERVATION', 'le-comptoir-suisse'); ?></h4>
            <p><?php echo wp_kses_post(get_theme_mod('booking_text', 'Réservez votre table<br>par téléphone ou en ligne')); ?></p>
            <?php
            $booking_status = get_theme_mod('booking_status', 'Plateforme de réservation à venir');
            if ($booking_status) :
            ?>
                <p><em><?php echo esc_html($booking_status); ?></em></p>
            <?php endif; ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
