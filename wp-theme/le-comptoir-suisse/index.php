<?php
/**
 * Index Template (Fallback)
 * 
 * @package Le_Comptoir_Suisse
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="main" class="site-main">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            the_content();
        endwhile;
    else :
        echo '<p>' . esc_html__('No content found', 'le-comptoir-suisse') . '</p>';
    endif;
    ?>
</main>

<?php
get_footer();
