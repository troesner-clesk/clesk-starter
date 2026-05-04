<?php
if (!defined('ABSPATH')) exit;
/**
 * Clesk Starter Theme functions and definitions
 *
 * @package Clesk_Starter
 */

// Theme setup (menus, theme support, etc.)
require_once get_template_directory() . '/inc/setup.php';

// WordPress cleanup & performance
require_once get_template_directory() . '/inc/cleanup.php';

// CSS/JS enqueue
require_once get_template_directory() . '/inc/enqueue.php';

// Helper functions
require_once get_template_directory() . '/inc/helpers.php';

// Theme options page (component activation)
require_once get_template_directory() . '/inc/theme-options.php';

// SCF Flexible Content field definitions
require_once get_template_directory() . '/inc/scf-fields.php';

// Component loader
require_once get_template_directory() . '/inc/scf-components-loader.php';

// Navigation walkers
require_once get_template_directory() . '/inc/class-clesk-nav-walker.php';
require_once get_template_directory() . '/inc/class-clesk-mobile-walker.php';

// CF7 auto-forms
require_once get_template_directory() . '/inc/cf7-auto-forms.php';

// JSON-LD baseline (Organization, WebSite, Article)
require_once get_template_directory() . '/inc/jsonld.php';
