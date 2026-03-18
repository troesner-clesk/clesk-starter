<?php
if (!defined('ABSPATH')) exit;
/**
 * Theme setup: theme support, menus, content width
 *
 * @package Clesk_Starter
 */

function clesk_theme_setup() {
    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Post thumbnails
    add_theme_support('post-thumbnails');

    // HTML5 markup
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Navigation menus
    register_nav_menus(array(
        'primary'      => __('Primary Menu', 'clesk-starter'),
        'footer'       => __('Footer Menu (all variants)', 'clesk-starter'),
        'footer_col_1' => __('Footer Column 1 (Multi-Column footer)', 'clesk-starter'),
        'footer_col_2' => __('Footer Column 2 (Multi-Column footer)', 'clesk-starter'),
        'footer_col_3' => __('Footer Column 3 (Multi-Column footer, above social icons)', 'clesk-starter'),
    ));

    // Custom logo
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 250,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'clesk_theme_setup');

/**
 * Set content width
 */
function clesk_content_width() {
    $GLOBALS['content_width'] = apply_filters('clesk_content_width', 1360);
}
add_action('after_setup_theme', 'clesk_content_width', 0);

/**
 * Disable Gutenberg block editor
 *
 * This theme uses SCF Flexible Content for page building.
 * The classic editor provides a cleaner editing experience for this workflow.
 */
add_filter('use_block_editor_for_post', '__return_false');
add_filter('use_block_editor_for_post_type', '__return_false');

/**
 * Remove block editor assets from frontend
 */
function clesk_dequeue_block_styles() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
    wp_dequeue_style('classic-theme-styles');
}
add_action('wp_enqueue_scripts', 'clesk_dequeue_block_styles', 100);

/**
 * Hide the classic editor on pages
 *
 * All page content is built via SCF Flexible Content components.
 * The editor would only confuse content editors.
 */
function clesk_hide_editor_on_pages() {
    global $pagenow, $post_type;
    if ($pagenow === 'post.php' || $pagenow === 'post-new.php') {
        if ($post_type === 'page' || (isset($_GET['post']) && get_post_type(absint($_GET['post'])) === 'page')) {
            remove_post_type_support('page', 'editor');
        }
    }
}
add_action('admin_init', 'clesk_hide_editor_on_pages');

/**
 * Remove Block Patterns from admin menu
 *
 * Not needed – this theme uses SCF Flexible Content for page building.
 */
function clesk_remove_patterns_menu() {
    remove_submenu_page('themes.php', 'edit.php?post_type=wp_block');
}
add_action('admin_menu', 'clesk_remove_patterns_menu');

/**
 * Show admin notice if SCF (Secure Custom Fields) is not installed
 *
 * SCF is required for the page builder components to work.
 */
function clesk_scf_admin_notice() {
    if (class_exists('ACF')) {
        return;
    }

    $install_url = admin_url('plugin-install.php?s=secure+custom+fields&tab=search&type=term');
    ?>
    <div class="notice notice-error">
        <p>
            <strong>Clesk Starter:</strong>
            <?php
            printf(
                esc_html__('This theme requires the %s plugin to work. The page builder components will not appear without it.', 'clesk-starter'),
                '<a href="' . esc_url($install_url) . '">Secure Custom Fields (SCF)</a>'
            );
            ?>
        </p>
    </div>
    <?php
}
add_action('admin_notices', 'clesk_scf_admin_notice');
