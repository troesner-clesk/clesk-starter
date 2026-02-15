<?php
if (!defined('ABSPATH')) exit;
/**
 * Clesk Starter – Child Theme
 *
 * HOW TO USE THIS CHILD THEME:
 *
 * 1. DESIGN TOKENS
 *    Edit src/css/custom.css to override colors, fonts, spacing, etc.
 *    Run `npm run build` after changes. Every CSS variable you don't set
 *    inherits from the parent theme automatically.
 *
 * 2. COMPONENTS
 *    Activate/deactivate components in the list below (after_switch_theme hook)
 *    or via the admin: Clesk Framework → Components.
 *
 * 3. COMPONENT OVERRIDES
 *    To modify a component's HTML, copy it from the parent:
 *      cp ../clesk-starter/components/hero/hero.php components/hero/hero.php
 *    The child theme version will be used automatically.
 *
 * 4. CUSTOM FONTS
 *    Enqueue Google Fonts (or local fonts) below, then set --font-heading
 *    and --font-body in custom.css.
 *
 * 5. HEADER & FOOTER
 *    Choose variants in admin: Clesk Framework → Header & Footer.
 *    To override a header/footer template, copy from parent's template-parts/.
 *
 * @package Clesk_Starter_Child
 */

/**
 * Enqueue child theme stylesheet (compiled token overrides)
 */
function clesk_child_enqueue_styles() {
    $child_dir = get_stylesheet_directory();
    $child_uri = get_stylesheet_directory_uri();

    if (file_exists($child_dir . '/dist/custom.css')) {
        wp_enqueue_style(
            'clesk-child-style',
            $child_uri . '/dist/custom.css',
            array('clesk-style'),
            filemtime($child_dir . '/dist/custom.css')
        );
    }
}
add_action('wp_enqueue_scripts', 'clesk_child_enqueue_styles', 20);

/**
 * Set active components on theme activation
 *
 * Adjust this list to match the components your project needs.
 * Available components: hero, text_image, cta, faq, features, text_block,
 * testimonials, logo_cloud, stats, spacer_divider, banner, cards_grid,
 * team, steps, timeline, video, gallery, blog_teaser, contact_form,
 * newsletter, pricing, map
 */
function clesk_child_set_active_components() {
    update_option('clesk_active_components', array(
        'hero',
        'text_image',
        'cta',
        'faq',
        'features',
        'text_block',
    ));
}
add_action('after_switch_theme', 'clesk_child_set_active_components');

/*
 * =====================================================
 * ADD YOUR CUSTOM FUNCTIONS BELOW
 * =====================================================
 *
 * Examples:
 *
 * // Enqueue Google Fonts
 * function clesk_child_enqueue_fonts() {
 *     wp_enqueue_style('google-fonts',
 *         'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap',
 *         array(), null
 *     );
 * }
 * add_action('wp_enqueue_scripts', 'clesk_child_enqueue_fonts');
 *
 * // Add custom image sizes
 * function clesk_child_image_sizes() {
 *     add_image_size('card-thumbnail', 600, 400, true);
 * }
 * add_action('after_setup_theme', 'clesk_child_image_sizes');
 *
 * // Register a custom post type (better: use a separate plugin)
 * // See: CLAUDE.md → Architecture → CPT Plugin
 */
