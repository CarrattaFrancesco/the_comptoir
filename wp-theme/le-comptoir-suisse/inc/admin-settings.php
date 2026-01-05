<?php
/**
 * Admin Settings Page for Gallery and Menu PDFs
 * 
 * @package Le_Comptoir_Suisse
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Admin Menu
 */
function comptoir_add_admin_menu() {
    add_menu_page(
        __('Comptoir Settings', 'le-comptoir-suisse'),  // Page title
        __('Comptoir Settings', 'le-comptoir-suisse'),  // Menu title
        'manage_options',                                // Capability
        'comptoir-settings',                             // Menu slug
        'comptoir_settings_page',                        // Callback function
        'dashicons-admin-generic',                       // Icon
        30                                               // Position
    );
}
add_action('admin_menu', 'comptoir_add_admin_menu');

/**
 * Register Settings
 */
function comptoir_settings_init() {
    register_setting('comptoir_settings', 'comptoir_gallery', array(
        'sanitize_callback' => 'comptoir_sanitize_gallery',
    ));
    
    register_setting('comptoir_settings', 'comptoir_menus', array(
        'sanitize_callback' => 'comptoir_sanitize_menus',
    ));
}
add_action('admin_init', 'comptoir_settings_init');

/**
 * Sanitize Gallery IDs
 */
function comptoir_sanitize_gallery($input) {
    if (empty($input)) {
        return '';
    }
    
    // Convert to array, sanitize each ID, remove empties
    $ids = array_map('trim', explode(',', $input));
    $ids = array_filter($ids);
    $ids = array_map('absint', $ids);
    
    // Return as comma-separated string
    return implode(',', $ids);
}

/**
 * Sanitize Menu PDFs
 */
function comptoir_sanitize_menus($input) {
    if (!is_array($input)) {
        return array();
    }
    
    $sanitized = array();
    $sanitized['theatre_menu'] = isset($input['theatre_menu']) ? absint($input['theatre_menu']) : '';
    $sanitized['after_theatre_menu'] = isset($input['after_theatre_menu']) ? absint($input['after_theatre_menu']) : '';
    $sanitized['normal_menu'] = isset($input['normal_menu']) ? absint($input['normal_menu']) : '';
    
    return $sanitized;
}

/**
 * Settings Page HTML
 */
