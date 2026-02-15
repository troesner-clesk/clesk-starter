<?php
if (!defined('ABSPATH')) exit;
/**
 * Footer variant: Columns
 * Multi-column layout with logo, 2 menu columns, social links, and copyright bar
 *
 * @package Clesk_Starter
 */

$social_links = get_option('clesk_social_links', array());
?>
<footer class="clesk-footer bg-[var(--color-surface-dark)] border-t border-[var(--color-border)]">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
            <!-- Column 1: Logo + Description -->
            <div class="lg:col-span-1">
                <?php if (has_custom_logo()) : ?>
                    <div class="mb-3"><?php the_custom_logo(); ?></div>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="text-lg font-bold text-[var(--color-heading)] font-[var(--font-heading)]">
                        <?php echo esc_html(get_bloginfo('name')); ?>
                    </a>
                <?php endif; ?>
                <p class="mt-3 text-sm text-[var(--color-text-muted)] leading-relaxed">
                    <?php echo esc_html(get_bloginfo('description')); ?>
                </p>
            </div>

            <!-- Column 2: Menu 1 -->
            <?php if (has_nav_menu('footer_col_1')) : ?>
                <div>
                    <?php
                    $menu_locations = get_nav_menu_locations();
                    $menu_obj = isset($menu_locations['footer_col_1']) ? wp_get_nav_menu_object($menu_locations['footer_col_1']) : false;
                    if ($menu_obj) :
                    ?>
                        <h4 class="text-sm font-semibold text-[var(--color-heading)] uppercase tracking-wider mb-4">
                            <?php echo esc_html($menu_obj->name); ?>
                        </h4>
                    <?php endif; ?>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer_col_1',
                        'container'      => false,
                        'menu_class'     => 'space-y-3',
                        'fallback_cb'    => false,
                        'depth'          => 1,
                    ));
                    ?>
                </div>
            <?php endif; ?>

            <!-- Column 3: Menu 2 -->
            <?php if (has_nav_menu('footer_col_2')) : ?>
                <div>
                    <?php
                    $menu_obj2 = isset($menu_locations['footer_col_2']) ? wp_get_nav_menu_object($menu_locations['footer_col_2']) : false;
                    if ($menu_obj2) :
                    ?>
                        <h4 class="text-sm font-semibold text-[var(--color-heading)] uppercase tracking-wider mb-4">
                            <?php echo esc_html($menu_obj2->name); ?>
                        </h4>
                    <?php endif; ?>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer_col_2',
                        'container'      => false,
                        'menu_class'     => 'space-y-3',
                        'fallback_cb'    => false,
                        'depth'          => 1,
                    ));
                    ?>
                </div>
            <?php endif; ?>

            <!-- Column 4: Social Links -->
            <?php if (!empty(array_filter($social_links))) : ?>
                <div>
                    <h4 class="text-sm font-semibold text-[var(--color-heading)] uppercase tracking-wider mb-4">
                        <?php esc_html_e('Follow Us', 'clesk-starter'); ?>
                    </h4>
                    <?php clesk_render_social_icons('w-5 h-5', 'w-10 h-10 rounded-lg bg-[var(--color-surface)] hover:bg-[var(--color-primary)]/10'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Copyright bar -->
    <div class="border-t border-[var(--color-border)]">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <p class="text-sm text-[var(--color-text-muted)]">
                &copy; <?php echo esc_html(date('Y')); ?> <?php echo esc_html(get_bloginfo('name')); ?>. <?php esc_html_e('All rights reserved.', 'clesk-starter'); ?>
            </p>
            <?php if (has_nav_menu('footer')) : ?>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'container'      => false,
                    'menu_class'     => 'flex flex-wrap gap-x-4 gap-y-1 text-sm text-[var(--color-text-muted)]',
                    'fallback_cb'    => false,
                    'depth'          => 1,
                ));
                ?>
            <?php endif; ?>
        </div>
    </div>
</footer>
