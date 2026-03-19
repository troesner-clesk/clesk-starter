<?php
if (!defined('ABSPATH')) exit;
/**
 * Helper functions
 *
 * @package Clesk_Starter
 */

/**
 * Get a design token CSS variable with fallback
 *
 * @param string $token The token name (e.g. 'color-primary')
 * @param string $fallback Optional fallback value
 * @return string CSS var() expression
 */
function clesk_token($token, $fallback = '') {
    if ($fallback) {
        return "var(--{$token}, {$fallback})";
    }
    return "var(--{$token})";
}

/**
 * Render an SVG placeholder image
 *
 * @param int $width
 * @param int $height
 * @param string $text
 * @return string SVG markup
 */
function clesk_placeholder_svg($width = 800, $height = 600, $text = '') {
    $display_text = $text ?: "{$width} × {$height}";
    return '<svg xmlns="http://www.w3.org/2000/svg" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" viewBox="0 0 ' . esc_attr($width) . ' ' . esc_attr($height) . '"><rect fill="#e5e7eb" width="100%" height="100%"/><text fill="#9ca3af" font-family="sans-serif" font-size="24" text-anchor="middle" x="50%" y="50%" dominant-baseline="middle">' . esc_html($display_text) . '</text></svg>';
}

/**
 * Check if a component is active
 *
 * @param string $component_key
 * @return bool
 */
function clesk_is_component_active($component_key) {
    $active = get_option('clesk_active_components', array());
    return in_array($component_key, $active, true);
}

/**
 * Get active variants for a component
 *
 * Returns the list of enabled variant keys. If no variant config exists
 * (e.g. first use before saving), all variants are returned (backwards-compatible).
 *
 * @param string $component_key Component key (e.g. 'hero', 'features')
 * @param array  $all_variant_keys All possible variant keys for this component
 * @return array Active variant keys
 */
function clesk_get_active_variants($component_key, $all_variant_keys = array()) {
    $active_variants = get_option('clesk_active_variants', array());

    if (!isset($active_variants[$component_key])) {
        // No config yet — return all (backwards-compatible)
        return $all_variant_keys;
    }

    return $active_variants[$component_key];
}

/**
 * Filter SCF style choices to only include active variants
 *
 * @param array  $choices All choices (key => label)
 * @param string $component_key Component key
 * @return array Filtered choices
 */
function clesk_filter_variant_choices($choices, $component_key) {
    $active = clesk_get_active_variants($component_key, array_keys($choices));

    if (empty($active)) {
        // Safety: return all if nothing is configured
        return $choices;
    }

    return array_intersect_key($choices, array_flip($active));
}

/**
 * Get social icon SVG paths
 *
 * @return array Platform => SVG inner markup
 */
function clesk_get_social_icons() {
    return array(
        'facebook'  => '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>',
        'instagram' => '<rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>',
        'linkedin'  => '<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/>',
        'xing'      => '<path d="M5.77 16.8c.37 0 .68-.22.94-.67 2.39-4.23 3.63-6.44 3.73-6.61L8.07 5.38C7.82 4.96 7.53 4.73 7.11 4.73H3.64c-.22 0-.38.07-.46.22-.11.14-.1.32.01.54l2.34 4.05s0 .01 0 .01L1.85 16.02c-.14.28-.14.52 0 .52.1.17.25.25.45.25z"/><path d="M21.69 0h-3.5c-.38 0-.69.22-.93.65C12.3 9.45 9.73 14 9.56 14.31l4.92 9.02c.17.31.44.67.96.67h3.47c.15 0 .26-.04.33-.13.1-.16.09-.34-.01-.54l-4.88-8.88v-.01L22.16.75c.11-.2.11-.38 0-.54C22.07.07 21.9 0 21.69 0"/>',
        'twitter'   => '<path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/>',
        'youtube'   => '<path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19.1c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/>',
    );
}

/**
 * Render social link icons
 *
 * @param string $size CSS class for icon size (w-4 h-4, w-5 h-5)
 * @param string $btn_class Additional classes for the link wrapper
 */
function clesk_render_social_icons($size = 'w-5 h-5', $btn_class = 'w-9 h-9 rounded-lg') {
    $social_links = get_option('clesk_social_links', array());
    if (empty(array_filter($social_links))) {
        return;
    }
    $icons = clesk_get_social_icons();
    echo '<div class="flex gap-3">';
    foreach ($social_links as $platform => $url) {
        if (empty($url) || !isset($icons[$platform])) continue;
        echo '<a href="' . esc_url($url) . '" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center ' . esc_attr($btn_class) . ' text-[var(--color-text-muted)] hover:text-[var(--color-primary)] transition-colors" aria-label="' . esc_attr(ucfirst($platform)) . '">';
        echo '<svg class="' . esc_attr($size) . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">';
        echo $icons[$platform];
        echo '</svg></a>';
    }
    echo '</div>';
}