function comptoir_settings_page() {
    // Check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
    
    // Save settings
    if (isset($_POST['comptoir_settings_nonce']) && wp_verify_nonce($_POST['comptoir_settings_nonce'], 'comptoir_settings_save')) {
        if (isset($_POST['comptoir_gallery'])) {
            update_option('comptoir_gallery', sanitize_text_field($_POST['comptoir_gallery']));
        }
        
        if (isset($_POST['comptoir_menus'])) {
            update_option('comptoir_menus', comptoir_sanitize_menus($_POST['comptoir_menus']));
        }
        
        echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__('Settings saved successfully!', 'le-comptoir-suisse') . '</p></div>';
    }
    
    $gallery_ids = get_option('comptoir_gallery', '');
    $menus = get_option('comptoir_menus', array(
        'theatre_menu' => '',
        'after_theatre_menu' => '',
        'normal_menu' => '',
    ));
    ?>
    
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        
        <p><?php esc_html_e('Manage your gallery images and menu PDF files.', 'le-comptoir-suisse'); ?></p>
        
        <form method="post" action="">
            <?php wp_nonce_field('comptoir_settings_save', 'comptoir_settings_nonce'); ?>
            
            <!-- Gallery Section -->
            <div class="comptoir-settings-section">
                <h2><?php esc_html_e('Gallery Images', 'le-comptoir-suisse'); ?></h2>
                <p class="description">
                    <?php esc_html_e('Click "Add Images" to select gallery photos. Drag to reorder.', 'le-comptoir-suisse'); ?>
                </p>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label><?php esc_html_e('Gallery Management', 'le-comptoir-suisse'); ?></label>
                        </th>
                        <td>
                            <div id="comptoir-gallery-container" class="comptoir-gallery-grid">
                                <?php
                                if (!empty($gallery_ids)) {
                                    $ids_array = array_filter(array_map('trim', explode(',', $gallery_ids)));
                                    foreach ($ids_array as $img_id) {
                                        $img_id = intval($img_id);
                                        $image_url = wp_get_attachment_image_url($img_id, 'thumbnail');
                                        if ($image_url) {
                                            echo '<div class="comptoir-gallery-item" data-id="' . $img_id . '">';
                                            echo '<img src="' . esc_url($image_url) . '" alt="">';
                                            echo '<button type="button" class="comptoir-remove-gallery-image" title="Remove">&times;</button>';
                                            echo '<div class="comptoir-drag-handle" title="Drag to reorder">&#8942;&#8942;</div>';
                                            echo '</div>';
                                        }
                                    }
                                }
                                ?>
                            </div>
                            
                            <input type="hidden" name="comptoir_gallery" id="comptoir_gallery_input" value="<?php echo esc_attr($gallery_ids); ?>">
                            
                            <p style="margin-top: 15px;">
                                <button type="button" class="button button-primary" id="comptoir-add-gallery-images">
                                    <span class="dashicons dashicons-images-alt2" style="vertical-align: middle;"></span>
                                    <?php esc_html_e('Add Images', 'le-comptoir-suisse'); ?>
                                </button>
                                <button type="button" class="button" id="comptoir-clear-gallery" style="margin-left: 10px;">
                                    <?php esc_html_e('Clear All', 'le-comptoir-suisse'); ?>
                                </button>
                            </p>
                            
                            <p class="description">
                                <?php esc_html_e('Drag images to reorder them. They will appear in this order on your website.', 'le-comptoir-suisse'); ?>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            
            <hr style="margin: 40px 0;">
            
            <!-- Menu PDFs Section -->
            <div class="comptoir-settings-section">
                <h2><?php esc_html_e('Menu PDFs', 'le-comptoir-suisse'); ?></h2>
                <p class="description">
                    <?php esc_html_e('Upload PDF files for each menu type. These will be linked in the navigation dropdown.', 'le-comptoir-suisse'); ?>
                </p>
                
                <table class="form-table">
                    <!-- Theatre Menu -->
                    <tr>
                        <th scope="row">
                            <label for="theatre_menu"><?php esc_html_e('Theatre Menu', 'le-comptoir-suisse'); ?></label>
                        </th>
                        <td>
                            <?php comptoir_render_pdf_uploader('theatre_menu', $menus); ?>
                        </td>
                    </tr>
                    
                    <!-- After Theatre Menu -->
                    <tr>
                        <th scope="row">
                            <label for="after_theatre_menu"><?php esc_html_e('After Theatre Menu', 'le-comptoir-suisse'); ?></label>
                        </th>
                        <td>
                            <?php comptoir_render_pdf_uploader('after_theatre_menu', $menus); ?>
                        </td>
                    </tr>
                    
                    <!-- Normal Menu -->
                    <tr>
                        <th scope="row">
                            <label for="normal_menu"><?php esc_html_e('Normal Menu (Main)', 'le-comptoir-suisse'); ?></label>
                        </th>
                        <td>
                            <?php comptoir_render_pdf_uploader('normal_menu', $menus); ?>
                            <p class="description">
                                <?php esc_html_e('This is the main menu PDF that appears in the "Découvrir la Carte" button.', 'le-comptoir-suisse'); ?>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            
            <?php submit_button(__('Save Settings', 'le-comptoir-suisse')); ?>
        </form>
    </div>
    
    <style>
        .comptoir-settings-section {
            background: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #ccd0d4;
            box-shadow: 0 1px 1px rgba(0,0,0,.04);
        }
        
        .comptoir-pdf-uploader {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .comptoir-pdf-filename {
            flex: 1;
            padding: 8px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        
        .comptoir-pdf-filename a {
            text-decoration: none;
        }
        
        /* Gallery Grid Styles */
        .comptoir-gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
            padding: 15px;
            background: #f9f9f9;
            border: 2px dashed #ddd;
            border-radius: 3px;
            min-height: 150px;
        }
        
        .comptoir-gallery-grid:empty::before {
            content: 'No images yet. Click "Add Images" to get started.';
            color: #999;
            text-align: center;
            padding: 40px;
            display: block;
        }
        
        .comptoir-gallery-item {
            position: relative;
            border: 2px solid #ddd;
            border-radius: 3px;
            overflow: hidden;
            background: #fff;
            cursor: move;
            transition: all 0.2s ease;
        }
        
        .comptoir-gallery-item:hover {
            border-color: #0073aa;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .comptoir-gallery-item img {
            display: block;
            width: 100%;
            height: 120px;
            object-fit: cover;
        }
        
        .comptoir-remove-gallery-image {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(220, 50, 50, 0.9);
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            cursor: pointer;
            font-size: 18px;
            line-height: 1;
            padding: 0;
            display: none;
            transition: background 0.2s;
        }
        
        .comptoir-remove-gallery-image:hover {
            background: rgba(220, 50, 50, 1);
        }
        
        .comptoir-gallery-item:hover .comptoir-remove-gallery-image {
            display: block;
        }
        
        .comptoir-drag-handle {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
            padding: 5px;
            font-size: 16px;
            letter-spacing: -2px;
            cursor: move;
        }
        
        .comptoir-gallery-item.ui-sortable-helper {
            opacity: 0.8;
            transform: scale(1.05);
        }
        
        .comptoir-gallery-item.ui-sortable-placeholder {
            background: #e0e0e0;
            border: 2px dashed #0073aa;
        }
    </style>
    
    <script>
    jQuery(document).ready(function($) {
        // Update hidden input when gallery changes
        function updateGalleryInput() {
            var ids = [];
            $('#comptoir-gallery-container .comptoir-gallery-item').each(function() {
                ids.push($(this).data('id'));
            });
            $('#comptoir_gallery_input').val(ids.join(','));
        }
        
        // Make gallery sortable (drag and drop)
        $('#comptoir-gallery-container').sortable({
            items: '.comptoir-gallery-item',
            cursor: 'move',
            placeholder: 'ui-sortable-placeholder',
            update: function() {
                updateGalleryInput();
            }
        });
        
        // Add images to gallery
        $('#comptoir-add-gallery-images').on('click', function(e) {
            e.preventDefault();
            
            var frame = wp.media({
                title: '<?php esc_html_e('Select Gallery Images', 'le-comptoir-suisse'); ?>',
                button: {
                    text: '<?php esc_html_e('Add to Gallery', 'le-comptoir-suisse'); ?>'
                },
                multiple: true,
                library: {
                    type: 'image'
                }
            });
            
            frame.on('select', function() {
                var selection = frame.state().get('selection');
                
                selection.each(function(attachment) {
                    var data = attachment.toJSON();
                    
                    // Check if image already exists in gallery
                    if ($('#comptoir-gallery-container .comptoir-gallery-item[data-id="' + data.id + '"]').length > 0) {
                        return; // Skip duplicates
                    }
                    
                    var thumbnail = data.sizes && data.sizes.thumbnail ? data.sizes.thumbnail.url : data.url;
                    
                    var item = $('<div class="comptoir-gallery-item" data-id="' + data.id + '">' +
                        '<img src="' + thumbnail + '" alt="">' +
                        '<button type="button" class="comptoir-remove-gallery-image" title="Remove">&times;</button>' +
                        '<div class="comptoir-drag-handle" title="Drag to reorder">&#8942;&#8942;</div>' +
                        '</div>');
                    
                    $('#comptoir-gallery-container').append(item);
                });
                
                updateGalleryInput();
            });
            
            frame.open();
        });
        
        // Remove image from gallery
        $(document).on('click', '.comptoir-remove-gallery-image', function(e) {
            e.preventDefault();
            $(this).closest('.comptoir-gallery-item').remove();
            updateGalleryInput();
        });
        
        // Clear all gallery images
        $('#comptoir-clear-gallery').on('click', function(e) {
            e.preventDefault();
            if (confirm('<?php esc_html_e('Are you sure you want to remove all images from the gallery?', 'le-comptoir-suisse'); ?>')) {
                $('#comptoir-gallery-container').empty();
                updateGalleryInput();
            }
        });
        
        // PDF Uploader
        $('.comptoir-upload-pdf-btn').on('click', function(e) {
            e.preventDefault();
            
            var button = $(this);
            var key = button.data('key');
            
            var frame = wp.media({
                title: '<?php esc_html_e('Select PDF File', 'le-comptoir-suisse'); ?>',
                button: {
                    text: '<?php esc_html_e('Use this file', 'le-comptoir-suisse'); ?>'
                },
                multiple: false,
                library: {
                    type: 'application/pdf'
                }
            });
            
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $('#' + key + '_id').val(attachment.id);
                $('#' + key + '_filename').html('<a href="' + attachment.url + '" target="_blank">' + attachment.filename + '</a>');
                $('#' + key + '_remove').show();
            });
            
            frame.open();
        });
        
        // Remove PDF
        $('.comptoir-remove-pdf-btn').on('click', function(e) {
            e.preventDefault();
            
            var button = $(this);
            var key = button.data('key');
            
            $('#' + key + '_id').val('');
            $('#' + key + '_filename').html('<?php esc_html_e('No file selected', 'le-comptoir-suisse'); ?>');
            button.hide();
        });
    });
    </script>
    <?php
}

