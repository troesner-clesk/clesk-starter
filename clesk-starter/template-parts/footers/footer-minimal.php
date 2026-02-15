<?php
if (!defined('ABSPATH')) exit;
/**
 * Footer variant: Minimal
 * Single line with copyright, footer menu, and social icons
 *
 * @package Clesk_Starter
 */
?>
<footer class="clesk-footer bg-[var(--color-surface-dark)] border-t border-[var(--color-border)]">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <p class="text-sm text-[var(--color-text-muted)]">
            &copy; <?php echo esc_html(date('Y')); ?> <?php echo esc_html(get_bloginfo('name')); ?>. <?php esc_html_e('All rights reserved.', 'clesk-starter'); ?>
        </p>

        <div class="flex items-center gap-6">
            <?php if (has_nav_menu('footer')) : ?>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'container'      => false,
                    'menu_class'     => 'flex flex-wrap gap-x-6 gap-y-2 text-sm text-[var(--color-text-muted)]',
                    'fallback_cb'    => false,
                    'depth'          => 1,
                ));
                ?>
            <?php endif; ?>
            <?php clesk_render_social_icons('w-4 h-4', 'w-8 h-8 rounded'); ?>
        </div>
    </div>
</footer>
