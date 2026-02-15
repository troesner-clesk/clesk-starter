<?php
if (!defined('ABSPATH')) exit;
/**
 * Header variant: Centered
 * Logo centered top, navigation centered below
 *
 * @package Clesk_Starter
 */
?>
<header class="clesk-header sticky top-0 z-50 bg-[var(--color-background)] border-b border-[var(--color-border)] transition-colors duration-300">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Top row: mobile burger + centered logo -->
        <div class="flex items-center justify-between lg:justify-center h-16 relative">
            <!-- Mobile menu button (left) -->
            <button type="button"
                    class="clesk-mobile-toggle lg:hidden inline-flex items-center justify-center rounded-md p-2 text-[var(--color-text-muted)] hover:text-[var(--color-text)] hover:bg-[var(--color-surface)]"
                    aria-controls="clesk-mobile-menu"
                    aria-expanded="false"
                    onclick="this.setAttribute('aria-expanded', this.getAttribute('aria-expanded') === 'false' ? 'true' : 'false'); document.getElementById('clesk-mobile-menu').classList.toggle('hidden');">
                <span class="sr-only"><?php esc_html_e('Open menu', 'clesk-starter'); ?></span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>

            <!-- Logo (centered) -->
            <div class="flex-shrink-0">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="text-xl font-bold text-[var(--color-heading)] font-[var(--font-heading)] hover:text-[var(--color-primary)] transition-colors">
                        <?php echo esc_html(get_bloginfo('name')); ?>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Spacer for mobile alignment -->
            <div class="lg:hidden w-10"></div>
        </div>

        <!-- Desktop Navigation (centered below logo) -->
        <div class="hidden lg:flex lg:items-center lg:justify-center lg:pb-3">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'clesk-desktop-menu flex items-center gap-x-1',
                'fallback_cb'    => false,
                'depth'          => 3,
                'walker'         => new Clesk_Nav_Walker(),
            ));
            ?>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div id="clesk-mobile-menu" class="hidden lg:hidden border-t border-[var(--color-border)]">
        <div class="px-4 py-4">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'clesk-mobile-menu flex flex-col gap-y-1',
                'fallback_cb'    => false,
                'depth'          => 3,
                'walker'         => new Clesk_Mobile_Walker(),
            ));
            ?>
        </div>
    </div>
</header>
