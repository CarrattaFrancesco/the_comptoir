<?php
/**
 * Custom Navigation Walker Classes
 * 
 * @package Le_Comptoir_Suisse
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Desktop Navigation Walker
 */
class Comptoir_Nav_Walker extends Walker_Nav_Menu {
    
    /**
     * Start Level - open submenu container
     */
    function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class=\"dropdown-menu\">\n";
    }
    
    /**
     * End Level - close submenu container
     */
    function end_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</div>\n";
    }
    
    /**
     * Start Element - individual menu item
     */
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        
        // Check if this item has children
        $has_children = in_array('menu-item-has-children', $classes);
        
        if ($has_children && $depth === 0) {
            $output .= $indent . '<div class="nav-dropdown">';
            $output .= '<span class="nav-link" style="cursor: pointer;">' . esc_html($item->title) . '</span>';
        } else {
            $attributes = '';
            $attributes .= !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
            $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
            $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
            $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
            
            $link_class = ($depth === 0) ? 'nav-link' : 'dropdown-link';
            
            $item_output = $args->before ?? '';
            $item_output .= '<a' . $attributes . ' class="' . $link_class . '">';
            $item_output .= ($args->link_before ?? '') . esc_html($item->title) . ($args->link_after ?? '');
            $item_output .= '</a>';
            $item_output .= $args->after ?? '';
            
            $output .= $indent . $item_output;
        }
    }
    
    /**
     * End Element - close menu item container if needed
     */
    function end_el(&$output, $item, $depth = 0, $args = null) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes);
        
        if ($has_children && $depth === 0) {
            $output .= "</div>\n";
        }
    }
}

/**
 * Mobile Navigation Walker
 */
class Comptoir_Mobile_Nav_Walker extends Walker_Nav_Menu {
    
    /**
     * Start Level - open submenu container
     */
    function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class=\"mobile-submenu\">\n";
    }
    
    /**
     * End Level - close submenu container
     */
    function end_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</div>\n";
    }
    
    /**
     * Start Element - individual menu item
     */
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        
        // Check if this item has children
        $has_children = in_array('menu-item-has-children', $classes);
        
        if ($has_children && $depth === 0) {
            $output .= $indent . '<div class="mobile-submenu-toggle mobile-menu-link">';
            $output .= esc_html($item->title);
        } else {
            $attributes = '';
            $attributes .= !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
            $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
            $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
            $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
            
            $link_class = ($depth === 0) ? 'mobile-menu-link' : 'mobile-submenu-link';
            
            $item_output = $args->before ?? '';
            $item_output .= '<a' . $attributes . ' class="' . $link_class . '">';
            $item_output .= ($args->link_before ?? '') . esc_html($item->title) . ($args->link_after ?? '');
            $item_output .= '</a>';
            $item_output .= $args->after ?? '';
            
            $output .= $indent . $item_output;
        }
    }
    
    /**
     * End Element - close menu item container if needed
     */
    function end_el(&$output, $item, $depth = 0, $args = null) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes);
        
        if ($has_children && $depth === 0) {
            $output .= "</div>\n";
        }
    }
}
