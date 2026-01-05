/**
 * Customizer Live Preview Script
 * 
 * @package Le_Comptoir_Suisse
 * @since 1.0.0
 */

(function($) {
    'use strict';
    
    // Hero taglines
    wp.customize('tagline_main', function(value) {
        value.bind(function(newval) {
            $('.hero-tagline h2').text(newval);
        });
    });
    
    wp.customize('tagline_subtitle', function(value) {
        value.bind(function(newval) {
            $('.hero-tagline h3').text(newval);
        });
    });
    
    // Reserve button
    wp.customize('reserve_button_enabled', function(value) {
        value.bind(function(newval) {
            if (newval) {
                $('.reserve-button').show();
            } else {
                $('.reserve-button').hide();
            }
        });
    });
    
    wp.customize('reserve_button_text', function(value) {
        value.bind(function(newval) {
            $('.reserve-button').text(newval);
        });
    });
    
    // Philosophy section
    wp.customize('philosophy_title', function(value) {
        value.bind(function(newval) {
            $('.chef-text h2').text(newval);
        });
    });
    
    wp.customize('philosophy_subtitle', function(value) {
        value.bind(function(newval) {
            $('.chef-text h3').text(newval);
        });
    });
    
    // Contact information
    wp.customize('contact_address', function(value) {
        value.bind(function(newval) {
            $('.footer-section:first p:first').html(newval);
        });
    });
    
    wp.customize('contact_phone', function(value) {
        value.bind(function(newval) {
            $('.phone').html('<u>TÉL : ' + newval + '</u>');
        });
    });
    
    // Opening hours
    wp.customize('opening_hours', function(value) {
        value.bind(function(newval) {
            $('#opening-hours p:nth-child(3)').html(newval);
        });
    });
    
    // Footer content
    wp.customize('team_description', function(value) {
        value.bind(function(newval) {
            $('#team p').html(newval);
        });
    });
    
    wp.customize('booking_text', function(value) {
        value.bind(function(newval) {
            $('#booking p:first-of-type').html(newval);
        });
    });
    
    wp.customize('booking_status', function(value) {
        value.bind(function(newval) {
            if (newval) {
                $('#booking p em').text(newval);
            } else {
                $('#booking p:has(em)').hide();
            }
        });
    });
    
    wp.customize('press_text', function(value) {
        value.bind(function(newval) {
            $('#press p:first-of-type').html(newval);
        });
    });
    
    wp.customize('press_status', function(value) {
        value.bind(function(newval) {
            if (newval) {
                $('#press p em').text(newval);
            } else {
                $('#press p:has(em)').hide();
            }
        });
    });
    
})(jQuery);
