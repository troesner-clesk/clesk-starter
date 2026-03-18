<?php
if (!defined('ABSPATH')) exit;
/**
 * Enqueue styles and scripts
 *
 * Uses Vite dev server in development (CLESK_DEV_MODE = true in wp-config.php)
 * and compiled assets in production.
 *
 * @package Clesk_Starter
 */

function clesk_enqueue_assets() {
    $dev_server = 'http://localhost:5173';
    $is_dev = defined('CLESK_DEV_MODE') && CLESK_DEV_MODE;

    if ($is_dev) {
        // Vite Dev Server
        wp_enqueue_script('vite-client', $dev_server . '/@vite/client', array(), null, false);
        // Tell the browser this is a module
        add_filter('script_loader_tag', function ($tag, $handle) {
            if ($handle === 'vite-client' || $handle === 'clesk-app') {
                return str_replace(' src', ' type="module" src', $tag);
            }
            return $tag;
        }, 10, 2);

        wp_enqueue_script('clesk-app', $dev_server . '/src/js/app.js', array(), null, true);

        // In dev mode, Vite handles CSS via JS injection – but we also load our CSS entry
        wp_enqueue_style('clesk-dev-css', $dev_server . '/src/css/app.css', array(), null);
    } else {
        // Production Build
        $theme_dir = get_template_directory();
        $theme_uri = get_template_directory_uri();

        if (file_exists($theme_dir . '/dist/style.css')) {
            wp_enqueue_style(
                'clesk-style',
                $theme_uri . '/dist/style.css',
                array(),
                filemtime($theme_dir . '/dist/style.css')
            );
        }

        if (file_exists($theme_dir . '/dist/app.js')) {
            wp_enqueue_script(
                'clesk-app',
                $theme_uri . '/dist/app.js',
                array(),
                filemtime($theme_dir . '/dist/app.js'),
                true
            );
        }
    }

    // Preline JS via CDN — pinned to specific version for security
    wp_enqueue_script(
        'preline',
        'https://cdn.jsdelivr.net/npm/preline@2.6.0/dist/preline.min.js',
        array(),
        '2.6.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'clesk_enqueue_assets');
