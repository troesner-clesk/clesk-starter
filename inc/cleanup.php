<?php
if (!defined('ABSPATH')) exit;
/**
 * WordPress cleanup & performance optimizations
 *
 * Removes unnecessary defaults that WordPress ships out of the box.
 * All optimizations are safe and non-breaking. Child themes can
 * unhook any of these functions if needed.
 *
 * @package Clesk_Starter
 */

/**
 * ─────────────────────────────────────────────
 * 1. HEAD CLEANUP
 * Remove unnecessary meta tags and links from wp_head
 * ─────────────────────────────────────────────
 */
function clesk_cleanup_head() {
    remove_action('wp_head', 'wp_generator');                  // WordPress version
    remove_action('wp_head', 'rsd_link');                      // Really Simple Discovery
    remove_action('wp_head', 'wlwmanifest_link');              // Windows Live Writer
    remove_action('wp_head', 'wp_shortlink_wp_head');          // Shortlink
    remove_action('wp_head', 'rest_output_link_wp_head');      // REST API <link> in head
    remove_action('wp_head', 'wp_oembed_add_discovery_links'); // oEmbed discovery links
    remove_action('wp_head', 'wp_resource_hints', 2);          // DNS prefetch (s.w.org)
    remove_action('wp_head', 'feed_links', 2);                 // RSS feed links
    remove_action('wp_head', 'feed_links_extra', 3);           // Extra RSS feed links
}
add_action('after_setup_theme', 'clesk_cleanup_head');

/**
 * Also remove the generator from RSS feeds
 */
add_filter('the_generator', '__return_empty_string');

/**
 * Remove WordPress version from CSS/JS query strings (?ver=6.x.x)
 * Prevents version fingerprinting via enqueued assets.
 */
function clesk_remove_version_query_strings($src) {
    if (strpos($src, 'ver=' . get_bloginfo('version')) !== false) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'clesk_remove_version_query_strings', 9999);
add_filter('script_loader_src', 'clesk_remove_version_query_strings', 9999);

/**
 * ─────────────────────────────────────────────
 * 2. DISABLE WORDPRESS EMOJIS
 * Modern browsers render emojis natively – the WP emoji
 * script (~2KB inline JS + CSS + DNS prefetch) is a polyfill
 * for ancient browsers nobody uses anymore.
 * ─────────────────────────────────────────────
 */
function clesk_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

    add_filter('tiny_mce_plugins', function ($plugins) {
        return is_array($plugins) ? array_diff($plugins, array('wpemoji')) : array();
    });

    add_filter('wp_resource_hints', function ($urls, $relation_type) {
        if ($relation_type === 'dns-prefetch') {
            $urls = array_filter($urls, function ($url) {
                return strpos($url, 'https://s.w.org') === false;
            });
        }
        return $urls;
    }, 10, 2);
}
add_action('init', 'clesk_disable_emojis');

/**
 * ─────────────────────────────────────────────
 * 3. DEREGISTER JQUERY ON FRONTEND
 * This theme uses vanilla JS + Preline UI – zero jQuery.
 * jQuery stays available in wp-admin for plugin compatibility.
 * ─────────────────────────────────────────────
 */
function clesk_deregister_jquery_frontend() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', false, array(), false, true);
        wp_deregister_script('jquery-migrate');
    }
}
add_action('wp_enqueue_scripts', 'clesk_deregister_jquery_frontend', 20);

/**
 * ─────────────────────────────────────────────
 * 4. DISABLE XML-RPC
 * Legacy API replaced by the REST API. Common target for
 * brute-force attacks. No modern plugin requires it.
 * ─────────────────────────────────────────────
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Remove X-Pingback HTTP header
 */
function clesk_remove_x_pingback_header($headers) {
    unset($headers['X-Pingback']);
    return $headers;
}
add_filter('wp_headers', 'clesk_remove_x_pingback_header');

/**
 * ─────────────────────────────────────────────
 * 5. HEARTBEAT API
 * Disable on frontend (never needed there).
 * Reduce frequency in admin from 15s to 60s.
 * ─────────────────────────────────────────────
 */
function clesk_limit_heartbeat($settings) {
    $settings['interval'] = 60;
    return $settings;
}
add_filter('heartbeat_settings', 'clesk_limit_heartbeat');

/**
 * Dequeue heartbeat on frontend (not needed outside wp-admin)
 */
function clesk_dequeue_heartbeat_frontend() {
    if (!is_admin()) {
        wp_deregister_script('heartbeat');
    }
}
add_action('wp_enqueue_scripts', 'clesk_dequeue_heartbeat_frontend', 1);

/**
 * ─────────────────────────────────────────────
 * 6. DISABLE PINGBACKS & SELF-PINGS
 * Pingbacks are a relic from the early blog era and are
 * commonly exploited for DDoS amplification attacks.
 * ─────────────────────────────────────────────
 */
add_filter('xmlrpc_methods', function ($methods) {
    unset($methods['pingback.ping']);
    unset($methods['pingback.extensions.getPingbacks']);
    return $methods;
});

/**
 * Prevent self-pings (WordPress pinging itself on internal links)
 */
function clesk_disable_self_pingbacks(&$links) {
    $home_url = home_url();
    foreach ($links as $key => $link) {
        if (strpos($link, $home_url) === 0) {
            unset($links[$key]);
        }
    }
}
add_action('pre_ping', 'clesk_disable_self_pingbacks');

/**
 * ─────────────────────────────────────────────
 * 7. ALLOW SVG UPLOADS
 * Adds SVG to the allowed MIME types.
 * Sanitizes SVG content on upload to prevent XSS.
 * ─────────────────────────────────────────────
 */
function clesk_allow_svg_upload($mimes) {
    $mimes['svg']  = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'clesk_allow_svg_upload');

/**
 * Fix SVG file type detection (WordPress sometimes fails to identify SVGs)
 */
function clesk_fix_svg_filetype($data, $file, $filename, $mimes) {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if ($ext === 'svg' || $ext === 'svgz') {
        $data['type'] = 'image/svg+xml';
        $data['ext']  = $ext;
    }
    return $data;
}
add_filter('wp_check_filetype_and_ext', 'clesk_fix_svg_filetype', 10, 4);

/**
 * Sanitize SVG uploads — strip dangerous elements and attributes
 */
function clesk_sanitize_svg_upload($file) {
    if ($file['type'] !== 'image/svg+xml') {
        return $file;
    }

    $content = file_get_contents($file['tmp_name']);
    if ($content === false) {
        $file['error'] = 'Could not read SVG file.';
        return $file;
    }

    // Strip PHP tags
    $content = preg_replace('/<\?.*?\?>/s', '', $content);

    // Strip script tags
    $content = preg_replace('/<script[\s\S]*?<\/script>/i', '', $content);

    // Strip event handler attributes (onclick, onload, onerror, etc.)
    $content = preg_replace('/\s+on\w+\s*=\s*["\'][^"\']*["\']/i', '', $content);

    // Strip javascript: and data: URIs in attributes
    $content = preg_replace('/(?:href|xlink:href|src)\s*=\s*["\'](?:javascript|data):[^"\']*["\']/i', '', $content);

    // Strip <use> elements referencing external resources
    $content = preg_replace('/<use[^>]+href\s*=\s*["\'](?!#)[^"\']*["\'][^>]*\/?>/i', '', $content);

    file_put_contents($file['tmp_name'], $content);
    return $file;
}
add_filter('wp_handle_upload_prefilter', 'clesk_sanitize_svg_upload');
