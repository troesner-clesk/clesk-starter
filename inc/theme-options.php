<?php
if (!defined('ABSPATH')) exit;
/**
 * Theme Options page with tabbed interface
 *
 * Tab 1: Components — activate/deactivate components and their variants
 * Tab 2: Header & Footer — choose variants, social links
 *
 * @package Clesk_Starter
 */

function clesk_register_options_page() {
    add_menu_page(
        'Clesk Framework',
        'Clesk Framework',
        'manage_options',
        'clesk-options',
        'clesk_options_page_html',
        'dashicons-layout',
        60
    );
}
add_action('admin_menu', 'clesk_register_options_page');

/**
 * Get all components with metadata
 *
 * Variants are key => label pairs matching the SCF field choices.
 *
 * @return array Component definitions
 */
function clesk_get_all_components() {
    return array(
        // --- v1.0 Components ---
        'hero' => array(
            'label'       => 'Hero Section',
            'description' => 'Full-width intro section with headline, text and CTA',
            'variants'    => array(
                'centered'      => 'Centered',
                'left-aligned'  => 'Left Aligned',
                'with-image'    => 'With Image',
                'text-on-image' => 'Text on Background Image',
                'carousel'      => 'Image Carousel',
                'video-play'    => 'Video Play Button',
            ),
            'available'   => true,
        ),
        'text_image' => array(
            'label'       => 'Text + Image',
            'description' => 'Two-column section with text and image',
            'variants'    => array(
                'image-left'  => 'Image Left',
                'image-right' => 'Image Right',
            ),
            'available'   => true,
        ),
        'cta' => array(
            'label'       => 'Call to Action',
            'description' => 'Prominent call to action with button',
            'variants'    => array(
                'simple'    => 'Simple',
                'highlight' => 'Highlighted',
                'dark'      => 'Dark',
            ),
            'available'   => true,
        ),
        'faq' => array(
            'label'       => 'FAQ / Accordion',
            'description' => 'Expandable question & answer items',
            'variants'    => array(
                'simple'      => 'Simple',
                'bordered'    => 'Bordered',
                'two-columns' => 'Two Columns',
                'with-image'  => 'With Image',
            ),
            'available'   => true,
        ),
        'features' => array(
            'label'       => 'Features / Icon Grid',
            'description' => 'Feature grid with icons, titles and descriptions',
            'variants'    => array(
                'grid-3'  => '3 Columns',
                'grid-4'  => '4 Columns',
                'list'    => 'List',
                'split'   => 'Description Left + Icons Right',
                'medium'  => 'Large Description + Icon Grid',
            ),
            'available'   => true,
        ),
        'text_block' => array(
            'label'       => 'Text Block',
            'description' => 'Rich text content area',
            'variants'    => array(
                'normal' => 'Normal',
                'narrow' => 'Narrow',
            ),
            'available'   => true,
        ),
        // --- v1.1 Components ---
        'testimonials' => array(
            'label'       => 'Testimonials',
            'description' => 'Customer quotes and reviews',
            'variants'    => array(
                'grid'         => 'Grid',
                'single-quote' => 'Single Quote',
                'cards'        => 'Cards',
            ),
            'available'   => true,
        ),
        'logo_cloud' => array(
            'label'       => 'Logo Cloud',
            'description' => 'Partner and client logos',
            'variants'    => array(
                'row'     => 'Row',
                'grid'    => 'Grid',
                'marquee' => 'Marquee',
            ),
            'available'   => true,
        ),
        'stats' => array(
            'label'       => 'Statistics / Numbers',
            'description' => 'Key numbers and statistics',
            'variants'    => array(
                'inline'     => 'Inline',
                'cards'      => 'Cards',
                'icon-cards' => 'Icon Cards',
            ),
            'available'   => true,
        ),
        'spacer_divider' => array(
            'label'       => 'Spacer / Divider',
            'description' => 'Visual spacing and dividers',
            'variants'    => array(
                'empty' => 'Empty Space',
                'line'  => 'Line',
                'wave'  => 'Wave',
            ),
            'available'   => true,
        ),
        'banner' => array(
            'label'       => 'Banner / Notice',
            'description' => 'Announcement or notice bar',
            'variants'    => array(
                'info'    => 'Info',
                'warning' => 'Warning',
                'promo'   => 'Promo',
            ),
            'available'   => true,
        ),
        // --- v1.2 Components ---
        'cards_grid' => array(
            'label'       => 'Cards Grid',
            'description' => 'Flexible card layout',
            'variants'    => array(
                'two-columns'   => '2 Columns',
                'three-columns' => '3 Columns',
                'four-columns'  => '4 Columns',
            ),
            'available'   => true,
        ),
        'team' => array(
            'label'       => 'Team',
            'description' => 'Team member profiles',
            'variants'    => array(
                'grid'  => 'Grid',
                'cards' => 'Cards',
                'list'  => 'List',
            ),
            'available'   => true,
        ),
        'steps' => array(
            'label'       => 'Steps / Process',
            'description' => 'Process or workflow visualization',
            'variants'    => array(
                'numbered'  => 'Numbered',
                'icon'      => 'Icon',
                'connector' => 'Connector',
            ),
            'available'   => true,
        ),
        'timeline' => array(
            'label'       => 'Timeline',
            'description' => 'Chronological event timeline',
            'variants'    => array(
                'vertical'    => 'Vertical',
                'alternating' => 'Alternating',
                'horizontal'  => 'Horizontal',
            ),
            'available'   => true,
        ),
        // --- v1.3 Components ---
        'video' => array(
            'label'       => 'Video Embed',
            'description' => 'YouTube, Vimeo or self-hosted video',
            'variants'    => array(
                'simple'     => 'Simple',
                'overlay'    => 'Overlay',
                'background' => 'Background',
            ),
            'available'   => true,
        ),
        'gallery' => array(
            'label'       => 'Gallery',
            'description' => 'Image gallery with multiple layouts',
            'variants'    => array(
                'grid'    => 'Grid',
                'masonry' => 'Masonry',
                'slider'  => 'Slider',
            ),
            'available'   => true,
        ),
        'blog_teaser' => array(
            'label'       => 'Blog Teaser',
            'description' => 'Latest posts preview',
            'variants'    => array(
                'grid'     => 'Grid',
                'list'     => 'List',
                'featured' => 'Featured',
            ),
            'available'   => true,
        ),
        // --- v1.4 Components ---
        'contact_form' => array(
            'label'       => 'Contact Form (CF7)',
            'description' => 'Contact Form 7 shortcode wrapper',
            'variants'    => array(
                'simple'    => 'Simple',
                'split'     => 'Split',
                'with-info' => 'With Info',
            ),
            'available'   => true,
        ),
        'newsletter' => array(
            'label'       => 'Newsletter Signup',
            'description' => 'Email subscription form',
            'variants'    => array(
                'inline'   => 'Inline',
                'centered' => 'Centered',
                'split'    => 'Split',
            ),
            'available'   => true,
        ),
        'pricing' => array(
            'label'       => 'Pricing Table',
            'description' => 'Pricing comparison table',
            'variants'    => array(
                'two-columns'   => '2 Columns',
                'three-columns' => '3 Columns',
                'comparison'    => 'Comparison',
            ),
            'available'   => true,
        ),
        // --- v1.5 Components ---
        'map' => array(
            'label'       => 'Map',
            'description' => 'Location map embed',
            'variants'    => array(
                'google-maps'   => 'Google Maps',
                'openstreetmap' => 'OpenStreetMap',
            ),
            'available'   => true,
        ),
        'tabs' => array(
            'label'       => 'Tabs',
            'description' => 'Tabbed content with cards or image-text layouts per tab',
            'variants'    => array(
                'horizontal' => 'Horizontal',
            ),
            'available'   => true,
        ),
    );
}