/**
 * Render PDF Uploader Field
 */
function comptoir_render_pdf_uploader($key, $menus) {
    $pdf_id = isset($menus[$key]) ? $menus[$key] : '';
    $pdf_url = '';
    $pdf_filename = __('No file selected', 'le-comptoir-suisse');
    
    if ($pdf_id) {
        $pdf_url = wp_get_attachment_url($pdf_id);
        if ($pdf_url) {
            $pdf_filename = basename($pdf_url);
        }
    }
    ?>
    <div class="comptoir-pdf-uploader">
        <input type="hidden" 
               id="<?php echo esc_attr($key); ?>_id" 
               name="comptoir_menus[<?php echo esc_attr($key); ?>]" 
               value="<?php echo esc_attr($pdf_id); ?>">
        
        <div class="comptoir-pdf-filename" id="<?php echo esc_attr($key); ?>_filename">
            <?php if ($pdf_url) : ?>
                <a href="<?php echo esc_url($pdf_url); ?>" target="_blank"><?php echo esc_html($pdf_filename); ?></a>
            <?php else : ?>
                <?php esc_html_e('No file selected', 'le-comptoir-suisse'); ?>
            <?php endif; ?>
        </div>
        
        <button type="button" 
                class="button comptoir-upload-pdf-btn" 
                data-key="<?php echo esc_attr($key); ?>">
            <?php esc_html_e('Upload PDF', 'le-comptoir-suisse'); ?>
        </button>
        
        <button type="button" 
                class="button comptoir-remove-pdf-btn" 
                data-key="<?php echo esc_attr($key); ?>"
                id="<?php echo esc_attr($key); ?>_remove"
                style="<?php echo $pdf_id ? '' : 'display:none;'; ?>">
            <?php esc_html_e('Remove', 'le-comptoir-suisse'); ?>
        </button>
    </div>
    <?php
}
