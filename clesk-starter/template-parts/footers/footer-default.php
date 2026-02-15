<?php
if (!defined('ABSPATH')) exit;
/**
 * Footer variant: Default
 * Logo + description, footer nav, social icons, copyright
 *
 * @package Clesk_Starter
 */
?>
<footer class="clesk-footer bg-[var(--color-surface-dark)] border-t border-[var(--color-border)]">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <!-- Footer info -->
            <div>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="text-lg font-bold text-[var(--color-heading)] font-[var(--font-heading)]">
                    <?php echo esc_html(get_bloginfo('name')); ?>
                </a>
                <p class="mt-1 text-sm text-[var(--color-text-muted)]">
                    <?php echo esc_html(get_bloginfo('description')); ?>
                </p>
            </div>

            <!-- Footer navigation -->
            <?php if (has_nav_menu('footer')) : ?>
                <div>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'container'      => false,
                        'menu_class'     => 'flex flex-wrap gap-x-6 gap-y-2 text-sm',
                        'fallback_cb'    => false,
                        'depth'          => 1,
                    ));
                    ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="mt-8 pt-8 border-t border-[var(--color-border)] flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <p class="text-sm text-[var(--color-text-muted)]">
                &copy; <?php echo esc_html(date('Y')); ?> <?php echo esc_html(get_bloginfo('name')); ?>. <?php esc_html_e('All rights reserved.', 'clesk-starter'); ?>
            </p>
            <?php clesk_render_social_icons(); ?>
        </div>
    </div>
</footer>