/**
 * Render the options page HTML with tabbed interface
 */
function clesk_options_page_html() {
    if (!current_user_can('manage_options')) {
        return;
    }

    $current_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'components';

    // Handle form submissions
    if (isset($_POST['clesk_save_components']) && check_admin_referer('clesk_options_nonce')) {
        $active = isset($_POST['clesk_components'])
            ? array_map('sanitize_text_field', $_POST['clesk_components'])
            : array();
        update_option('clesk_active_components', $active);

        // Save active variants per component
        $all_components = clesk_get_all_components();
        $active_variants = array();
        foreach ($all_components as $comp_key => $comp) {
            if (isset($_POST['clesk_variants'][$comp_key])) {
                $active_variants[$comp_key] = array_map('sanitize_text_field', $_POST['clesk_variants'][$comp_key]);
            } else {
                // No variants checked = empty array (none active)
                $active_variants[$comp_key] = array();
            }
        }
        update_option('clesk_active_variants', $active_variants);

        echo '<div class="notice notice-success is-dismissible"><p>Component settings saved.</p></div>';
    }

    if (isset($_POST['clesk_save_header_footer']) && check_admin_referer('clesk_hf_nonce')) {
        update_option('clesk_header_variant', sanitize_text_field($_POST['clesk_header_variant'] ?? 'default'));
        update_option('clesk_footer_variant', sanitize_text_field($_POST['clesk_footer_variant'] ?? 'default'));

        $social = array();
        $platforms = array('facebook', 'instagram', 'linkedin', 'twitter', 'youtube', 'xing', 'github');
        foreach ($platforms as $platform) {
            $social[$platform] = isset($_POST['clesk_social'][$platform])
                ? esc_url_raw($_POST['clesk_social'][$platform])
                : '';
        }
        update_option('clesk_social_links', $social);

        echo '<div class="notice notice-success is-dismissible"><p>Header & Footer settings saved.</p></div>';
    }

    $page_url = admin_url('admin.php?page=clesk-options');
    ?>
    <div class="wrap">
        <h1>Clesk Framework</h1>

        <nav class="nav-tab-wrapper">
            <a href="<?php echo esc_url($page_url . '&tab=components'); ?>"
               class="nav-tab <?php echo $current_tab === 'components' ? 'nav-tab-active' : ''; ?>">
                Components
            </a>
            <a href="<?php echo esc_url($page_url . '&tab=header-footer'); ?>"
               class="nav-tab <?php echo $current_tab === 'header-footer' ? 'nav-tab-active' : ''; ?>">
                Header &amp; Footer
            </a>
        </nav>

        <?php if ($current_tab === 'components') : ?>
            <?php clesk_render_components_tab(); ?>
        <?php elseif ($current_tab === 'header-footer') : ?>
            <?php clesk_render_header_footer_tab(); ?>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Render the Components tab
 */
function clesk_render_components_tab() {
    $active_components = get_option('clesk_active_components', array());
    $active_variants   = get_option('clesk_active_variants', array());
    $all_components    = clesk_get_all_components();
    $available         = array_filter($all_components, fn($c) => $c['available']);
    $planned           = array_filter($all_components, fn($c) => !$c['available']);
    ?>
    <form method="post">
        <?php wp_nonce_field('clesk_options_nonce'); ?>

        <h2 style="margin-top:1.5em;">Available Components</h2>
        <p class="description">Activate the components you need. Only active components appear in the Page Builder. Deactivate individual variants to simplify the style dropdown.</p>
        <p>
            <button type="button" class="button" onclick="document.querySelectorAll('.clesk-comp-toggle').forEach(cb => { cb.checked = true; cb.dispatchEvent(new Event('change')); })">Activate All</button>
            <button type="button" class="button" onclick="document.querySelectorAll('.clesk-comp-toggle').forEach(cb => { cb.checked = false; cb.dispatchEvent(new Event('change')); })">Deactivate All</button>
        </p>
        <table class="form-table clesk-available">
            <?php foreach ($available as $key => $component) :
                $is_active = in_array($key, $active_components);
                // If no variant config exists yet, default to all variants active
                $comp_variants = isset($active_variants[$key]) ? $active_variants[$key] : array_keys($component['variants']);
            ?>
                <tr>
                    <th scope="row">
                        <?php echo esc_html($component['label']); ?>
                        <br><span class="description" style="font-weight:normal;"><?php echo esc_html($component['description']); ?></span>
                    </th>
                    <td style="vertical-align:top;">
                        <label>
                            <input type="checkbox"
                                   class="clesk-comp-toggle"
                                   name="clesk_components[]"
                                   value="<?php echo esc_attr($key); ?>"
                                   data-component="<?php echo esc_attr($key); ?>"
                                   <?php checked($is_active); ?>>
                            <strong>Active</strong>
                        </label>
                        <div class="clesk-variants-wrap" data-for="<?php echo esc_attr($key); ?>" style="margin-top:8px;padding-left:22px;<?php echo !$is_active ? 'opacity:0.4;pointer-events:none;' : ''; ?>">
                            <?php foreach ($component['variants'] as $vkey => $vlabel) : ?>
                                <label style="display:inline-block;margin-right:12px;margin-bottom:4px;">
                                    <input type="checkbox"
                                           name="clesk_variants[<?php echo esc_attr($key); ?>][]"
                                           value="<?php echo esc_attr($vkey); ?>"
                                           <?php checked(in_array($vkey, $comp_variants)); ?>>
                                    <?php echo esc_html($vlabel); ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <?php if (!empty($planned)) : ?>
        <h2 style="margin-top:2em;">Planned Components <span class="description" style="font-weight:normal;">(coming soon)</span></h2>
        <table class="form-table" style="opacity:0.6;">
            <?php foreach ($planned as $key => $component) : ?>
                <tr>
                    <th scope="row">
                        <?php echo esc_html($component['label']); ?>
                        <br><span class="description" style="font-weight:normal;"><?php echo esc_html($component['description']); ?></span>
                    </th>
                    <td style="vertical-align:top;">
                        <label style="color:#999;">
                            <input type="checkbox" disabled>
                            Not yet available
                        </label>
                        <br><span class="description">Variants: <?php echo esc_html(implode(', ', $component['variants'])); ?></span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>

        <p class="submit">
            <input type="submit" name="clesk_save_components" class="button-primary" value="Save Settings">
        </p>
    </form>

    <script>
    document.querySelectorAll('.clesk-comp-toggle').forEach(function(cb) {
        cb.addEventListener('change', function() {
            var wrap = document.querySelector('.clesk-variants-wrap[data-for="' + this.dataset.component + '"]');
            if (wrap) {
                wrap.style.opacity = this.checked ? '1' : '0.4';
                wrap.style.pointerEvents = this.checked ? 'auto' : 'none';
            }
        });
    });
    </script>
    <?php
}

/**
 * Render the Header & Footer tab
 */
function clesk_render_header_footer_tab() {
    $header_variant = get_option('clesk_header_variant', 'default');
    $footer_variant = get_option('clesk_footer_variant', 'default');
    $social_links   = get_option('clesk_social_links', array());

    $header_options = array(
        'default' => array(
            'label'       => 'Default',
            'description' => 'Logo left, navigation right. Classic agency layout.',
        ),
        'centered' => array(
            'label'       => 'Centered',
            'description' => 'Centered logo with navigation below. Elegant and balanced.',
        ),
        'transparent' => array(
            'label'       => 'Transparent',
            'description' => 'Transparent background that becomes solid on scroll. Best with a hero image.',
        ),
    );

    $footer_options = array(
        'default' => array(
            'label'       => 'Default',
            'description' => 'Logo with description, footer menu, and copyright.',
        ),
        'columns' => array(
            'label'       => 'Multi-Column',
            'description' => 'Logo, two menu columns, social links, and copyright bar. Uses Footer Column 1 & 2 menus.',
        ),
        'minimal' => array(
            'label'       => 'Minimal',
            'description' => 'Single line with copyright and footer menu. Clean and compact.',
        ),
    );

    $social_platforms = array(
        'facebook'  => 'Facebook',
        'instagram' => 'Instagram',
        'linkedin'  => 'LinkedIn',
        'xing'      => 'Xing',
        'twitter'   => 'Twitter / X',
        'youtube'   => 'YouTube',
        'github'    => 'GitHub',
    );
    ?>
    <form method="post">
        <?php wp_nonce_field('clesk_hf_nonce'); ?>

        <!-- Header Variant -->
        <h2 style="margin-top:1.5em;">Header Design</h2>
        <p class="description">Choose the header layout for your site. All variants support dropdown menus and mega menus.</p>
        <table class="form-table">
            <?php foreach ($header_options as $key => $option) : ?>
                <tr>
                    <th scope="row" style="width:140px;">
                        <?php echo esc_html($option['label']); ?>
                    </th>
                    <td>
                        <label>
                            <input type="radio"
                                   name="clesk_header_variant"
                                   value="<?php echo esc_attr($key); ?>"
                                   <?php checked($header_variant, $key); ?>>
                            <?php echo esc_html($option['description']); ?>
                        </label>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- Footer Variant -->
        <h2 style="margin-top:2em;">Footer Design</h2>
        <p class="description">Choose the footer layout. Configure footer menus under Appearance &rarr; Menus.</p>
        <table class="form-table">
            <?php foreach ($footer_options as $key => $option) : ?>
                <tr>
                    <th scope="row" style="width:140px;">
                        <?php echo esc_html($option['label']); ?>
                    </th>
                    <td>
                        <label>
                            <input type="radio"
                                   name="clesk_footer_variant"
                                   value="<?php echo esc_attr($key); ?>"
                                   <?php checked($footer_variant, $key); ?>>
                            <?php echo esc_html($option['description']); ?>
                        </label>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- Social Links -->
        <h2 style="margin-top:2em;">Social Links</h2>
        <p class="description">Add your social media URLs. These appear in the footer.</p>
        <table class="form-table">
            <?php foreach ($social_platforms as $key => $label) : ?>
                <tr>
                    <th scope="row">
                        <label for="clesk_social_<?php echo esc_attr($key); ?>"><?php echo esc_html($label); ?></label>
                    </th>
                    <td>
                        <input type="url"
                               id="clesk_social_<?php echo esc_attr($key); ?>"
                               name="clesk_social[<?php echo esc_attr($key); ?>]"
                               value="<?php echo esc_url($social_links[$key] ?? ''); ?>"
                               class="regular-text"
                               placeholder="https://">
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- Navigation Help -->
        <h2 style="margin-top:2em;">Navigation Tips</h2>
        <div style="background:#f0f6fc;border:1px solid #c3daf5;border-radius:4px;padding:12px 16px;max-width:700px;">
            <p style="margin:0 0 8px;"><strong>Dropdown Menus:</strong> In Appearance &rarr; Menus, drag menu items to create sub-levels. They automatically become dropdown menus.</p>
            <p style="margin:0 0 8px;"><strong>Mega Menus:</strong> Add the CSS class <code>mega-menu</code> to any top-level menu item. Its children will display in a multi-column grid. Enable CSS classes via Screen Options &rarr; CSS Classes in the menu editor.</p>
            <p style="margin:0;"><strong>Footer Columns:</strong> The Multi-Column footer uses "Footer Column 1", "Footer Column 2", and optionally "Footer Column 3" menu locations. Column 3 appears above the social icons. Create menus and assign them under Appearance &rarr; Menus.</p>
        </div>

        <p class="submit">
            <input type="submit" name="clesk_save_header_footer" class="button-primary" value="Save Settings">
        </p>
    </form>
    <?php
}
