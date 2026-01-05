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
            <p class="phone"><u><?php echo esc_html__('TÉL : ', 'le-comptoir-suisse') . esc_html(get_theme_mod('contact_phone', '021 624 84 84')); ?></u></p>
        </div>
        
        <div class="footer-section" id="team">
            <h4><?php esc_html_e('ÉQUIPE', 'le-comptoir-suisse'); ?></h4>
            <p><?php echo wp_kses_post(get_theme_mod('team_description', 'Notre équipe passionnée vous accueille<br>pour une expérience gastronomique unique.')); ?></p>
        </div>
        
        <div class="footer-section" id="opening-hours">
            <h4><?php esc_html_e('HORAIRES', 'le-comptoir-suisse'); ?></h4>
            <p><strong><?php esc_html_e('Lieu de vie', 'le-comptoir-suisse'); ?></strong></p>
            <p><?php echo wp_kses_post(get_theme_mod('opening_hours', 'Tous les jours<br>11H00 - 00H00')); ?></p>
            <p><?php esc_html_e('Service continu', 'le-comptoir-suisse'); ?></p>
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
        
        <div class="footer-section" id="press">
            <h4><?php esc_html_e('PRESSE', 'le-comptoir-suisse'); ?></h4>
            <p><?php echo wp_kses_post(get_theme_mod('press_text', 'Pour toute demande presse,<br>contactez-nous')); ?></p>
            <?php
            $press_status = get_theme_mod('press_status', 'Documents à venir');
            if ($press_status) :
            ?>
                <p><em><?php echo esc_html($press_status); ?></em></p>
            <?php endif; ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
