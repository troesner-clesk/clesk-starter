<?php
if (!defined('ABSPATH')) exit;
/**
 * Component Loader
 *
 * Renders the active Flexible Content component.
 * Called from page.php.
 *
 * Checks for Child Theme override first, then falls back to Parent Theme.
 *
 * @package Clesk_Starter
 */

/**
 * Show the selected style variant in the Flexible Content layout title
 */
function clesk_flexible_content_layout_title($title, $field, $layout, $i) {
    // Map layout names to their style field
    $style_fields = array(
        'hero'           => 'hero_style',
        'text_image'     => 'ti_layout',
        'cta'            => 'cta_style',
        'faq'            => 'faq_style',
        'features'       => 'features_style',
        'text_block'     => 'tb_style',
        'testimonials'   => 'testimonials_style',
        'logo_cloud'     => 'logo_cloud_style',
        'stats'          => 'stats_style',
        'spacer_divider' => 'spacer_divider_style',
        'banner'         => 'banner_style',
        'cards_grid'     => 'cards_grid_style',
        'team'           => 'team_style',
        'steps'          => 'steps_style',
        'timeline'       => 'timeline_style',
        'video'          => 'video_style',
        'gallery'        => 'gallery_style',
        'blog_teaser'    => 'blog_teaser_style',
        'contact_form'   => 'contact_form_style',
        'newsletter'     => 'newsletter_style',
        'pricing'        => 'pricing_style',
        'map'            => 'map_style',
        'tabs'           => 'tabs_style',
    );

    $layout_name = $layout['name'] ?? '';
    if (isset($style_fields[$layout_name])) {
        $style = get_sub_field($style_fields[$layout_name]);
        if ($style) {
            $title .= ' <span style="opacity:0.5;font-weight:normal;">— ' . esc_html(ucwords(str_replace('-', ' ', str_replace('_', ' ', $style)))) . '</span>';
        }
    }

    return $title;
}
add_filter('acf/fields/flexible_content/layout_title', 'clesk_flexible_content_layout_title', 10, 4);

/**
 * Collapse all Flexible Content layouts by default on page load
 */
function clesk_collapse_flexible_content() {
    ?>
    <script>
    (function() {
        if (typeof acf === 'undefined') return;
        acf.addAction('ready', function() {
            document.querySelectorAll('.acf-flexible-content .layout:not(.-collapsed)').forEach(function(el) {
                var toggle = el.querySelector('.acf-fc-layout-controls .-collapse');
                if (toggle) toggle.click();
            });
        });
    })();
    </script>
    <?php
}
add_action('acf/input/admin_footer', 'clesk_collapse_flexible_content');

function clesk_render_components() {
    if (!have_rows('clesk_components')) {
        return;
    }

    $component_counts = array();

    while (have_rows('clesk_components')) {
        the_row();
        $layout = get_row_layout();
        $component_name = str_replace('_', '-', $layout);
        $component_file = $component_name . '/' . $component_name . '.php';

        // Track occurrences for unique IDs
        if (!isset($component_counts[$layout])) {
            $component_counts[$layout] = 0;
        }
        $component_counts[$layout]++;

        // Generate section ID: "hero", "hero-2", "hero-3", etc.
        $section_id = $component_name;
        if ($component_counts[$layout] > 1) {
            $section_id .= '-' . $component_counts[$layout];
        }

        echo '<div id="' . esc_attr($section_id) . '">';

        // Check Child Theme first, then Parent Theme
        $child_path = get_stylesheet_directory() . '/components/' . $component_file;
        $parent_path = get_template_directory() . '/components/' . $component_file;

        if (file_exists($child_path)) {
            include $child_path;
        } elseif (file_exists($parent_path)) {
            include $parent_path;
        }

        echo '</div>';
    }
}
