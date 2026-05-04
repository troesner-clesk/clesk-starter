<?php
if (!defined('ABSPATH')) exit;
/**
 * JSON-LD baseline
 *
 * Emits Organization + WebSite on every page and Article on single posts.
 * Auto-disables itself when a SEO plugin (Yoast, Rank Math, SEOPress, AIOSEO)
 * is active to avoid duplicate schema.
 *
 * Each block can be filtered or fully disabled via:
 *   add_filter('clesk_emit_jsonld', '__return_false');           // master switch
 *   add_filter('clesk_jsonld_organization', $cb);                // mutate org block
 *   add_filter('clesk_jsonld_website', $cb);                     // mutate website block
 *   add_filter('clesk_jsonld_article', $cb, 10, 2);              // mutate article block
 *
 * @package Clesk_Starter
 */

function clesk_jsonld_seo_plugin_active() {
    return defined('WPSEO_VERSION')
        || defined('RANK_MATH_VERSION')
        || defined('SEOPRESS_VERSION')
        || defined('AIOSEO_VERSION')
        || class_exists('WPSEO_Frontend')
        || class_exists('RankMath');
}

function clesk_jsonld_emit($data) {
    if (empty($data) || !is_array($data)) return;
    echo "\n<script type=\"application/ld+json\">"
        . wp_json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
        . "</script>\n";
}

function clesk_jsonld_render() {
    if (is_admin() || is_feed()) return;

    $enabled = !clesk_jsonld_seo_plugin_active();
    $enabled = apply_filters('clesk_emit_jsonld', $enabled);
    if (!$enabled) return;

    $org = apply_filters('clesk_jsonld_organization', array(
        '@context' => 'https://schema.org',
        '@type'    => 'Organization',
        'name'     => get_bloginfo('name'),
        'url'      => home_url('/'),
    ));
    if (!empty($org['name'])) {
        clesk_jsonld_emit($org);
    }

    $site = apply_filters('clesk_jsonld_website', array(
        '@context'   => 'https://schema.org',
        '@type'      => 'WebSite',
        'name'       => get_bloginfo('name'),
        'url'        => home_url('/'),
        'inLanguage' => get_bloginfo('language'),
    ));
    if (!empty($site['name'])) {
        clesk_jsonld_emit($site);
    }

    if (is_singular('post')) {
        $post = get_post();
        if ($post) {
            $article = array(
                '@context'      => 'https://schema.org',
                '@type'         => 'Article',
                'headline'      => get_the_title($post),
                'datePublished' => get_the_date('c', $post),
                'dateModified'  => get_the_modified_date('c', $post),
                'author'        => array(
                    '@type' => 'Person',
                    'name'  => get_the_author_meta('display_name', $post->post_author),
                ),
                'mainEntityOfPage' => get_permalink($post),
            );
            $article = apply_filters('clesk_jsonld_article', $article, $post);
            clesk_jsonld_emit($article);
        }
    }
}
add_action('wp_head', 'clesk_jsonld_render', 5);
